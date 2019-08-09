<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
        if ($this->method() === 'POST') {
            return [
                'author_id'     => 'required',
                'reviewed_type' => 'required',
                'reviewed_id'   => 'required',
                'rating'        => 'required',
                'description'   => 'required',
            ];
        } else {
            if (in_array($this->method(), ['PUT', 'PATCH'])) {
                return [
                    'reviewed_type' => 'required',
                    'reviewed_id'   => 'required',
                    'rating'      => 'required',
                    'description' => 'required',
                ];
            }
        }
    }
}
