@extends('layouts.loggedIn')
@section('content')

<ul>
    <li><a href="{{ route('setting.myAddress') }}">My Address</a></li>
    <li><a href="{{ route('setting.email') }}">Email</a></li>
    <li><a href="{{ route('setting.locale') }}">Locale</a></li>
    <li><a href="{{ route('setting.database') }}">Database</a></li>
</ul>

@endsection
