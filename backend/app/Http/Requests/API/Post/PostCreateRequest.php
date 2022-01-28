<?php

namespace App\Http\Requests\API\Post;

use App\Http\Resources\API\System\ValidationErrorResource;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class PostCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'short_content' => 'required',
            'content' => 'required',
            'user_id' => 'required|integer',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = new ValidationErrorResource($validator->errors());
        throw new ValidationException($validator, $response);
    }
}
