<?php

namespace App\Http\Resources;

use App\City;
use Illuminate\Http\Resources\Json\JsonResource;

class UserLoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'image_path'    => '/uploads/users/',
            'image' => $this->image,
            'notification' => $this->notification,
            'city_id' => (int)$this->city_id,
            'city_name' =>  City::find($this->city_id)->name_ar,
            'email' => $this->email,
            'api_token' => $this->api_token,
            'created_at' => $this->created_at->format('Y-m-d'),
        ];
    }
}
