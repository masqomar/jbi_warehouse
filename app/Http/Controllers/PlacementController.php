<?php

namespace App\Http\Controllers;


use App\Models\Placement;
use App\Http\Requests\{StorePlacementRequest, UpdatePlacementRequest};
use App\Models\AssetItem;
use App\Models\Company;
use App\Models\PlacementItem;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PlacementController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view placement')->only('index', 'show');
        $this->middleware('permission:create placement')->only('create', 'store');
        $this->middleware('permission:edit placement')->only('edit', 'update');
        $this->middleware('permission:delete placement')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $placements = Placement::with('room:id,name', 'user:id,name', 'company:id,code')
                ->where('company_id', Auth::user()->company_id);

            return DataTables::of($placements)
                ->addColumn('placement_code', function ($row) {
                    return $row ? $row->company->code . '-' . date('mY') . '-' . str_pad($row->placement_code, 5, '0', STR_PAD_LEFT) : '-';
                })->addColumn('description', function ($row) {
                    return str($row->description)->limit(200);
                })
                ->addColumn('room', function ($row) {
                    return $row->room ? $row->room->name : '-';
                })->addColumn('user', function ($row) {
                    return $row->user ? $row->user->name : '-';
                })->addColumn('user', function ($row) {
                    return $row->user ? $row->user->name : '-';
                })->addColumn('company', function ($row) {
                    return $row->company ? $row->company->code : '-';
                })->addColumn('action', 'placements.include.action')
                ->toJson();
        }


        return view('placements.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $placementCode = Placement::where('company_id', Auth::user()->company_id)->max('placement_code') + 1;
        $room = Room::where('company_id', Auth::user()->company_id)->get();
        $assetItems = AssetItem::where('company_id', Auth::user()->company_id)
            ->where('status', "tersedia")
            ->get();
        $pics = User::with('devision')->where('company_id', Auth::user()->company_id)->get();

        // dd($placementCode);
        return view('placements.create', compact('placementCode', 'room', 'assetItems', 'pics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlacementRequest $request)
    {
        $request->validated();

        DB::transaction(function () use ($request) {
            $placement = Placement::insertGetId([
                'placement_code' => $request->placement_code,
                'date' => $request->date,
                'room_id' => $request->room_id,
                'staff_id' => $request->staff_id,
                'description' => $request->description,
                'type' => 'Baru',
                'condition' => 'Bagus',
                'created_by' => Auth::user()->id,
                'company_id' => Auth::user()->company_id,
            ]);

            $id = $request->asset_id;
            for ($i = 0; $i < count($id); $i++) {
                PlacementItem::create([
                    'placement_id' => $placement,
                    'asset_item_id' => $id[$i],
                    'status' => 'Yes',
                    'company_id' => Auth::user()->company_id
                ]);

                AssetItem::where('id', $id[$i])
                    ->update([
                        'status' => 'Ditempatkan'
                    ]);
            }
        });


        return redirect()
            ->route('placements.index')
            ->with('success', __('Placement created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Placement  $placement
     * @return \Illuminate\Http\Response
     */
    public function show(Placement $placement)
    {
        $placement->load('room:id,name', 'user:id,name', 'company:id,code');
        $placementItems = PlacementItem::where('placement_id', $placement->id)->get();

        // dd($placementItems);
        return view('placements.show', compact('placement', 'placementItems'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Placement  $placement
     * @return \Illuminate\Http\Response
     */
    public function edit(Placement $placement)
    {
        $placement->load(
            'room:id,name',
            'user:id,name',

            'company:id,code'
        );

        return view('placements.edit', compact('placement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Placement  $placement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlacementRequest $request, Placement $placement)
    {
        $placement->update($request->validated());

        return redirect()
            ->route('placements.index')
            ->with('success', __('Placement updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Placement  $placement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Placement $placement)
    {
        try {
            $placement->delete();

            return redirect()
                ->route('placements.index')
                ->with('success', __('Placement deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('placements.index')
                ->with('error', __('The Placement can`t be deleted because it is related to another table.'));
        }
    }
}
