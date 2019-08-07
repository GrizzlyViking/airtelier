<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
        if ($this->method() == 'POST') {
            return [
                'sender_id'    => 'required|integer',
                'recipient_id' => 'required|integer',
                'subject'      => 'sometimes',
                'message'      => 'required',
            ];
        } elseif(in_array($this->method(), ['PATCH', 'PUT'])) {
            return [
                'subject' => 'sometimes',
                'message' => 'sometimes',
            ];
        }
    }
}
