<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //Show all contacts
    public function index()
    {
        $contacts = Contact::all();
        return view('contacts.index', compact('contacts'));
    }

    // Show create form
    public function create()
    {
        return view('contacts.create');
    }

    // Store contact
   public function store(Request $request)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'last_name' => 'required|string|max:255',
        'phone' => 'required|string|max:11',
        'email' => 'nullable|email|max:255',
        'facebook' => 'nullable|string|max:255',
        'instagram' => 'nullable|string|max:255',
        'tiktok' => 'nullable|string|max:255',
        'twitter' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $imagePath = null;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('contacts', 'public');
    }

    Contact::create([
        'first_name' => $request->first_name,
        'middle_name' => $request->middle_name,
        'last_name' => $request->last_name,
        'phone' => $request->phone,
        'email' => $request->email,
        'facebook' => $request->facebook,
        'instagram' => $request->instagram,
        'tiktok' => $request->tiktok,
        'twitter' => $request->twitter,
        'image' => $imagePath,   // ← THIS MUST BE SAVED
    ]);

    return redirect()->route('contacts.index')->with('success', 'Contact added!');
}



    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'first_name'    => 'required|string|max:255',
            'middle_name'   => 'nullable|string|max:255',
            'last_name'     => 'required|string|max:255',
            'phone'         => 'required|string|max:11',
            'email'         => 'nullable|email|max:255',

            // Social Media
            'facebook'      => 'nullable|string|max:255',
            'instagram'     => 'nullable|string|max:255',
            'tiktok'        => 'nullable|string|max:255',
            'twitter'       => 'nullable|string|max:255',
        ]);

        $contact->update($request->all());

        return redirect()->route('contact.index')->with('success', 'Updated!');
    }

    // Delete contact
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Deleted!');
    }
}
