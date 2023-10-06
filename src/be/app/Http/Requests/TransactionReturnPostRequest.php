<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionReturnPostRequest extends FormRequest
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
            "member_id" => "required|integer",
            "book_unit_ids" => "required|array",
            "book_unit_ids.*" => "required|integer",
        ];
    }
    
    public function messages()
    {
        return [
            "member_id.required" => "Required",
            "member_id.integer" => "Must be number",
            "book_unit_ids.required" => "Required",
            "book_unit_ids.*.integer" => "Must be number",
        ];
    }
}