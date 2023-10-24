<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // $user = Auth::user();
            if(auth('sanctum')->check()){
                auth()->user()->tokens()->delete();
            }
        return [
            'id' => $this->id,
            'f_name' => $this->f_name,
            'l_name' => $this->l_name,
            'email' => $this->email,
            'token' => Auth::user()->createToken('Cryptosy')->plainTextToken,
        ];
    }

    // public function with($request)
    // {
    //     return ['token' => ];
    // }
}
