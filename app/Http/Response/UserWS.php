<?php


namespace App\Http\Response;


use Illuminate\Http\Resources\Json\JsonResource;

class UserWS extends JsonResource
{

    public function toArray($request)
    {
        return [
            'user' => $this->user,
            'name' => $this->name,
            'api_token' => $this->api_token
        ];
    }

}
