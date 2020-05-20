<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
        $rules = [
            'category_id' => 'required',
            'name' => ['required', 'string'],
            'description' => ['min:10', 'nullable'],
            'price' => ['required', 'numeric'],
            'quantity' => ['required', 'integer'],
            'select_value' => ['required', 'array'],
            'select_value.*' => 'required',
            'attr_value' => ['required_if:select_value.*,1', 'array'],
            'attr_value.*' => ['required_if:select_value.*,1']
        ];


        $addRule1 = $this->postMergeRule($rules, 'image', 'required|array');

        $finalRules = $this->postMergeRule($addRule1, 'image.*', 'required|image|mimes:jpeg,jpg,png');

        return $finalRules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return ['category_id.required' => 'Please select a category.'];
    }

    /**
     * If the method of the request is a POST,
     * then return the rules with additional rule
     *
     * @param array  $rules     Array of rules determined so far
     * @param string $attribute form element that will have rules applied
     * @param string $rule      the actual rule
     *
     * @return array            the array with the rule added, else the original
     */
    public function postMergeRule($rules, $attribute, $rule = [])
    {
        if ($this->method() == 'POST') {
            $rules = array_merge($rules, [$attribute => $rule]);
        }

        return $rules;
    }
}
