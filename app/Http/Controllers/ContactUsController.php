<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactUsRequest;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    // Create Contact Form
    public function index(Request $request)
    {
        return view('contact-us');
    }

    // Store Contact Form data
    public function store(StoreContactUsRequest $request)
    {
        //  Store data in database
        ContactUs::create($request->all());

        //  Send mail to admin
        \Mail::send('emails.contact-us', [
            'name'            => $request->get('name'),
            'email'           => $request->get('email'),
            'phone'           => $request->get('phone'),
            'subject'         => $request->get('subject'),
            'note'            => $request->get('note'),
        ], function($mail) use ($request){
            $mail->from($request->email);
            $mail->to('henryleeworld@gmail.com', __('Administrator'))->subject($request->get('subject'));
        });
        return back()->with('success', __('We have received your message and would like to thank you for writing to us.'));
    }
}
