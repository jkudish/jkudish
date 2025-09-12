<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }
    
    public function store(Request $request)
    {
        // Check honeypot field for spam
        if ($request->filled('website')) {
            // Silently reject spam submissions
            return redirect()->route('contact');
        }
        
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);
        
        // For now, we'll just flash a success message
        // In production, you'd send an email here
        
        return redirect()->route('contact')->with('success', 'Thank you for your message! I\'ll get back to you within 24-48 hours.');
    }
}