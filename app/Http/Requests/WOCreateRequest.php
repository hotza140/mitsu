<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WOCreateRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => 'required',
            'time' => 'required',
            'type' => 'required|string|max:255',
            'breakdown' => 'required|string|max:255',
            'air_model' => 'required',
            'wo_price' => 'required',
            'customer_id' => 'required',
        ];
    }
}
