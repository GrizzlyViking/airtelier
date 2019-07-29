<?php

namespace App\Http\Requests;

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

        if (!$this->has('owner_id') && $this->has('owner')) {
            $this->merge(['owner_id' => Arr::get($this->get('owner'), 'id', 1)]);
        }

        if (!$this->has('type_id') && $this->has('offer_type')) {
            $this->merge(['type_id' => Arr::get($this->get('offer_type'), 'id', 1)]);
        }

        if ($this->has('address') && $address = collect($this->get('address'))) {
            if(->has('country'));
            $this->merge(['country_code' => '']);
        }

        dd();
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
            'post_code'    => 'sometimes',
            'town'        => 'sometimes',
            'meta'        => 'nullable|array',
        ];
    }
}
