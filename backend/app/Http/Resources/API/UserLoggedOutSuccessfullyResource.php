<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class UserLoggedOutSuccessfullyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'type' => 'success',
            'code' => 200,
            'message' => 'User logged out successfully!',
        ];
    }

    public function withResponse($request, $response)
    {
        $response->setStatusCode(200, 'User logged out successfully!');
    }
}
