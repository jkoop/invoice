@extends('layouts.loggedIn')
@section('content')

<ul>
    <li>
        <a href="{{ route('setting.contactInfo') }}">My Contact Info</a>
    </li>
    {{-- <li>
        <a href="{{ route('setting.email') }}">Outgoing Email</a>
    </li> --}}
    <li>
        <del>Outgoing Email</del>
        <x-nyi/>
    </li>
    <li>
        <a href="{{ route('setting.locale') }}">Locale</a>
    </li>
</ul>

@endsection
