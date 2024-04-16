<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Cart;
class OrderController extends Controller
{

public function store(Request $request)
{
    // Begin a database transaction
    \DB::beginTransaction();

    try {
        // Create the order
        $order = Order::create([
            'customer_name' => $request->input('customer_name'),
            'customer_phone' => $request->input('customer_phone'),
            'note' => $request->input('bill'),
            'subtotal' => $request->input('getSubTotalPrice'),
            'discount' => $request->input('getDiscount'),
            'total' => $request->input('getCheckoutPrice'),
        ]);

        // Create order items
        foreach ($request->input('cartItems') as $cartItemData) {
            OrderItem::create([
                'order_id' => $order->id,
                'coffee_id' => $cartItemData['coffee_id'],
                'quantity' => $cartItemData['quantity'],
                'price' => $cartItemData['price'],
            ]);
        }

        // Create payment
        $order->payment()->create([
            'card_number' => $request->input('card_number'),
            'expiration_date' => $request->input('expiration_date'),
            'cvv' => $request->input('cvv'),
        ]);

        // Clear the cart data associated with the authenticated user
        Cart::where('user_id', auth()->id())->delete();

        // Commit the transaction
        \DB::commit();

        return view('ui.transaction.thankyou', [
            'active' => 'About',
            'subPageTitle' => 'WE SALE FRESH COFFEE',
            'pageTitle' => 'About us'
        ]);
    } catch (\Exception $e) {
        // Rollback the transaction if an error occurred
        \DB::rollback();
        return response()->json(['message' => 'Failed to place order', 'error' => $e->getMessage()], 500);
    }
}
}