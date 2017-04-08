<?php

namespace App\Http\Controllers;

use App\Group;
use App\Contact;
use App\Message;
use Illuminate\Http\Request;
use App\Http\Requests\GroupRequest;
use App\Http\Requests\GroupMemberRequest;
use App\Http\Requests\GroupSendSmsRequest;
use DB;
use Nexmo;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $groups = Group::search($request->input('search'))
                        ->latest()
                        ->paginate(30)
                        ->appends('search', $request->input('search'));

        return view('group.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GroupRequest $request)
    {
        Group::create($request->all());

        session()->flash('alert', 'Success to added');

        return redirect()->route('group.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        $contacts = Contact::orderBy('name', 'asc')
            ->whereNotExists(function($query) use($group) {
                $query->select(DB::raw(1))
                    ->from('contact_group')
                    ->whereRaw("contact_group.contact_id = contacts.id");
            })
            ->get();

        return view('group.show', compact('group', 'contacts'));
    }

    /**
     * Store member of group.
     */
    public function storeMember(GroupMemberRequest $request, Group $group)
    {
        $group->contacts()->attach($request->all()['member']);

        session()->flash('alert', 'Success to added');

        return redirect()->route('group.show', $group->id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        $groups = Group::latest()->paginate(30);

        return view('group.index', compact('groups', 'group'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GroupRequest $request, Group $group)
    {
        $group->fill($request->all());
        $group->save();

        session()->flash('alert', 'Success to updated');

        return redirect()->route('group.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        $group->delete();

        session()->flash('alert', 'Success to deleted');

        return redirect()->route('group.index');
    }

    /**
     * Remove the member resource from storage.
     */
    public function destroyMember(Group $group, Contact $contact)
    {
        $group->contacts()->detach($contact->id);

        session()->flash('alert', 'Success to deleted');

        return redirect()->route('group.show', $group->id);
    }

    public function sendSms(GroupSendSmsRequest $request)
    {
        $group = Group::findOrFail($request->input('to'));

        if (count($group->contacts->count())) {
            foreach ($group->contacts as $contact) {
                $nexmo = Nexmo::message()
                ->send([
                    'to' => $contact->phoneNumber,
                    'from' => env('NEXMO_PHONE_NUMBER'),
                    'text' => $request->input('body')
                ]);

                $response['message-count'] = $nexmo['message-count'];
                $response['messages'] = $nexmo['messages'];
                $response['info'] = 'Group ' . $group->name;

                $message = new Message;
                $message->from = $nexmo['from'];
                $message->to = $nexmo['to'];
                $message->body = $nexmo['text'];
                $message->response = json_encode($response);
                $message->save();
            } 
            
            session()->flash('alertSender', 'Delivered');
        }

        return redirect()->route('contact.index');
    }
}
