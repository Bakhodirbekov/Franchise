<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInquiryRequest;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function store(StoreInquiryRequest $request)
    {
        try {
            $data = $request->validated();
            
            // Automatically set user_id if authenticated
            if (auth()->check()) {
                $data['user_id'] = auth()->id();
            }
            
            $inquiry = Inquiry::create($data);
            
            return back()->with('success', 'Your inquiry has been submitted successfully! We will contact you soon.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error submitting inquiry: ' . $e->getMessage());
        }
    }
}