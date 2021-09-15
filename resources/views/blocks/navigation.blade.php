<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">{{ request()->getHost() }}</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link @if (request()->is('invoice*')) active @endif" href="/invoice">Invoice</a>
                <a class="nav-link @if (request()->is('payment*')) active @endif" href="/payment">Payment</a>
                <a class="nav-link @if (request()->is('credit*')) active @endif" href="/credit">Credit</a>
                <a class="nav-link @if (request()->is('client*')) active @endif" href="/client">Client</a>
                <a class="nav-link @if (request()->is('setting*')) active @endif" href="/setting">Setting</a>
            </div>
        </div>
    </div>
</nav>

<nav class="navbar navbar-light bg-light" style="--bs-breadcrumb-divider: '›';" aria-label="breadcrumb">
    <div class="container-fluid">
        {{ Breadcrumbs::render() }}
    </div>
</nav>

{{-- <nav class="navbar navbar-light bg-light" style="--bs-breadcrumb-divider: '›';" aria-label="breadcrumb">
    <div class="container-fluid">
        <ol class="breadcrumb" style="margin:0">
            <li class="breadcrumb-item"><a href="$path/">$name</a></li>
        </ol>
    </div>
</nav> --}}
