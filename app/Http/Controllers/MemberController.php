<?php

namespace App\Http\Controllers;


use App\Models\Member;
use App\Http\Requests\{StoreMemberRequest, UpdateMemberRequest};
use App\Models\Product;
use App\Models\ProductProgram;
use App\Models\Program;
use App\Models\Toolkit;
use App\Models\ToolkitItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Telegram\Bot\Laravel\Facades\Telegram;
use Yajra\DataTables\Facades\DataTables;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view member')->only('index', 'show');
        $this->middleware('permission:create member')->only('create', 'store');
        $this->middleware('permission:edit member')->only('edit', 'update');
        $this->middleware('permission:delete member')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $members = Member::with('user:id,name', 'company:id,code')
                ->where('company_id', auth()->user()->company_id);

            return DataTables::of($members)
                ->addColumn('address', function ($row) {
                    return str($row->address)->limit(200);
                })
                ->addColumn('user', function ($row) {
                    return $row->user ? $row->user->name : '-';
                })->addColumn('company', function ($row) {
                    return $row->company ? $row->company->code : '-';
                })->addColumn('action', 'members.include.action')
                ->toJson();
        }


        return view('members.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $IDs = Program::where('company_id', Auth::user()->company_id)->get();
        $query = ProductProgram::query();

        if ($request->ajax()) {
            $program = Program::find($request->program_id);
            $product = $program->products;
            $total = $product->sum('quantity');
            return response(['product' => $product, 'total' => $total]);
        }
        $product = $query->get();
        return view('members.create', compact('IDs', 'product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMemberRequest $request)
    {
        $request->validated();

        DB::transaction(function () use ($request) {
            Member::create([
                'reg_number' => $request->reg_number,
                'name' => $request->name,
                'gender' => $request->gender,
                'phone' => $request->phone,
                'address' => $request->address,
                'period' => $request->period,
                'program' => $request->program,
                'education' => $request->education,
                'tshirt' => $request->tshirt,
                'user_id' => Auth::user()->id,
                'company_id' => Auth::user()->company_id,
            ]);

            $getFacilityID = Toolkit::insertGetId([
                'taken_date' => Carbon::now(),
                'member_id' => $request->reg_number
            ]);

            $id = $request->inventory_id;
            for ($i = 0; $i < count($id); $i++) {
                $inventory_id = $id[$i];
                ToolkitItem::create([
                    'toolkit_id' => $getFacilityID,
                    'member_id' => $request->reg_number,
                    'product_id' => $inventory_id,
                    'quantity' => $request->quantity[$i],
                ]);

                Product::where('id', $inventory_id)
                    ->update([
                        'quantity' => $request->remaining_stock[$i] - $request->quantity[$i]
                    ]);
            }

            $toolkits = ToolkitItem::select(
                "toolkit_items.member_id",
                DB::raw("(GROUP_CONCAT(products.name SEPARATOR ',')) as `Toolkit`")
            )
                ->leftjoin("products", "products.id", "=", "toolkit_items.product_id")
                ->where('toolkit_items.member_id', $request->reg_number)
                ->groupBy('toolkit_items.member_id')
                ->get()
                ->first()
                ->Toolkit;

            $text = "<b>Pengambilan Toolkit Baru</b>\n\n"
                . "<b>No Reg: </b>"
                . "$request->reg_number\n"
                . "<b>Nama: </b>"
                . "$request->name\n"
                . "<b>Jenis Kelamin: </b>"
                . "$request->gender\n"
                . "<b>Program: </b>"
                . "$request->program\n\n"
                . "<b>Modul: </b>\n"
                . "$toolkits\n"
                . "Kaos $request->tshirt";

            Telegram::sendMessage([
                'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
                'parse_mode' => 'HTML',
                'text' => $text
            ]);
        });

        return redirect()
            ->route('members.index')
            ->with('success', __('Member created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        $member->load(
            'user:id,name',

            'company:id,code'
        );
        $toolkitItems = ToolkitItem::where('member_id', $member->reg_number)->get();

        return view('members.show', compact('member', 'toolkitItems'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        $member->load(
            'user:id,name',

            'company:id,code'
        );

        return view('members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMemberRequest $request, Member $member)
    {
        $member->update($request->validated());

        return redirect()
            ->route('members.index')
            ->with('success', __('Member updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        try {
            $member->delete();

            return redirect()
                ->route('members.index')
                ->with('success', __('Member deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('members.index')
                ->with('error', __('The Member can`t be deleted because it is related to another table.'));
        }
    }
}
