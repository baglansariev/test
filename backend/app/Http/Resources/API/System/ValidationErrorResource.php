<?php

namespace App\Http\Resources\API\System;

use Illuminate\Http\Resources\Json\JsonResource;

class ValidationErrorResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => 'error',
            'code' => 422,
            'message' => $this->resource,
        ];
    }

    public function withResponse($request, $response)
    {
        $response->setStatusCode(422, 'Validation error!');
    }
}
