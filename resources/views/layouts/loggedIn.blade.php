<!doctype html>
<html lang="en">

@include('blocks.head')

<body>
    @include('blocks.navigation')

    <div id="content">
        {{-- @include('blocks.alerts') --}}
        {{-- @include('blocks.messages') --}}

        <h1>{{ Breadcrumbs::pageTitle() }}</h1>

        @yield('content')

        <hr>
        <address>
            {{ request()->getHost() }} - <a target="_blank" href="https://github.com/jkoop/invoice">Invoice</a> v0.1.0
        </address>
    </div>
</body>

</html>
