@extends('layouts.loggedIn')
@section('content')

<form method="post" class="row g-3">
    <div class="col-md-6">
        <label for="email" class="form-label">Email Address</label>
        <input id="email" name="email" type="email" class="form-control" placeholder="johnd@example.com">
    </div>
    <div class="col-md-6">
        <label for="phone" class="form-label">Phone Number</label>
        <input id="phone" name="phone" type="tel" class="form-control" placeholder="+12043260000">
    </div>
    <div class="col-md-6">
        <label for="contact-name" class="form-label">Contact Name</label>
        <input id="contact-name" name="contact-name" type="name" class="form-control" placeholder="John Doe, Billing Dept">
    </div>
    <div class="col-md-6">
        <label for="company-name" class="form-label">Company Name</label>
        <input id="company-name" name="company-name" type="name" class="form-control" placeholder="Doe and Co">
    </div>
    <div class="col-12">
        <label for="address" class="form-label">Address</label>
        <input id="address" name="address" type="text" class="form-control" placeholder="1000 Example Rd">
    </div>
    <div class="col-12">
        <label for="address-2" class="form-label">Address 2</label>
        <input id="address-2" name="address-2" type="text" class="form-control" placeholder="Floor 4">
    </div>
    <div class="col-md-6">
        <label for="city" class="form-label">City</label>
        <input id="city" name="city" type="text" class="form-control" placeholder="Steinbach">
    </div>
    <div class="col-md-4">
        <label for="province" class="form-label">Province</label>
        <input id="province" name="province" type="text" class="form-control" placeholder="Manitoba">
    </div>
    <div class="col-md-2">
        <label for="postal-code" class="form-label">Postal Code</label>
        <input id="postal-code" name="postal-code" type="text" class="form-control" placeholder="R5G 1A1">
    </div>
    <div class="col-12">
        <label for="country" class="form-label">Country</label>
        <input id="country" name="country" type="text" class="form-control" placeholder="Canada">
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>

@endsection
