@extends('master')

@section('content')

    <h2 class="mt-5 mb-5">Registered Tokens (<a href="/logout">Logout</a>)</h2>
    <a href="/token/add">Generate New Token</a>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Access Token</th>
            <th scope="col">Exp Date</th>
            <th scope="col">Remove</th>
        </tr>
        </thead>
        <tbody>
            @for ($i=0; $i < count ($tokens); $i++)
                <tr>
                    <th scope="row">{{ $tokens[$i]->id }}</th>
                    <td><input type="text" value="{{ $tokens[$i]->access_token }}"></td>
                    <td>{{ ($tokens[$i]->expires_at ) }}</td>
                    <td><a href="/token/remove/{{ $tokens[$i]->id }}"><img width="25" src="data:image/png;base64,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" alt=""></a></td>
                </tr>
            @endfor
        </tbody>
    </table>
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }} <br />
            @endforeach
        </div>
    @endif
    <h2 class="mt-10">Logs (Request Count {{ $requestCount }} )</h2>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">User ID</th>
            <th scope="col">Token ID</th>
            <th scope="col">Request Method</th>
            <th scope="col">Request Params</th>
            <th scope="col">Comments</th>
        </tr>
        </thead>
        <tbody>
        @for ($i=0; $i < count ($tokenLogs); $i++)
            <tr>
                <th scope="row">{{ $tokenLogs[$i]->id }}</th>
                <th scope="row">{{ $tokenLogs[$i]->user_id }}</th>
                <th scope="row">{{ $tokenLogs[$i]->token_id }}</th>
                <th scope="row">{{ $tokenLogs[$i]->request_method }}</th>
                <th scope="row">{{ $tokenLogs[$i]->request_params }}</th>
                <th scope="row">{{ $tokenLogs[$i]->comments }}</th>
            </tr>
        @endfor
        </tbody>
    </table>
@endsection