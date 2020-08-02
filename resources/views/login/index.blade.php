@extends('master')

@section('content')
    <h2 class="mt-5">Login</h2>
    <form method="POST" action="/login">
        {{ csrf_field() }}

        <div class="form-group">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
        </div>

        <div class="form-group">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }} <br />
                @endforeach
            </div>
        @endif
    </form>

@endsection