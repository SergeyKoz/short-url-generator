<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenerateUrlRequest extends FormRequest
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
        $this->redirect = url()->previous();
        $rules = [
            'url' => 'required',
            'expired' => 'nullable|date_format:Y-m-d|after:today'
        ];

        if($this->input('isCustom') == 'yes'){
            $rules['customUrl'] = 'unique:urls,hash|min:5';
        }

        return $rules;
    }
}
