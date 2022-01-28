<?php

namespace App\Http\Resources\API\System;

use Illuminate\Http\Resources\Json\JsonResource;

class EntityDeletedSuccessfullyResource extends JsonResource
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
            'message' => 'Entity has been deleted successfully!',
        ];
    }

    public function withResponse($request, $response)
    {
        $response->setStatusCode(200, 'Entity has been deleted successfully!');
    }
}
