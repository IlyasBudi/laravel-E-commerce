<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $my_carts = $user->carts()->with('product')->get();

        $subTotal = 0;
        foreach ($my_carts as $cart) {
            $subTotal += $cart->product->price * $cart->quantity;
        }

        $ppn = $subTotal * 0.11; // PPN 11%
        $grandTotal = $subTotal + $ppn;

        return view('front.carts', [
            'my_carts' => $my_carts,
            'subTotal' => $subTotal,
            'ppn' => $ppn,
            'grandTotal' => $grandTotal
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($productId)
    {
        $user = Auth::user();

        $existingCartItem = Cart::where('user_id', $user->id)->where('product_id', $productId)->first();

        if($existingCartItem) {
            // Jika item sudah ada, tambahkan quantity
            $existingCartItem->quantity += 1;
            $existingCartItem->save();
            return redirect()->route('carts.index');
        }

        DB::beginTransaction();

        try {
            $cart = Cart::updateOrCreate([
                'user_id' => $user->id,
                'product_id' => $productId,
                'quantity' => 1,
            ]);

            $cart->save();

            DB::commit();

            return redirect()->route('carts.index');

        } catch(\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System error!' . $e->getMessage()],
            ]);
            throw $error;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        try {
            $cart->delete();
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System error!' . $e->getMessage()],
            ]);
            throw $error;
        }
    }
}
