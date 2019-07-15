<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return view('clients.index')->with('clients',$clients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validations = ['name'=>'required',
                        'email'=>'required|email',
                        'company'=>'required',
                        'city'=>'required',
                        'country'=>'required',
                        'image'=>'required'];
        $this->validate($request, $validations);
        // client::create($request->all());
        $client = new client();
        $client->name = $request->input('name');
        $client->email = $request->input('email');
        $client->company = $request->input('company');
        $client->city = $request->input('city');
        $client->country = $request->input('country');


        if(input::hasFile('image')){
            $file = input::file('image');
            $file->move(public_path().'/postpic/',
            $file->getClientOriginalName());
            $url = URL::to('/').'/postpic/'.$file->getClientOriginalName();
            // return $url;exit;
            $client->image = $url;


        $client->save();}
        return redirect()->route('client.index')->with('success','Client has been saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $client = Client::find($id);
         return view('clients.show')->with('client',$client);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::find($id);
        return view('clients.edit')->with('client',$client);

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
        $this->validate($request, ['name'=>'required',
        'email'=>'required|email',
        'company'=>'required',
        'city'=>'required',
        'country'=>'required',
        'image'=>'required']);

        $client = new client();
        $client->name = $request->input('name');
        $client->email = $request->input('email');
        $client->company = $request->input('company');
        $client->city = $request->input('city');
        $client->country = $request->input('country');

        if(input::hasFile('image')){
            $file = input::file('image');
            $file->move(public_path().'/postpic/',
            $file->getClientOriginalName());
            $url = URL::to('/').'/postpic/'.$file->getClientOriginalName();
            // return $url;exit;
            $client->image = $url;

        $data = ['name' => $client->name,'email' => $client->email,'company' => $client->company,
        'city' => $client->city,'country' => $client->country,'image' => $client->image];
        Client::where('id',$id)->update($data);}
        return redirect()->route('client.index')->with('success','Client has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Client::where('id',$id)->delete();
        return redirect()->route('client.index')->with('success','Client has been deleted');
    }
}