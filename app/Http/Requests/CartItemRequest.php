<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class CartItemRequest extends FormRequest
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
	 * @throws ValidationException
	 */
    protected function prepareForValidation()
	{
		if ($this->has(['item_type', 'item_id'])) {
			if ( ! class_exists($this->get('item_type'))) {
				throw ValidationException::withMessages(['item_type' => ['Class '.$this->get('item_type') . ' does not exist']]);
			}
			if (!is_int($this->get('item_id'))) {
				throw ValidationException::withMessages(['item_id' => ['item_id is not an integer']]);
			}

			$this->merge([
				'item' => app($this->get('item_type'))->findOrFail($this->get('item_id'))
			]);
			$this->request->add([
				'item' => app($this->get('item_type'))->findOrFail($this->get('item_id'))
			]);
		}
	}

	/**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'item' => 'required',
			'quantity' => 'integer'
        ];
    }
}
