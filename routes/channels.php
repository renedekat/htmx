<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('comments', function () {
    return true;
});
