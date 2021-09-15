@extends('layouts.loggedIn')
@section('content')

<p>
	These buttons are useful when developing and testing <a target="_blank" href="https://github.com/jkoop/invoice">Invoice</a>. They may also be useful when troubleshooting
</p>

<form method="post">
	<div class="card">
		<div class="card-body">
			Move the current database file to <code>backups/</code> and create a new one<br>
			<button type="submit" class="btn btn-primary" name="create-database">Create new empty database file</button>
			<button type="submit" class="btn btn-outline-primary" name="create-database">Create new and import default data</button>
		</div>
	</div>
</form>

@endsection
