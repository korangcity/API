<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Product;
use App\Services\Order\CreateOrder;
use App\Services\Order\EditOrder;
use App\Services\Order\UpdateProductInventoryByOrderDestroyed;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\OrderCollection;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->paginate(3);
        return new OrderCollection($orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreOrderRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request, CreateOrder $createOrder)
    {


        $createCheck = $createOrder->execute($request);

        $messsage = "order is registered";
        $http_response = Response::HTTP_CREATED;
        $status = true;
        if (!$createCheck) {
            $messsage = "your order count is out of product inventory range";
            $http_response = Response::HTTP_RESET_CONTENT;
            $status = false;
        }

        return response()->json(['message' => $messsage, 'status' => $status], $http_response);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        return new OrderResource($order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateOrderRequest $request
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, EditOrder $editOrder)
    {

        $editOrderCheck = $editOrder->execute($request);
//        return response()->json(['message' => $editOrderCheck]);
        $messsage = "order is updated";
        $http_response = Response::HTTP_CREATED;
        $status = true;
        if (!$editOrderCheck) {
            $messsage = "your order count is out of product inventory range";
            $http_response = Response::HTTP_RESET_CONTENT;
            $status = false;
        }

        return response()->json(['message' => $messsage, 'status' => $status], $http_response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $updateProductInventory = new UpdateProductInventoryByOrderDestroyed($order->products,$order->products_count);
        $updateProductInventory->execute();
        $order->delete();

        return response()->json(['message' => 'your order deleted successfuly', 'status' => true], Response::HTTP_OK);
    }
}
