@extends('layouts.app')

@section('content')
<h1> Client Information!</h1>

@if(count($client)>0)

<div class="well">
    <table class="table">



        <tr>
            <th>Name</th>
            <td> {{ $client->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td> {{ $client->email }}</td>
        </tr>
        <tr>
            <th>Company</th>
            <td> {{ $client->company }}</td>
        </tr>
        <tr>
            <th>City</th>
            <td> {{ $client->city }}</td>
        </tr>
        <tr>
            <th>Country</th>
            <td> {{ $client->country }}</td>
        </tr>
        <tr>
            <th>Image</th>
            <td> <img src="{{ $client->image }}" style="height:70px;width:70px"></td>
        </tr>

    </table>
</div>

@else
<p> No information found</p>
@endif

@endsection