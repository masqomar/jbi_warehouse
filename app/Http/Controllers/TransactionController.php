<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view transaction')->only('index', 'show');
        $this->middleware('permission:create transaction')->only('create', 'store');
        $this->middleware('permission:edit transaction')->only('edit', 'update');
        $this->middleware('permission:delete transaction')->only('destroy');
    }

    public function index()
    {
        $transactions = Transaction::latest()->where('company_id', auth()->user()->company_id)->get();

        return view('transactions.index', compact('transactions'));
    }
    public function store(Request $request)
    {
        $params = $request->all();

        $transaction = DB::transaction(function () use ($params) {

            $transactionParams = [
                'transaction_code' => 'P100' . mt_rand(1, 1000),
                'created_by' => auth()->user()->name,
                'total_price' => $params['total'],
                'date' => Carbon::now(),
                'purpose' => $params['purpose'],
                'description' => $params['description'],
                'pic' => $params['pic'],
                'company_id' => auth()->user()->company_id

            ];

            $transaction = Transaction::create($transactionParams);

            $carts = Cart::all();

            if ($transaction && $carts) {
                foreach ($carts as $cart) {

                    $orderItemParams = [
                        'transaction_id' => $transaction->id,
                        'product_id' => $cart->product_id,
                        'qty' => $cart->quantity,
                        'product_name' => $cart->name,
                    ];

                    $orderItem = TransactionDetail::create($orderItemParams);

                    if ($orderItem) {
                        $product = Product::findOrFail($cart->product_id);
                        $product->quantity -= $cart->quantity;
                        $product->save();
                    }

                    $cart->delete();
                }
            }

            return $transaction;
        });



        if ($transaction) {
            return redirect()->route('transactions.show', $transaction->id)->with([
                'message' => 'Success order',
                'alert-type' => 'success'
            ]);
        }
    }


    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }



    public function destroy(Transaction $transaction)
    {

        $transaction->delete();

        return redirect()->back()->with([
            'message' => 'success delete',
            'alert-type' => 'danger'
        ]);
    }

    public function print_struck(Transaction $transaction)
    {

        return view('transactions.nota', compact('transaction'));
    }
}
