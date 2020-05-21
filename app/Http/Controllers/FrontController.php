<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Customer;
use App\Order;

class FrontController extends Controller
{
    public function index()
    {
        $products = Product::paginate(16);
        return view('index', ['products'=>$products]);
    }

    public function cart($id)
    {
        $product = Product::findOrFail($id);
        return view('cart', ['product' => $product]);
    }

    public function buy(Request $request)
    {
        return DB::transaction(function() use ($request) {
            // insert customer
            $customer = new Customer;
            $customer->name = $request->input('name');
            $customer->phone_number = $request->input('phone_number');
            $customer->address = $request->input('address');
            $customer->save();
            // insert order
            $order = new Order;
            $order->order_code = floor(time()-999999999);
            $order->product_id = $request->input('pid');
            $order->customer_id = $customer->id;
            $order->qty = $request->input('qty');
            $order->subtotal = ($order->qty) * ($request->input('price'));
            $order->save();
            return redirect()->route('detailOrder', ['id' => $order->id]);
        });
    }

    public function detail($id)
    {
        $order = Order::with('product')->findOrFail($id);
        return view('detail', ['order' => $order]);
    }
}
