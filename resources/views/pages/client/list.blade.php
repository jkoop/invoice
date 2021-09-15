@extends('layouts.loggedIn')
@section('content')

<div class="table-responsive">
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Active</th>
                <th>Out&shy;standing</th>
                <th>Balance</th>
                <th>Total Paid</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><a href="1">Jane Doe</a></td>
                <td><i class="disabled">none</i></td>
                <td><i class="disabled">none</i></td>
                <td>CAD 5.21</td>
                <td><a href="/payment/?client=1">CAD 5.21</a></td>
            </tr>
        </tbody>
    </table>
</div>

@endsection
