<?php

namespace App\Http\Controllers;


use App\Models\Company;
use App\Http\Requests\{StoreCompanyRequest, UpdateCompanyRequest};
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view company')->only('index', 'show');
        $this->middleware('permission:create company')->only('create', 'store');
        $this->middleware('permission:edit company')->only('edit', 'update');
        $this->middleware('permission:delete company')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $companies = Company::query();

            return DataTables::of($companies)
                ->addColumn('address', function($row){
                    return str($row->address)->limit(200);
                })
				->addColumn('action', 'companies.include.action')
                ->toJson();
        }


        return view('companies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        Company::create($request->validated());

        return redirect()
            ->route('companies.index')
            ->with('success', __('Company created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $company->update($request->validated());

        return redirect()
            ->route('companies.index')
            ->with('success', __('Company updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        try {
            $company->delete();

            return redirect()
                ->route('companies.index')
                ->with('success', __('Company deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('companies.index')
                ->with('error', __('The Company can`t be deleted because it is related to another table.'));
        }
    }
}
