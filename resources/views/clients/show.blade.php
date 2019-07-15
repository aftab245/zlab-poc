@extends('layouts.app')

@section('content')

@if(count($client)>0)

<div class="well" style="width:70%;margin:auto">
    <h1> Client Biodata!</h1>
    <table class="table table-bordered">

        <tr>
            <th rowspan="7"><img src="{{ $client->image }}" style="height:300px;width:400px"></th>
        </tr>

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
    </table>
</div>

@else
<p> No information found</p>
@endif

@endsection