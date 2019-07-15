@extends('layouts.app')

@section('content')


<div class="container-info">
    @if(session('success'))
    <div class="alert alert-success">{{session('success')}}</div>
    @endif
    <div class="panel panel-danger">
        <div class="panel-heading">

            <div class="page-info">
                <div class="title">

                    <h1> Clients Information!</h1>
                </div>
                <div class="add-btn">
                    <a href='{{ route("client.create") }}' class="btn btn-primary btn-lg">
                        <span class="fas fa-plus">ADD CLIENT</span></a>

                </div>
            </div>
        </div>
        <div class="well">
            <table class="table table-bordered">
                <thead>
                    <tr align="center">
                        <th>S-No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>City</th>
                        <th>Country</th>
                        <th>image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($clients)>0)
                    @foreach($clients as $key=>$client)
                    <tr align="center">
                        <td> {{ ++$key }}</td>
                        <td> {{ $client->name }}</td>
                        <td> {{ $client->email }}</td>
                        <td> {{ $client->city }}</td>
                        <td> {{ $client->country }}</td>
                        <td>
                            <img src="{{ $client->image }}" style="height:50px;width:70px"></td>
                        <td>{{ csrf_field() }}
                            <a href='{{ URL("client/{$client->id}") }}' class="btn btn-success"><span
                                    class="fas fa-eye"></span></a>&nbsp;&nbsp;
                            <a href='{{ route("client.edit", $client->id) }}' class="btn btn-primary"><span
                                    class="fas fa-edit"></span></a>&nbsp;&nbsp;
                            <form id="delete-user-form" action="{{ action('ClientController@destroy',$client->id) }}"
                                method="POST" style="display:inline">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit"
                                    onclick="event.preventDefault();confirm('Confirm Delete?')?document.getElementById('delete-user-form').submit():'';"
                                    class="btn btn-danger"><span class="fas fa-trash"></span></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>
    @else
    <p> No information found</p>
    @endif
</div>
@endsection
<style>
.page-info {
    display: flex;
    justify-content: space-between
}

.page-info>.add-btn {
    display: flex;
    justify-content: baseline;
    align-items: flex-end;
    margin-bottom: 15px;
    text-transform: uppercase;
}
</style>