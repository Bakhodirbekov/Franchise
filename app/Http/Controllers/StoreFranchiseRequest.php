<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFranchiseRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'short_description' => 'required|string|max:255',
            'description' => 'required|string',
            'investment_min' => 'required|numeric|min:0',
            'investment_max' => 'required|numeric|min:0|gte:investment_min',
            'royalty' => 'required|numeric|min:0|max:100',
            'territory' => 'nullable|string|max:255',
            'requirements' => 'nullable|array',
            'status' => 'required|in:published,draft',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
        ];
    }
}