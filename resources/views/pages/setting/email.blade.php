@extends('layouts.loggedIn')
@section('content')

<form method="post" class="row g-3">
    <div class="col-12">
        <label for="email" class="form-label">From Display Name</label>
        <input id="email" name="email" type="name" class="form-control" placeholder="Billing, Doe and Co">
    </div>
    <div class="col-md-6">
        <label for="email" class="form-label">From Address</label>
        <input id="email" name="email" type="email" class="form-control" placeholder="no-reply@example.com" required>
    </div>
    <div class="col-md-6">
        <label for="email" class="form-label">Return-to Address</label>
        <input id="email" name="email" type="email" class="form-control" placeholder="billing@example.com">
    </div>
    <div class="col-md-6">
        <label for="email" class="form-label">SMTP Server Address</label>
        <input id="email" name="email" type="domain" class="form-control" placeholder="smtp.example.com" required>
    </div>
    <div class="col-md-4">
        <label for="email" class="form-label">Connection Security</label>
        <select class="form-select" required>
            <option value="none">None</option>
            <option value="start-tls">STARTTLS</option>
            <option value="ssl" selected>SSL/TLS</option>
        </select>
    </div>
    <div class="col-md-2">
        <label for="email" class="form-label">Port</label>
        <input id="email" name="email" type="number" class="form-control" placeholder="465" required>
    </div>
    <div class="col-md-4">
        <label for="email" class="form-label">Username</label>
        <input id="email" name="email" type="email" class="form-control" placeholder="no-reply@example.com">
    </div>
    <div class="col-md-4">
        <label for="email" class="form-label">Password</label>
        <input id="email" name="email" type="password" class="form-control">
    </div>
    <div class="col-md-4">
        <label for="email" class="form-label">Authentication Method</label>
        <select class="form-select" required>
            <option value="none">No authentication</option>
            <option value="normal" selected>Normal password</option>
            <option value="encrypt">Encrypted password</option>
            <option value="kerberos">Kerberos / GSSAPI</option>
            <option value="ntlm">NTLM</option>
        </select>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Save</button>
        <button name="send-test" class="btn btn-outline-primary">Save and send test email</button>
    </div>
</form>

@endsection
