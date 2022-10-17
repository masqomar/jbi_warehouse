<?php

namespace App\Http\Controllers;


use App\Models\Program;
use App\Http\Requests\{StoreProgramRequest, UpdateProgramRequest};
use App\Models\Inventory;
use App\Models\InventoryProgram;
use App\Models\Product;
use App\Models\ProductProgram;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProgramController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view program')->only('index', 'show');
        $this->middleware('permission:create program')->only('create', 'store');
        $this->middleware('permission:edit program')->only('edit', 'update');
        $this->middleware('permission:delete program')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programs = Program::where('company_id', Auth::user()->company_id)->get();

        return view('programs.index', [
            'programs' => $programs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('company_id', Auth::user()->company_id)->get();

        return view('programs.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProgramRequest $request)
    {

        $request->validated();

        DB::transaction(function () use ($request) {
            $getProgramID = Program::insertGetId([
                'name' => $request->name,
                'company_id' => Auth::user()->company_id
            ]);

            $id = $request->product_id;
            for ($i = 0; $i < count($id); $i++) {
                $product_id = $id[$i];
                ProductProgram::create([
                    'program_id' => $getProgramID,
                    'product_id' => $product_id,
                ]);
            }
        });

        return redirect()
            ->route('programs.index')
            ->with('success', __('Program created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
    {
        $program->load('company:id,code');

        return view('programs.show', compact('program'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program)
    {
        $program->load('company:id,code');

        return view('programs.edit', compact('program'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProgramRequest $request, Program $program)
    {
        $program->update($request->validated());

        return redirect()
            ->route('programs.index')
            ->with('success', __('Program updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        try {
            $program->delete();

            return redirect()
                ->route('programs.index')
                ->with('success', __('Program deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('programs.index')
                ->with('error', __('The Program can`t be deleted because it is related to another table.'));
        }
    }
}
