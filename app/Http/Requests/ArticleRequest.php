<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    use ParseJavascriptDateTrait;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->prepareDate('publish');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $isRequired = 'required';
        if ($this->method() !== 'POST') {
            $isRequired = 'sometimes';
        }


        return [
            'title' => "$isRequired",
            'sub_title' => "$isRequired",
            'resume' => "sometimes|nullable",
            'content' => "sometimes|nullable",
            'publish' => "sometimes|nullable|date",
        ];
    }
}
