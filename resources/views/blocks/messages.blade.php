<div id="messages">
    @foreach (session()->pull('messages', []) as $message)
        <div class="alert alert-{{ $message->type }}" role="alert">
            {{ $message->text }}
        </div>
    @endforeach
</div>
