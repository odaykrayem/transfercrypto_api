<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmailVerificationRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use Otp;


class EmailVerificationController extends Controller
{
    private $otp;

    public function __construct()
    {
        $this->otp = new Otp;
    }

    public function verifyOtp(EmailVErificationREquest $request){
        $otp2 =  $this->otp->validate($request->email, $request->otp);
        if(!$otp2->status){
            return response()->json(['msg' => $otp2->message],401 );
        }

        // $user = User::where('email','=', $request->email)->first();
        $user = User::where('email','=',$request['email'])->first();
        if($user){
            echo '1';
            $user->update(['email_verified_at' => Carbon::now()]);

        }else{
            return response()->json(['error' => 'This email does not exist'],401 );
        }

        // $user->update(['email_verified_at' => Carbon::now()]);
        return response()->json([
            'msg' => 'success',
        ], 200);     
    }
}
