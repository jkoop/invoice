@extends('layouts.loggedIn')
@section('content')

<form method="post" class="row g-3">
    <div class="col-md-6">
        <label for="currency" class="form-label">Default Currency</label>
        <div class="input-group">
            <select class="form-select" name="currency" id="currency" onchange="updateCurrencyButtons()">
                @foreach ($currencies as $c)
                    <option value="{{ $c[2] }}">{{ $c[0] }}</option>
                @endforeach
            </select>

            <input type="radio" class="btn-check" name="currency-display" value="symbol" id="display-symbol" autocomplete="off" checked>
            <label class="btn btn-outline-primary" for="display-symbol"></label>

            <input type="radio" class="btn-check" name="currency-display" value="code" id="display-code" autocomplete="off">
            <label class="btn btn-outline-primary" for="display-code"></label>
        </div>
    </div>
    <div class="col-md-6">
        <label class="form-label">Numeric separators</label>
        <div class="input-group">
            <select class="form-select" name="thousands">
                <option value="comma" selected>1,000,000</option>
                <option value="period">1.000.000</option>
                <option value="space">1 000 000</option>
                <option value="none">1000000</option>
            </select>

            <select class="form-select" name="decimal">
                <option value="period" selected>0.01</option>
                <option value="comma">0,01</option>
            </select>

            <select class="form-select" name="thousandths">
                <option value="none" selected>0.0000001</option>
                <option value="space">0.000 000 1</option>
                <option value="comma">0.000,000,1</option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <label for="date-format" class="form-label">Date format</label>
        <select class="form-select" id="date-format" name="date-format">
            <option value="yyyy-mmm-dd-hh-mm" selected>1969 Dec 31 18:00</option>
            <option value="yyyy-mm-dd-hh-mm">1969-12-31 18:00</option>
            <option value="mmm-dd-yyyy-hh-mm">Dec 31 1969 18:00</option>
            <option value="dd-mmm-yyyy-hh-mm">31 Dec 1969 18:00</option>
        </select>
    </div>
    <div class="col-md-6">
        <label for="timezone-continent" class="form-label">Timezone</label>
        <div class="input-group">
            <select class="form-select" id="timezone-continent" name="timezone-continent" onchange="updateTimezoneCity()">
                @foreach ($timezoneContinents as $tz)
                    <option>{{ $tz }}</option>
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
	var listOfCurrencies = @json(getAssociativeListOfCurrencies());
	updateCurrencyButtons();

	function updateCurrencyButtons() {
		let currency = $('#currency option:selected').val();
        $('label[for=display-symbol]').text(listOfCurrencies[currency][1]);
        $('label[for=display-code]').text(listOfCurrencies[currency][2]);
	}

    var timezoneTree = @json($timezoneTree);
    updateTimezoneCity();

    function updateTimezoneCity() {
        let continent = $('#timezone-continent option:selected').text();
        $('#timezone-city').empty();

        timezoneTree[continent].forEach(function(city){
            $('#timezone-city').append('<option>');
            $('#timezone-city option:last').text(city);
        })
    }
</script>

@endsection
