<?php

namespace App\Http\Resources\API\System;

use Illuminate\Http\Resources\Json\JsonResource;

class ServerErrorResource extends JsonResource
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
            'type' => 'error',
            'code' => 500,
            'message' => 'Internal Server Error!',
        ];
    }

    public function withResponse($request, $response)
    {
        $response->setStatusCode(500, 'Internal Server Error!');
    }
}
