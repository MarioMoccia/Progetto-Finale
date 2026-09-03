<?php

use App\Jobs\ResizeImage;
use Illuminate\Support\Facades\File;

test('it crops an image to the given dimensions', function () {
    $relativeDir = 'test-resize';
    $fileName = 'source.jpg';
    $absoluteDir = storage_path('app/public/'.$relativeDir);

    if (! is_dir($absoluteDir)) {
        mkdir($absoluteDir, 0755, true);
    }

    $im = imagecreatetruecolor(600, 400);
    imagejpeg($im, $absoluteDir.'/'.$fileName);

    (new ResizeImage($relativeDir.'/'.$fileName, 50, 50))->handle();

    $croppedPath = $absoluteDir.'/crop_50x50_'.$fileName;

    expect(file_exists($croppedPath))->toBeTrue();

    [$width, $height] = getimagesize($croppedPath);

    expect($width)->toBe(50)->and($height)->toBe(50);

    File::deleteDirectory($absoluteDir);
});
