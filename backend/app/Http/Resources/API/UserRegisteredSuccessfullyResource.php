<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class UserRegisteredSuccessfullyResource extends JsonResource
{
    // Sanctum generated token
    public $access_token;

    public function __construct($resource, $access_token)
    {
        parent::__construct($resource);
        $this->access_token = $access_token;
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'token' => $this->access_token
        ];
    }

    public function withResponse($request, $response)
    {
        $response->setStatusCode(201, 'User has been registered successfully!');
    }
}
