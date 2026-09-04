<?php

use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionSafeSearch;

test('the safe search job does nothing when the image no longer exists', function () {
    $result = (new GoogleVisionSafeSearch(999999))->handle();

    expect($result)->toBeNull();
});

test('the label image job does nothing when the image no longer exists', function () {
    $result = (new GoogleVisionLabelImage(999999))->handle();

    expect($result)->toBeNull();
});
