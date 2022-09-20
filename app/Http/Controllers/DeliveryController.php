<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Delivery;
use Illuminate\Support\Facades\DB;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::select(DB::raw(
                'SELECT * from
                (SELECT orders.id, customer_name, customer_number, customer_email, item_name, order_quantity, item_price,
                (orders.order_quantity * items.item_price) as total FROM orders 
                JOIN items ON orders.item_id = items.id
                JOIN customers ON orders.customer_id = customers.id
                ) orders JOIN deliveries
                ON deliveries.order_id = orders.id'
                ));
        // return Delivery::all();
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
        
        $result = Delivery::create($request->all());

        return $result;
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
        return DB::select(
            'SELECT * from
            (SELECT orders.id, customer_name, customer_number, customer_email, item_name, order_quantity, item_price,
            (orders.order_quantity * items.item_price) as total FROM orders 
            JOIN items ON orders.item_id = items.id
            JOIN customers ON orders.customer_id = customers.id
            ) orders JOIN deliveries
            ON deliveries.order_id = orders.id WHERE deliveries.id = ?',[$id]
            );
        // return Delivery::find($id);
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
        $delivery = Delivery::find($id);
        $delivery->update($request->all());
        return $delivery;
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
        return Delivery::destroy($id);
        //
    }
}
