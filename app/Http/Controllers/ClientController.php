<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\Client;

class ClientController extends Controller
{
    public $validations = ['name'=>'required',
    'email'=>'required|email',
    'company'=>'required',
    'city'=>'required',
    'country'=>'required'];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $clients = Client::all();
        return view('clients.index')->with('clients',$clients);
    }
    public function create()
    {
       
        return view('clients.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, $this->validations);

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
            $client->image = $url;
        }
        
    $client->save();

    return redirect()->route('client.index')->with('success','Client has been saved');
    }

    
    public function show($id)
    {
         $client = Client::find($id);
         return view('clients.show')->with('client',$client);

    }
    public function edit($id)
    {
        $client = Client::find($id);
        return view('clients.edit')->with('client',$client);

    }
    /**
     *  Updating User Client Info
     */

    public function update(Request $request, $id)
    {
        $this->validate($request, $this->validations);
         $name = $request->get("name");
         $email = $request->get("email");
         $company =  $request->get("company");
         $city =  $request->get("city");
         $country=  $request->get("country");
         $image =  $request->get("image");

        $data = compact("name", "email","company", "city", "country", "image");

        $client = Client::find($id);

        if(input::hasFile('image')){
            $file = input::file('image');
            $file->move(public_path().'/postpic/',
            $file->getClientOriginalName());
            $url = URL::to('/').'/postpic/'.$file->getClientOriginalName();
            $data["image"] = $url;    
        }


        $client->update($data);

        return redirect()->route('client.index')->with('success','Client has been updated');
    }

    public function destroy($id)
    {
        Client::where('id',$id)->delete();
        return redirect()->route('client.index')->with('success','Client has been deleted');
    }
}