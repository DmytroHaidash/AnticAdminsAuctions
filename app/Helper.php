<?php

use Illuminate\Http\UploadedFile;

if (!function_exists('makeFileName')) {
    function makeFileName(UploadedFile $file)
    {
        return Str::uuid()->toString().'.'.$file->getClientOriginalExtension();
    }
}