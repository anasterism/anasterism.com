<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Mail\Mailer;
use \cebe\markdown\Markdown;

class ContactResource extends Controller
{

	
	public function store(ContactRequest $request, Contact $contact, Markdown $markdown, Mailer $mailer)
	{
		# grab array of submitted data
		$data = $request->all();

		# format message with markdown parser
		$data['message'] = $markdown->parse($data['message']);

		# email form data to sales
		$mailer->send('emails.contact',['data' => $data],function ($m) use ($data) {
			$m->to('sales@anasterism.com','Sales Team');
			$m->from($data['email'],$data['name']);
			$m->subject('New contact submission.');
		});

		$contact->name    = $request->get('name');
		$contact->company = $request->get('company');
		$contact->email   = $request->get('email');
		$contact->phone   = $request->get('phone');
		$contact->project = $request->get('types');

		if($contact->save()) {
			return ['success' => true];
		} else {
			return ['success' => false];
		}
	}

}
