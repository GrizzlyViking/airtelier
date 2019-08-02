<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class OfferRequest extends FormRequest
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
     *
     */
    protected function prepareForValidation()
    {
        if (is_array($meta = $this->meta) || $meta = json_decode($this->meta, true)) {
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
            'owner_id'    => 'required_without:owner|integer|min:1|exists:users,id',
            'owner'       => 'required_without:owner_id|array',
            'type_id'     => 'required_without:offer_type|integer|min:1|exists:offer_types,id',
            'offer_type'  => 'required_without:type_id|array',
            'address_id'  => 'required_without_all:address,post_code,country_code|integer|min:1|exists:addresses,id',
            'address'     => 'required_without:address_id|array',
            'name'        => 'required|regex:/[\w]+/u',
            'description' => 'sometimes',
            'meta'        => 'nullable|array',
        ];
    }

    public function messages()
    {
        return [
            'required_without' => ':attribute is required!',
            'owner_id.required_without' => 'You must specify an owner',
            'owner.required_without' => 'You must specify an owner',
            'type_id.required_without' => 'You must specify which type of offer this is',
            'offer_type.required_without' => 'You must specify which type of offer this is',
        ];
    }
}
