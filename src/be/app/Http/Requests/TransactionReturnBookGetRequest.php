<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionReturnBookGetRequest extends FormRequest
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
            "book_unit_id" => "required|integer",
            "member_id" => "required|integer",
        ];
    }
    
    public function messages()
    {
        return [
            "book_unit_id.required" => "Required",
            "book_unit_id.integer" => "Must be number",
            "member_id_id.required" => "Required",
            "member_id_id.integer" => "Must be number",
        ];
    }
}