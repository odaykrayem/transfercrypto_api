<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TransactionsController extends Controller
{
    public function list(Request $request)
    {
        // if(isset($request['user_id'])){
        $userId =  Auth::id();
        // $user = User::find($userId);
        // $user_id = $request['user_id'];
        $list = Transactions::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        // return new WalletToCashTransactionsCollection($list);
        return response()->json(
            [
                'data' => $list
            ],
            200
        );
        // }else{
        //     echo 'no';
        // }
    }

    public function add(Request $request)
    {

        $userId =  Auth::id();
        // $user = User::where('id', $userId)->first();

        // $validator = Validator::make($request->all(), [
        //     'user_image' => 'required|image:jpeg,png,jpg,gif,svg|max:2048'
        // ]);
      
        // if (!$validator->fails()) {}
       if(isset($request['user_image'])){
            $realImage = base64_decode($request['user_image']);
            $imagePath =  "/transactions/".time().'.png';
            $disk = Storage::disk('public')->put($imagePath,$realImage); 
            Transactions::create([
                'user_id' => $userId,
                'send_amount' => $request['send_amount'],
                'receive_amount' => $request['receive_amount'],
                'commission' => $request['commission'],
                'from_wallet' => $request['from_wallet'],
                'from_wallet_icon' => $request['from_wallet_icon'],
                'to_wallet' => $request['to_wallet'],
                'to_wallet_icon' => $request['to_wallet_icon'],
                'admin_wallet' => $request['admin_wallet'],
                'user_wallet_id' => $request['user_wallet_id'],
                'user_op_code' => $request['user_op_code'],
                'user_image' => Storage::disk('public')->url($imagePath),       
                'user_full_name' => $request['user_full_name'],
                'user_phone' => $request['user_phone'],
                'user_place' => $request['user_place'],
                'user_email' => $request['user_email'],
            ]);
        }else{
            Transactions::create([
                'user_id' => $userId,
                'send_amount' => $request['send_amount'],
                'receive_amount' => $request['receive_amount'],
                'commission' => $request['commission'],
                'from_wallet' => $request['from_wallet'],
                'from_wallet_icon' => $request['from_wallet_icon'],
                'to_wallet' => $request['to_wallet'],
                'to_wallet_icon' => $request['to_wallet_icon'],
                'admin_wallet' => $request['admin_wallet'],
                'user_wallet_id' => $request['user_wallet_id'],
                'user_op_code' => $request['user_op_code'],
                'user_full_name' => $request['user_full_name'],
                'user_phone' => $request['user_phone'],
                'user_place' => $request['user_place'],
                'user_email' => $request['user_email'],
            ]);
        }

        // $uploadFolder = 'cash_to_wallet';
        // $image = $request->file('user_receipt_image');
        // $image_uploaded_path = $image->store($uploadFolder, 'public');
        return response()->json(
            [
                'msg' => 'success'
            ],
            200
        );
    }

    public function index(){}

    public function create(){}

    public function store(Request $request){}

    public function show(Transactions $cashToWallet){}

    public function edit(Transactions $cashToWallet){}

    public function update(Request $request, Transactions $cashToWallet){}

    public function destroy(Transactions $cashToWallet){}
}
