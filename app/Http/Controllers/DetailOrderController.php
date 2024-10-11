<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\DetailOrder;


class DetailOrderController extends Controller
{
    public function show($order_id){
        $order = Order::find($order_id);
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        if((auth()->user()->role_id == 3) && ($order->customer_id != auth()->user()->customer->id)){
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $detailOrders = DetailOrder::with(['detail_product.product', 'detail_product.size'])->with('border')->with('topping')
            ->where('order_id', $order->id)
            ->get();

        return response()->json($detailOrders);
    }

    public function store(Request $request, $order_id){
        $order = Order::find($order_id);
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        if((auth()->user()->role == 'customer') && ($order->user_id != auth()->user()->id)){
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'size' => 'required|string|max:255',
            'border' => 'required|string|max:255',
            'soles' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
        ]);

        $validatedData['order_id'] = $order_id;
        
        // Tạo mới DetailOrder
        $detailOrder = DetailOrder::create($validatedData);

        return response()->json($detailOrder, 201);
    }
}
