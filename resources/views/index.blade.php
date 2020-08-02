@extends('master')

@section('content')
    <h2 class="text-center mt-5">Welcome! Come and get your api access token</h2>
    <div class="row">

        <div class="col-md-6 mt-5">
            <h4>You Can Login Here</h4>
            <a href="/login">I have a token but I need more...</a>
        </div>
        <div class="col-md-6 mt-5">
            <h4>If You Are Not Registered Please Do So Here</h4>
            <a href="/register">I need one now...</a>
        </div>

    </div>
@endsection