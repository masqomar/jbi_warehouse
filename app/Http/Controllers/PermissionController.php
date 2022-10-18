<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view permission')->only('index', 'show');
        $this->middleware('permission:create permission')->only('create', 'store');
        $this->middleware('permission:edit permission')->only('edit', 'update');
        $this->middleware('permission:delete permission')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $permissions = Permission::all();

            return DataTables::of($permissions)
                ->addColumn('name', function ($row) {
                    return $row ? $row->name : '-';
                })->addColumn('action', 'permissions.include.action')
                ->toJson();
        }


        return view('permissions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validated();

        Permission::create([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);

        return redirect()
            ->route('permissions.index')
            ->with('success', __('Inventory created successfully.'));
    }
}
