<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Message;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\ContactSendSmsRequest;
use Nexmo;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $contacts = Contact::search($request->input('search'))
                        ->latest()
                        ->paginate(30)
                        ->appends('search', $request->input('search'));

        return view('contact.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        Contact::create($request->all());

        session()->flash('alert', 'Success to added');

        return redirect()->route('contact.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        $contacts = Contact::latest()->paginate(30);

        return view('contact.index', compact('contacts', 'contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(ContactRequest $request, Contact $contact)
    {
        $contact->fill($request->all());
        $contact->save();

        session()->flash('alert', 'Success to updated');

        return redirect()->route('contact.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        session()->flash('alert', 'Success to deleted');

        return redirect()->route('contact.index');
    }

    public function sendSms(ContactSendSmsRequest $request)
    {
        $nexmo = Nexmo::message()
            ->send([
                'to' => $request->input('to'),
                'from' => env('NEXMO_PHONE_NUMBER'),
                'text' => $request->input('body')
            ]);

        $response['message-count'] = $nexmo['message-count'];
        $response['messages'] = $nexmo['messages'];
        $response['info'] = 'Direct';

        $message = new Message;
        $message->from = $nexmo['from'];
        $message->to = $nexmo['to'];
        $message->body = $nexmo['text'];
        $message->response = json_encode($response);
        $message->save();

        session()->flash('alertSender', 'Delivered');

        return redirect()->route('contact.index');
    }
}
