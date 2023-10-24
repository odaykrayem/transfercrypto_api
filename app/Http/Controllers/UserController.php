<?php

namespace App\Http\Controllers;

use App\Http\Resources\MinTransferValueResource;
use App\Models\CashToWalletTransactions;
use App\Models\AdminValues;
use App\Models\Commission;
use App\Models\User;
use App\Models\MinTransferValues;
use App\Models\DepositMethods;
use App\Models\TransferMethods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

   
    public function getUserInfo()
    {
        $userId =  Auth::id();
        $user = User::where('id', $userId)->first();

         return response()->json(
            [
                'data' => $user
            ],200
        );
    }

    public function adminValueCashWallet()
    {

        $list = AdminValues::where('key','=','cash_wallet')->first();
        return response()->json(
            [
                'data' => $list
            ],
            200
        );
    }
}
