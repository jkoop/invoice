@extends('layouts.loggedIn')
@section('content')

<form method="post" class="row g-3" action="{{ route('setting.locale.update') }}">
    @csrf

    <div class="col-md-6">
        <label for="currency" class="form-label">Default Currency</label>
        <div class="form-check form-switch" style="display: inline; float: right; white-space: nowrap">
            <input class="form-check-input" type="checkbox" name="use-metric-prefixes" id="use-metric-prefixes" @if($useMetricPrefixes) checked @endif>
            <label class="form-check-label" for="use-metric-prefixes">Use metric prefixes</label>
        </div>

        <div class="input-group">
            <select class="form-select" name="default-currency-code" id="currency" onchange="updateCurrencyButtons()">
                @foreach ($currencies as $currency)
                    <option value="{{ $currency->code }}" @if($defaultCurrencyCode == $currency->code) selected @endif>
                        {{ $currency->description }}
                    </option>
                @endforeach
            </select>

            <input type="radio" class="btn-check" name="default-currency-display" value="symbol" id="display-symbol" autocomplete="off"
                @if($defaultCurrencyDisplay == 'symbol') checked @endif>
            <label class="btn btn-outline-primary" for="display-symbol"></label>

            <input type="radio" class="btn-check" name="default-currency-display" value="code" id="display-code" autocomplete="off"
                @if($defaultCurrencyDisplay == 'code') checked @endif>
            <label class="btn btn-outline-primary" for="display-code"></label>
        </div>
    </div>
    <div class="col-md-6">
        <label class="form-label">Numeric separators</label>
        <div class="input-group">
            <select class="form-select" name="thousands-separator">
                <option value="comma" @if($thousandsSeparator == 'comma') selected @endif>1,000,000</option>
                <option value="period" @if($thousandsSeparator == 'period') selected @endif>1.000.000</option>
                <option value="space" @if($thousandsSeparator == 'space') selected @endif>1 000 000</option>
                <option value="none" @if($thousandsSeparator == 'none') selected @endif>1000000</option>
            </select>

            <select class="form-select" name="decimal-separator">
                <option value="period" @if($decimalSeparator == 'period') selected @endif>0.01</option>
                <option value="comma" @if($decimalSeparator == 'comma') selected @endif>0,01</option>
            </select>

            <select class="form-select" name="thousandths-separator">
                <option value="none" @if($thousandthsSeparator == 'none') selected @endif>0.0000001</option>
                <option value="space" @if($thousandthsSeparator == 'space') selected @endif>0.000 000 1</option>
                <option value="comma" @if($thousandthsSeparator == 'comma') selected @endif>0.000,000,1</option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <label for="date-format" class="form-label">Date format</label>
        <select class="form-select" id="date-format" name="date-format">
            <option value="Y M d H:i" @if($dateFormat == 'Y M d H:i') selected @endif>1969 Dec 31 18:00</option>
            <option value="Y-m-d H:i" @if($dateFormat == 'Y-m-d H:i') selected @endif>1969-12-31 18:00</option>
            <option value="M d Y H:i" @if($dateFormat == 'M d Y H:i') selected @endif>Dec 31 1969 18:00</option>
            <option value="d M Y H:i" @if($dateFormat == 'd M Y H:i') selected @endif>31 Dec 1969 18:00</option>
        </select>
    </div>
    <div class="col-md-6">
        <label for="timezone-continent" class="form-label">Timezone</label>
        <div class="input-group">
            <select class="form-select" id="timezone-continent" name="timezone-continent" onchange="updateTimezoneCity()">
                @foreach ($timezoneContinents as $continent)
                    <option @if($timezoneContinent == $continent) selected @endif>{{ $continent }}</option>
                @endforeach
            </select>
            <span class="input-group-text">/</span>
            <select class="form-select" id="timezone-city" name="timezone-city"></select>
        </div>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>

<script>
	var listOfCurrencies = @json($currenciesByCode);
	updateCurrencyButtons();

	function updateCurrencyButtons() {
		let currencyCode = $('#currency option:selected').val();
        $('label[for=display-symbol]').text(listOfCurrencies[currencyCode].symbol);
        $('label[for=display-code]').text(currencyCode);
	}

    var timezoneTree = @json($timezoneTree);
    updateTimezoneCity();

    function updateTimezoneCity() {
        let continent = $('#timezone-continent option:selected').text();
        $('#timezone-city').empty();

        timezoneTree[continent].forEach(function(city){
            $('#timezone-city').append('<option>');
            $('#timezone-city option:last').attr('selected', city == @json($timezoneCity));
            $('#timezone-city option:last').text(city);
        })
    }
</script>

@endsection
