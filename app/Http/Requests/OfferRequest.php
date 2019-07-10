<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     *
     */
    protected function prepareForValidation()
    {
        if ($meta = json_decode($this->meta, true)) {
            $this->merge([
                'meta' => $meta
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'owner_id'    => 'required|integer|min:1|exists:users,id',
            'name'        => 'required|regex:/[\w]+/u',
            'description' => 'sometimes',
            'address'     => 'sometimes',
            'postcode'    => 'sometimes',
            'town'        => 'sometimes',
            'meta'        => 'nullable|array',
        ];
    }
}
