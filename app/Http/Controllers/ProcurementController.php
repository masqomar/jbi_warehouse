<?php

namespace App\Http\Controllers;


use App\Models\Procurement;
use App\Http\Requests\{StoreProcurementRequest, UpdateProcurementRequest};
use App\Models\Asset;
use App\Models\AssetItem;
use App\Models\Category;
use App\Models\ProcurementItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ProcurementController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view procurement')->only('index', 'show');
        $this->middleware('permission:create procurement')->only('create', 'store');
        $this->middleware('permission:edit procurement')->only('edit', 'update');
        $this->middleware('permission:delete procurement')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $procurements = Procurement::with('supplier:id,name', 'user:id,name', 'company:id,name');

            return DataTables::of($procurements)
                ->addColumn('description', function ($row) {
                    return str($row->description)->limit(200);
                })
                ->addColumn('supplier', function ($row) {
                    return $row->supplier ? $row->supplier->name : '-';
                })->addColumn('user', function ($row) {
                    return $row->user ? $row->user->name : '-';
                })->addColumn('company', function ($row) {
                    return $row->company ? $row->company->name : '-';
                })->addColumn('action', 'procurements.include.action')
                ->toJson();
        }


        return view('procurements.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $procurementCode = Procurement::where('company_id', auth()->user()->company_id)->max('invoice_number') + 1;
        $categories = Category::get();
        $query = Asset::query();

        if ($request->ajax()) {
            $assets = Asset::where("category_id", $request->category_id)
                ->get(["name", "id"]);

            return response(['assets' => $assets]);
        }
        $assets = $query->get();


        return view('procurements.create', compact('procurementCode', 'categories', 'assets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProcurementRequest $request)
    {
        DB::transaction(
            function () use ($request) {
                Procurement::create([
                    'invoice_number' => $request->invoice_number,
                    'date' => $request->date,
                    'supplier_id' => $request->supplier_id,
                    'type' => $request->type,
                    'description' => $request->description,
                    'user_id' => auth()->id(),
                    'company_id' => auth()->user()->company_id,
                ]);

                ProcurementItem::create([
                    'invoice_number' => $request->invoice_number,
                    'asset_id' => $request->asset_id,
                    'description' => $request->item_description,
                    'price' => $request->price,
                    'quantity' => $request->quantity,
                    'company_id' => auth()->user()->company_id
                ]);

                $asset = Asset::find($request->asset_id);
                $asset->stock += $request->quantity;
                $asset->save();

                for ($i = 1; $i <= $request->quantity; $i++) {
                    AssetItem::create([
                        'asset_id' => $request->asset_id,
                        'purchasing_no' => $request->invoice_number,
                        'purchasing_date' => $request->date,
                        'price' => $request->price,
                        'category_id' => $request->category_id,
                        'company_id' => auth()->user()->company_id,
                        'status' => 'Tersedia',
                        'created_by' => auth()->user()->id,
                        'updated_by' => auth()->user()->id,
                    ]);
                }
            }
        );

        return redirect()
            ->route('procurements.index')
            ->with('success', __('Procurement created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Procurement  $procurement
     * @return \Illuminate\Http\Response
     */
    public function show(Procurement $procurement)
    {
        $procurement->load(
            'supplier:id,name',

            'user:id,name'
        );

        return view('procurements.show', compact('procurement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Procurement  $procurement
     * @return \Illuminate\Http\Response
     */
    public function edit(Procurement $procurement)
    {
        $procurement->load(
            'supplier:id,name',

            'user:id,name'
        );

        return view('procurements.edit', compact('procurement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Procurement  $procurement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProcurementRequest $request, Procurement $procurement)
    {
        $procurement->update($request->validated());

        return redirect()
            ->route('procurements.index')
            ->with('success', __('Procurement updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Procurement  $procurement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Procurement $procurement)
    {
        try {
            $procurement->delete();

            return redirect()
                ->route('procurements.index')
                ->with('success', __('Procurement deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('procurements.index')
                ->with('error', __('The Procurement can`t be deleted because it is related to another table.'));
        }
    }
}
