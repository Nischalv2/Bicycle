<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Order::join('customers', 'orders.customer_id', '=', 'customers.id')
            ->join('items','orders.item_id','=','items.id')
            ->select(DB::raw(
                '
                customers.customer_name,
                customers.customer_number,
                customers.customer_email,
                items.item_name,
                orders.order_quantity,
                items.item_price,
                (orders.order_quantity * items.item_price) as total'
                ))
            ->get();
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'delivery_address' => 'required'
        ]);
        
        return Order::create($request->all());
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $test = Order::join('customers', 'orders.customer_id', '=', 'customers.id')
            ->join('items','orders.item_id','=','items.id')
            ->select(DB::raw(
                '
                customers.customer_name,
                customers.customer_number,
                customers.customer_email,
                items.item_name,
                orders.order_quantity,
                items.item_price,
                (orders.order_quantity * items.item_price) as total'
                ))
            ->where('orders.id','=',$id)
            ->get();
        return $test;
        // return Order::find($id);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->update($request->all());
        return $order;
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Order::destroy($id);
        //
    }
}
