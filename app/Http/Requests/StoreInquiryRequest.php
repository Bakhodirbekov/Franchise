<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInquiryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'franchise_id' => 'nullable|exists:franchises,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:30',
            'message' => 'required|string|max:2000',
        ];
    }
    
    public function messages()
    {
        return [
            'name.required' => 'Please enter your full name',
            'email.required' => 'Please enter your email address',
            'phone.required' => 'Please enter your phone number',
            'message.required' => 'Please enter your inquiry message',
        ];
    }
}