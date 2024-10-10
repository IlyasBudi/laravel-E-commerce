<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use App\Models\ProductTransaction;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Midtrans\Config;
use Midtrans\Snap;

class ProductTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     
     public function index()
    {

        $user = Auth::user();

        if($user->hasRole('buyer')) {
            $product_transactions = $user->product_transactions()->orderBy('id', 'DESC')->get();
        } else {
            $product_transactions = ProductTransaction::orderBy('id', 'DESC')->get();
        }

        return view('admin.product_transactions.index', [
            'product_transactions' => $product_transactions
        ]);
    }
    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'notes' => 'required|string|max:65535',
            'phone_number' => 'required|integer',
        ]);

        DB::beginTransaction();

        try {
            $subTotalCents = 0;
            $deliveryFeeCents = 10000 * 100;

            $cartItems = $user->carts;
            foreach ($cartItems as $item) {
                $subTotalCents += $item->product->price * 100 * $item->quantity;

                $taxCents = (int)round(11 * $subTotalCents / 100);
                $grandTotalCents = $subTotalCents + $taxCents;

                $grandTotal = $grandTotalCents / 100;

                $validated['user_id'] = $user->id;
                $validated['total_amount'] = $grandTotal;
                $validated['is_paid'] = true;

                $newTransaction = ProductTransaction::create($validated);

                foreach ($cartItems as $item) {
                    TransactionDetail::create([
                        'product_transaction_id' => $newTransaction->id,
                        'product_id' => $item->product_id,
                        'price' => $item->product->price,
                        'quantity' => $item->quantity,
                    ]);

                    // Kurangi quantity produk
                    $product = $item->product;
                    $product->quantity -= $item->quantity;
                    $product->save();

                    $item->delete();
                }

                DB::commit();

                // Proses Midtrans Payment Gateway
                Config::$serverKey = config('midtrans.midtrans.server_key');
                Config::$isProduction = config('midtrans.midtrans.is_production');
                Config::$isSanitized = config('midtrans.midtrans.is_sanitized');
                Config::$is3ds = config('midtrans.midtrans.is_3ds');

                $transactionDetails = [
                    'order_id' => $newTransaction->id,
                    'gross_amount' => $grandTotal
                ];

                $customerDetails = [
                    'first_name' => $user->name,
                    'email' => $user->email,
                    'phone' => $request->phone_number,
                    'address' => $request->address,
                ];

                $params = [
                    'transaction_details' => $transactionDetails,
                    'customer_details' => $customerDetails,
                ];

                $snapToken = Snap::getSnapToken($params);

                // Redirect to Midtrans Payment Page
                return view('front.payment', compact('snapToken', 'newTransaction'));
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System error! ' . $e->getMessage()],
            ]);
            throw $error;
        }
    }
    
    public function show(ProductTransaction $productTransaction)
    {
        $productTransaction = ProductTransaction::with('transactionDetails.product')->find($productTransaction->id);
        return view('admin.product_transactions.details', [
            'productTransaction' => $productTransaction
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductTransaction $productTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductTransaction $productTransaction)
    {
        $productTransaction->update([
            'is_paid' => true
        ]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductTransaction $productTransaction)
    {
        //
    }
}
