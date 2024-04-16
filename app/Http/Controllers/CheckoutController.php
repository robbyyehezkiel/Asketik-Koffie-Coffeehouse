<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payments;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{

public function store(Request $request)
{
    try {

        // Create order
        $order = Order::create([
            'customer_name' => $request->input('customer_name'),
            'customer_phone' => $request->input('customer_phone'),
            'note' => $request->input('bill'),
            'subtotal' => $request->input('getCheckoutPrice'),
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

        // Create payment (if payment information is available)
        if ($request->filled('payment')) {
            $paymentData = $request->input('payment');
            Payment::create([
                'order_id' => $order->id,
                'card_number' => $paymentData['card-number'],
                'expiration_date' => $paymentData['expiration-date'],
                'cvv' => $paymentData['cvv'],
                // Populate more payment data fields as needed
            ]);
        }

        // Return success response
        return response()->json(['message' => 'Order placed successfully']);
    } catch (\Exception $e) {
        // Handle exceptions
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

}