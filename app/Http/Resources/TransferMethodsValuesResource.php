<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransferMethodsValuesResource extends JsonResource
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
        return [
            'id' => $this->id,
            'transfer_wallet_name' => $this->transfer_wallet_name,
            'transfer_wallet_icon' => $this->transfer_wallet_icon,
            'receive_wallet_name' => $this->receive_wallet_name,
            'receive_wallet_icon' => $this->receive_wallet_icon,
            'min_value'  => $this->min_value,
            'max_value'  => $this->max_value,
            'commission' => $this->commission,
            'admin_wallet_name' => $this->admin_wallet_name,
            'admin_wallet_code' => $this->admin_wallet_code,
        ];
    }
}
