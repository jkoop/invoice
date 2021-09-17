@extends('layouts.loggedIn')
@section('content')

<style>
    td {
        text-align: center;
    }

    td:first-of-type {
        text-align: left;
    }
</style>

<div class="table-responsive">
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>
                    Name
                    <span style="font-weight: 400">
                        <del>add new client</del>
                        <x-nyi/>
                    </span>
                </th>
                <th>Active</th>
                <th>Out&shy;standing</th>
                <th style="text-decoration: dotted underline" title="computed while ignoring active and outstanding invoices (0 - balance + active + outstanding = total owing)">Balance</th>
                <th>Total Paid</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
                <tr>
                    <td>
                        <a href="{{ route('client.byId', ['client' => $client->id]) }}">
                            {{ $client->name }}
                            @if($client->name != '' && $client->company_name != '') - @endif
                            {{ $client->company_name }}
                        </a>
                    </td>
                    <td>
                        {{-- {{ \App\Models\Currency::listToHumanReadableString($client->amountsActive()) }} --}}
                        <x-nyi/>
                    </td>
                    <td>
                        {{-- {{ \App\Models\Currency::listToHumanReadableString($client->amountsOutstanding()) }} --}}
                        <x-nyi/>
                    </td>
                    <td>
                        {{-- {{ \App\Models\Currency::listToHumanReadableString($client->amountsBalance()) }} --}}
                        <x-nyi/>
                    </td>
                    <td>
                        {{-- {{ \App\Models\Currency::listToHumanReadableString($client->amountsTotalPaid()) }} --}}
                        <x-nyi/>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
