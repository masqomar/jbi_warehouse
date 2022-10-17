<?php

namespace App\Http\Controllers;


use App\Models\Mutation;
use App\Http\Requests\{StoreMutationRequest, UpdateMutationRequest};
use App\Models\Asset;
use App\Models\AssetItem;
use App\Models\MutationFrom;
use App\Models\MutationTo;
use App\Models\Placement;
use App\Models\PlacementItem;
use App\Models\Room;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MutationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view mutation')->only('index', 'show');
        $this->middleware('permission:create mutation')->only('create', 'store');
        $this->middleware('permission:edit mutation')->only('edit', 'update');
        $this->middleware('permission:delete mutation')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $mutations = Mutation::with('user:id,name')->where('company_id', Auth::user()->company_id);

            return DataTables::of($mutations)
                ->addColumn('description', function ($row) {
                    return str($row->description)->limit(200);
                })
                ->addColumn('user', function ($row) {
                    return $row->user ? $row->user->name : '-';
                })->addColumn('action', 'mutations.include.action')
                ->toJson();
        }


        return view('mutations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mutationCode = Mutation::where('company_id', Auth::user()->company_id)->max('mutation_code') + 1;
        $placementAssets = DB::table('placement_items')
            ->join('placements', 'placement_items.placement_id', '=', 'placements.id')
            ->join('asset_items', 'placement_items.asset_item_id', '=', 'asset_items.full_code')
            ->select('placement_items.*', 'asset_items.full_code')
            ->where('placement_items.status', '=', 'yes')
            ->where('asset_items.status', '=', 'ditempatkan')
            ->where('placements.company_id', '=', Auth::user()->company_id)
            ->get();

        $room = Room::where('company_id', auth()->user()->company_id)->get();
        $pics = User::with('devision')->where('company_id', auth()->user()->company_id)->get();

        // dd($placementAssets);
        return view('mutations.create', compact('mutationCode', 'placementAssets', 'room', 'pics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMutationRequest $request)
    {
        DB::transaction(
            function () use ($request) {
                //insert to mutation
                $mutationCode = Mutation::where('company_id', Auth::user()->company_id)->max('mutation_code') + 1;

                $mutation = Mutation::insertGetId([
                    'mutation_code' => $mutationCode,
                    'date' => $request->date,
                    'description' => $request->description,
                    'created_by' => auth()->user()->id,
                    'company_id' => auth()->user()->company_id
                ]);

                //insert placement
                $placementCode = Placement::where('company_id', Auth::user()->company_id)->max('placement_code') + 1;

                $newPlacement = Placement::insertGetId([
                    'placement_code' => $placementCode,
                    'date' => $request->date,
                    'room_id' => $request->room_id,
                    'staff_id' => $request->staff_id,
                    'description' => $request->placement_description,
                    'type' => 'Mutasi',
                    'condition' => $request->condition,
                    'created_by' => Auth::user()->id,
                    'company_id' => Auth::user()->company_id,
                ]);

                //insert mutation to
                MutationTo::create([
                    'mutation_id' => $mutation,
                    'placement_id' => $newPlacement,
                    'description' => $request->description
                ]);

                //insert placement items
                $carts = session()->get('cart', []);
                foreach ($carts as $cart) {
                    //update old placement item
                    PlacementItem::where('asset_item_id', $cart['asset_item_id'])
                        ->update([
                            'status' => 'No'
                        ]);
                    PlacementItem::create([
                        'placement_id' => $newPlacement,
                        'asset_item_id' => $cart['asset_item_id'],
                        'company_id' => Auth::user()->company_id,
                        'status' => 'Yes'
                    ]);

                    //insert mutation from
                    MutationFrom::create([
                        'mutation_id' => $mutation,
                        'placement_id' => $cart['placement_id'],
                        'asset_item_id' =>  $cart['asset_item_id'],
                    ]);
                }
                $request->session()->forget('cart');
            }
        );

        return redirect()
            ->route('mutations.index')
            ->with('success', __('Mutation created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mutation  $mutation
     * @return \Illuminate\Http\Response
     */
    public function show(Mutation $mutation)
    {
        $mutation->load('user:id,name');

        return view('mutations.show', compact('mutation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mutation  $mutation
     * @return \Illuminate\Http\Response
     */
    public function edit(Mutation $mutation)
    {
        $mutation->load('user:id,name');

        return view('mutations.edit', compact('mutation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mutation  $mutation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMutationRequest $request, Mutation $mutation)
    {
        $mutation->update($request->validated());

        return redirect()
            ->route('mutations.index')
            ->with('success', __('Mutation updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mutation  $mutation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mutation $mutation)
    {
        try {
            $mutation->delete();

            return redirect()
                ->route('mutations.index')
                ->with('success', __('Mutation deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('mutations.index')
                ->with('error', __('The Mutation can`t be deleted because it is related to another table.'));
        }
    }

    public function cart()
    {
        return view('mutations.cart');
    }

    public function addToCart($id)
    {
        $mutationAssets = PlacementItem::findOrFail($id);

        $cart = session()->get('cart', []);


        $cart[$id] = [
            "placement_id" => $mutationAssets->placement_id,
            "asset_item_id" => $mutationAssets->asset_item_id,
            "status" => $mutationAssets->status
        ];

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
}
