<?php

namespace App\Http\Controllers\Auth;

use App\CentralLogic\Helpers;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\CustomValue;
use App\Models\RefRecord;
use App\Models\User;
use App\Models\AdminValues;
use App\Models\WheelTimerRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Notifications\EmailVerificationNotification;


class UserAuthController extends Controller
{



    public function register(Request $request)
    {
        $creds = [
            'f_name' => $request['f_name'],
            'l_name' => $request['l_name'],
            'email' => $request['email'],
            'password' => $request['passowrd'],
        ];
        if (!Auth::attempt($creds)) {

            $validator = Validator::make($request->all(), [
                'f_name' => 'required',
                'l_name' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required|min:6',
            ], [
                'f_name.required' => 'The first name field is required.',
                'l_name.required' => 'The last name field is required.',
                'email.required' => 'The  email field is required.',
                'password.min' => 'Password must be at least 6.',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $this->error_processor($validator)], 403);
            }
            $pass = bcrypt($request->password);


            $userCreds = [
                'name' => 'no',
                'f_name' => $request->f_name,
                'l_name' => $request->l_name,
                'email' => $request->email,
                'password' => $pass,
            ];
            $userCreate = User::create($userCreds);

            $credentials = [
                'email' => $request['email'],
                'password' => $request['password'],
            ];

            if (Auth::attempt($credentials)) {

                $user = new UserResource(User::where('id', $userCreate->id)->first());
                // $wheelTimerRecordExist = WheelTimerRecord::where('user_id',$user->id)->exist();
                // $timer_on = false;
                // if($wheelTimerRecordExist){
                //     $timer_on = WheelTimerRecord::where('user_id', $user->id)->first()['is_on'];
                // }
                // $user['timer_on'] = $timer_on;
                return response()->json([
                    'msg' => 'success',
                    'data' => $user
                ], 200);
            }
        }
    }

    public function requestOtp(Request $request)
    {
        //    $otp = rand(1000,9999);
        //    $user = User::where('email','=',$request->email)->update(['otp' => $otp]);
        //    $mail_details = [
        //     'subject' => 'Testing Application OTP',
        //     'otp' =>  $otp
        // ];
        // try{
        //     Mail::to('oday.krayem.997@gamil.com')->send(new SendMail($mail_details));
        //    } 
        //     catch (\Exception $ex) {
        //             echo $ex->getMessage();
        //    }
        $user = User::where('email', '=', $request->email)->first();

        if ($user) {
            try {
                $user->notify(new EmailVerificationNotification());
                return response()->json([
                    'msg' => 'OTP sent successfully',
                ], 200);
                
            } catch (\Exception $ex) {
                return response()->json([
                    'msg' => 'Error sending OTP '. $ex,
                ], 401);
            }
        } else {
            return response()->json([
                'msg' => 'Email not exist',
            ], 401);
        }
    }

  
    
    public function adminValuesList()
    {

        $list = AdminValues::all();
        return response()->json(
            [
                'data' => $list
            ],
            200
        );
    }

    public function updatePassword(Request $request)
    {
        $user = User::where('email', $request['email'])->first();
        $newPass = $request['password'];
        $pass = bcrypt($newPass);


        User::where('id', [$user->id])->update([
            'password' => $pass,
        ]);

        return response()->json([
            'msg' => 'success',
        ], 200);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $this->error_processor($validator)], 403);
            // return response()->json([
            //     'msg' => 'some fileds are missing'
            // ], 401);
        }
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $userExist = User::where('email', $request['email'])->first();
       
        if ($userExist) {
            $userVerified = $userExist->email_verified_at != Null;

            if(!$userVerified){
                return response()->json([
                    'msg' => 'Please verify your email'
                ], 401);
            }
            if (Auth::attempt($data)) {
                $user = new UserResource(User::where('email', $request['email'])->first());

                return response()->json([
                    'data' => $user
                ], 200);
            } else {
                // $errors = [];
                // array_push($errors, ['code' => 'auth-001', 'message' => 'Unauthorized.']);
                return response()->json([
                    'msg' => 'Wrong Email Or Password'
                ], 401);
            }
        } else {
            return response()->json([
                'msg' => 'Please regester first'
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        Auth::user()->tokens()->where('tokenable_id', $request['user_id'])->delete();
    }
    public static function error_processor($validator)
    {
        $err_keeper = [];
        foreach ($validator->errors()->getMessages() as $index => $error) {
            array_push($err_keeper, ['code' => $index, 'message' => $error[0]]);
        }
        return $err_keeper;
    }
}
