<?php

use App\Jobs\RemoveFaces;

test('it does nothing when the image no longer exists', function () {
    $result = (new RemoveFaces(999999))->handle();

    expect($result)->toBeNull();
});
