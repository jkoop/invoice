@extends('layouts.loggedIn')
@section('content')

<form method="post" class="row g-3" action="{{ route('setting.contactInfo.update') }}">
    @csrf

    <div class="col-md-6">
        <label for="email" class="form-label">Email Address</label>
        <input id="email" name="my-email" type="email" class="form-control" placeholder="johnd@example.com" value="{{ $myEmail }}">
    </div>
    <div class="col-md-6">
        <label for="phone" class="form-label">Phone Number</label>
        <input id="phone" name="my-phone" type="tel" class="form-control" placeholder="+12043260000" value="{{ $myPhone }}">
    </div>
    <div class="col-md-6">
        <label for="contact-name" class="form-label">Contact Name</label>
        <input id="contact-name" name="my-name" type="name" class="form-control" placeholder="John Doe, Billing Dept" value="{{ $myName }}">
    </div>
    <div class="col-md-6">
        <label for="company-name" class="form-label">Company Name</label>
        <input id="company-name" name="company-name" type="name" class="form-control" placeholder="Doe and Co" value="{{ $companyName }}">
    </div>
    <div class="col-12">
        <label for="address" class="form-label">Address</label>
        <input id="address" name="address" type="text" class="form-control" placeholder="1000 Example Rd" value="{{ $address }}">
    </div>
    <div class="col-12">
        <label for="address-2" class="form-label">Address 2</label>
        <input id="address-2" name="address-2" type="text" class="form-control" placeholder="Floor 4" value="{{ $address2 }}">
    </div>
    <div class="col-md-6">
        <label for="city" class="form-label">City</label>
        <input id="city" name="city" type="text" class="form-control" placeholder="Steinbach" value="{{ $city }}">
    </div>
    <div class="col-md-4">
        <label for="province" class="form-label">Province</label>
        <input id="province" name="province" type="text" class="form-control" placeholder="Manitoba" value="{{ $province }}">
    </div>
    <div class="col-md-2">
        <label for="postal-code" class="form-label">Postal Code</label>
        <input id="postal-code" name="postal-code" type="text" class="form-control" placeholder="R5G 1A1" value="{{ $postalCode }}">
    </div>
    <div class="col-12">
        <label for="country" class="form-label">Country</label>
        <input id="country" name="country" type="text" class="form-control" placeholder="Canada" value="{{ $country }}">
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>

@endsection
