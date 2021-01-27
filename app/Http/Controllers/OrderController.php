<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
  public function createOrder(Request $request)
  {
    $validator =  Validator::make($request->all(), [
      'id' => 'required|numeric|exists:account',
      'product' => 'required',
      'value' => 'required|numeric',
      'quantity' => 'required|numeric|min:1',
    ]);

    if ($validator->fails()) {
      return response()->json(['message' => $validator->errors()], 400);
    }

    try {
      $order = new Order;
      $order->id_account = $request->id;
      $order->product = $request->product;
      $order->value = $request->value;
      $order->total = ($request->value * $request->quantity);
      $order->quantity = $request->quantity;
      $order->save();
      return response()->json(['data' => $order], 200);
    } catch (\Throwable $th) {
      return response()->json(['message' => $th], 400);
    }
  }

  public function updateOrder(Request $request)
  {
    $validator =  Validator::make($request->all(), [
      'id' => 'required|exists:order',
      'quantity' => 'sometimes|min:1',
    ]);

    if ($validator->fails()) {
      return response()->json(['message' => $validator->errors()], 400);
    }

    try {

      $order = Order::find($request->id);
      if (isset($request->product)) {
        $order->product = $request->product;
      }
      if (isset($request->value)) {
        $order->value = $request->value;
        $order->total = ($request->value * $request->quantity);
      }
      if (isset($request->quantity)) {
        $order->quantity = $request->quantity;
        $order->total = ($request->value * $request->quantity);
      }
      $order->save();
      return response()->json($order, 200);
    } catch (\Throwable $th) {
      return response()->json(['message' => $th], 400);
    }
  }

  public function cancelOrder(Request $request)
  {
    $validator =  Validator::make($request->all(), [
      'id' => 'required|exists:order',
    ]);
    if ($validator->fails()) {
      return response()->json(['message' => $validator->errors()], 400);
    }
    try {
      $order = Order::find($request->id);
      $order->delete();
      return response()->json($order, 200);
    } catch (\Throwable $th) {
      return response()->json(['message' => $th], 400);
    }
  }
}
