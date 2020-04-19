<?php

namespace App\Http\Requests;

use App\Http\Controllers\Utils;
use Illuminate\Foundation\Http\FormRequest;

class AirtimeRequest extends FormRequest
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
            'amount' => ['required', 'numeric','min:1','max:70000'],
            'saf' => ['required', 'regex:'.Utils::SAFARICOM_REGEX],
            'airtel' => ['required', 'regex:'.Utils::AIRTEL_REGEX],
        ];
    }

    public function messages()
    {
        return [
            'amount.required'=>'The airtime amount cannot be blank',
            'saf.regex'=>'Invalid Safaricom number',
            'airtel.regex'=>'Invalid Airtel number'
        ];

    }
}
