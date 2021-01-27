<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{

  public function createAccount(Request $request)
  {
    $validator =  Validator::make($request->all(), [
      'name' => 'required',
      'email' => 'required',
      'phone' => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json(['message' => $validator->errors()], 400);
    }


    try {

      $account = new Account;
      $account->name = $request->name;
      $account->email = $request->email;
      $account->phone_number = $request->phone;
      $account->save();
      return response()->json(['data' => $account], 200);
    } catch (\Throwable $th) {
      return response()->json(['message' => $th], 400);
    }
  }

  public function showAccount(Request $request)
  {

    try {

      $account = Account::all();
      return response()->json(['data' => $account], 200);
    } catch (\Throwable $th) {
      return response()->json(['message' => $th], 400);
    }
  }

  public function updateAccount(Request $request)
  {
    $validator =  Validator::make($request->all(), [
      'id' => 'required|exists:account',
    ]);

    if ($validator->fails()) {
      return response()->json(['message' => $validator->errors()], 400);
    }

    try {

      $account = Account::find($request->id);
      if (isset($request->name)) {
        $account->name = $request->name;
      }
      if (isset($request->email)) {
        $account->email = $request->email;
      }
      if (isset($request->phone)) {
        $account->phone_number = $request->phone;
      }
      $account->save();
      return response()->json($account, 200);
    } catch (\Throwable $th) {
      return response()->json(['message' => $th], 400);
    }
  }

  public function deteleAccount(Request $request)
  {
    $validator =  Validator::make($request->all(), [
      'id' => 'required|exists:account',
    ]);
    if ($validator->fails()) {
      return response()->json(['message' => $validator->errors()], 400);
    }
    try {
      $account = Account::find($request->id);
      $account->delete();
      return response()->json($account, 200);
    } catch (\Throwable $th) {
      return response()->json(['message' => $th], 400);
    }
  }
}
