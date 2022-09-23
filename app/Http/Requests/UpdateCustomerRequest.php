<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() {
        return [
            'name' => ['required', 'max:64'],
            'kana' => ['required', 'regex:/^[ァ-ヾ]+$/u', 'max:64'],
            'tel' => ['required', 'max:20'],
            'email' => ['required', 'email', 'max:255'],
            'postcode' => ['required', 'max:7'],
            'address' => ['required', 'max:128'],
            'birthday' => ['date'],
            'gender' => ['required'],
            'memo' => ['max:1024'],
        ];
    }
}
