<?php

namespace App\Http\Controllers\Api;

use App\Models\Lead;
use App\Mail\MailToLead;
use App\Mail\MailToAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    private $validations = [
        'name' => 'required|string|max:50|min:5',
        'email' => 'required|email|max:255',
        'message' => 'required|string',
        'newsletter' => 'required|boolean',
    ];
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json($request->all()); solo per testare
        $data = $request->all();
        // validare i dati del lead
        $validator = Validator::make($data, $this->validations);

        if ($validator->fails()) {
            return response()->json([
                'success'   => false,
                'errors'    => $validator->errors(),
            ]);
        }

        // salvare i dati del lead nel database

        $newLead = new Lead();
        $newLead->email = $data['email'];
        $newLead->name = $data['name'];
        $newLead->message = $data['message'];
        $newLead->newsletter = $data['newsletter'];
        $newLead->save();

        // inviare la mail al lead
        Mail::to($newLead->email)->send(new MailToLead($newLead));

        // inviare la mail all'amministratore per gestire la richiesta del lead
        Mail::to(env('ADMIN_ADDRESS', 'admin@boolpress.com'))->send(new MailToAdmin($newLead));

        // ritornare un valore di conferma al frontend
        return response()->json([
            'success' => true,
        ]);
    }
    
}
