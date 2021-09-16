<?php

function setMessage(string $text, string $type = 'notice'): void {
    session()->push('messages', (object) [
        'text' => $text,
        'type' => $type,
    ]);
}
