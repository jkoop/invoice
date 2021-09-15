@extends('layouts.loggedIn')
@section('content')

<div class="table-responsive">
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>Invoice Number</th>
                <th>Client Name</th>
                <th>Date Issued</th>
                <th>Date Due</th>
                <th>Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><a href="2021-001">2021-001</a></td>
                <td><a href="/client/1">Jane Doe</a></td>
                <td>2021 Sep 12</td>
                <td>2021 Sep 26</td>
                <td>CAD 5.21</td>
                <td>sent; awaiting payment</td>
            </tr>
        </tbody>
    </table>
</div>

@endsection
