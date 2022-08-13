<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Validator; 

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Contact::all(); 
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
    public function store(Request $request)
    {

        $validator = Validator::make(
            $request->all(), [

                'fio' => 'required|min:5|max:50', 
                'addr' => 'required|min:5|max:50', 
                'email' => 'required|email|unique:contacts', 
                'phone' => 'required|digits_between:5,11|unique:contacts', 
                'subject' => 'required|unique:contacts|min:5|max:50', 
                'message' => 'required|min:5|max:1024', 

            ]
        ); 

        if($validator->fails()) {

            return [
                'status' => false, 
                'errors' => $validator->messages()
            ]; 

        }

        $contact = Contact::create([
            'fio' => $request->fio, 
            'addr' => $request->addr, 
            'email' => $request->email, 
            'phone' => $request->phone, 
            'subject' => $request->subject,  
            'message' => $request->message, 
        ]); 

        return [
            'status' => true, 
            'data' => $contact
        ]; 

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::find($id); 

        if(!$contact) {

            return response()->json([
                'status' => false, 
                'errors' => ['record not found']
            ])->setStatusCode(404);

        }

        return $contact; 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
