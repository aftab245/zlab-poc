@extends('layouts.app')

@section('content')


<div class="container-info">

    <div class="page-info">
        <div class="title">
            @if(session('success'))
            <div class="alert alert-success">{{session('success')}}</div>
            @endif
            <h1> Client Information!</h1>
        </div>
        <div class="add-btn">
            <a href='{{ route("client.create") }}' class="btn btn-primary btn-lg"><span class="fas fa-plus">
                    ADD CLIENT</span></a>

        </div>

    </div>

    @if(count($clients)>0)
    @foreach($clients as $key=>$client)
    <div class="well">
        <table class="table table-border">
            <thead align="center">
                <th>S-No</th>
                <th>Name</th>
                <th>Email</th>
                <th>City</th>
                <th>Country</th>
                <th>image</th>
                <th>Action</th>

            </thead align="center">
            <tbody>
                <td> {{ ++$key }}</td>
                <td> {{ $client->name }}</td>
                <td> {{ $client->email }}</td>
                <td> {{ $client->city }}</td>
                <td> {{ $client->country }}</td>
                <td> <img src="{{ $client->image }}" style="height:70px;width:70px"></td>
                <td>{{ csrf_field() }}
                    <a href='{{ URL("client/{$client->id}") }}'><span class="fas fa-eye"></span></a>&nbsp;&nbsp;
                    <a href='{{ route("client.edit", $client->id) }}'><span class="fas fa-edit"></span></a>&nbsp;&nbsp;
                    <a href='{{ route("client.destroy", $client->id) }}'><span
                            class="fas fa-trash"></span></a>&nbsp;&nbsp;
                    <!-- <a href='#' data-action='{{ route("client.destroy", $client->id) }}' id="delete-client"
                        rel="{{$client->id}}"><span class="fas fa-trash"></span></a>&nbsp;&nbsp; -->

                </td>
            </tbody>

        </table>

    </div>
    @endforeach
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
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    $(document).on("click", "#delete-client", function(event) {
        let clientId = $(this).attr("rel");
        let action = $(this).data("action");
        let _token = $("input[name=_token]").val();
        console.log("I am clicked", action)

        $.ajax({
            url: action,
            method: 'delete',
            data: {
                _token
            },
            cache: false,
            success: function(response) {
                alert("Successfully deleted")
            }
        });
    })
})
</script>