<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ContactUsMessage;
use Illuminate\Http\Request;

class ContactusmessageController extends Controller
{
    public function index()
    {
        $messages = ContactUsMessage::all();
        return view('backend.contactusmessage.index', compact('messages'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        ContactUsMessage::create($validatedData);

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }

    public function destroy($id)
    {
        $message = ContactUsMessage::findOrFail($id);
        $message->delete();

        return redirect()->route('backend.contactusmessage.index')->with('success', 'Message deleted successfully.');
    }
}
