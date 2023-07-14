<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use App\Notifications\ContactMessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewOrderNotification;

class ContactController extends Controller
{

    public function index()
    {
        return view('shop.contact');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|string|min:3|max:50',
            'email' =>'required|email' ,
            'subject'=>'required|string',
            'message'=> 'required|string',
            'phone'=> 'nullable|numeric',
        ]);

        $data['user_id'] = Auth::id();

        $Contact = Contact::create($data);

        //send notification to admin
        $user = User::where('type','=','super-admin')->first();
        $user->notify(new ContactMessageNotification($Contact));

        return redirect()->route('contact.index')
            ->with('success', "Thank you {{$Contact->name}} for Contact us ");
    }
}
