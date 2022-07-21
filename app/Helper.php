<?php

use Illuminate\Http\UploadedFile;

if (!function_exists('makeFileName')) {
    function makeFileName(UploadedFile $file)
    {
        return Str::uuid()->toString().'.'.$file->getClientOriginalExtension();
    }
}

if(!function_exists('getNouvelColumn')) {
    function getNouvelColumn()
    {
        return [
            ['column' => 'id (laisser vide)', 'field' => ''],
            ['column' => 'num', 'field' => 'num'],
            ['column' => 'sous (Laisser vide)', 'field' => ''],
            ['column' => 'ordre (Laisser vide)', 'field' => ''],
            ['column' => 'artiste (non obligatoire)', 'field' => 'author'],
            ['column' => 'artiste_en (anglais)', 'field' => 'author'],
            ['column' => 'description 1 (français)', 'field' => ''],
            ['column' => 'description 2 (anglais)', 'field' => 'description'],
            ['column' => 'estimation basse', 'field' => 'low_estimate'],
            ['column' => 'estimation haute', 'field' => 'high_estimate'],
            ['column' => 'imagesSup (laisser vide)', 'field' => ''],
            ['column' => 'rendu (laisser vide)', 'field' => ''],
            ['column' => 'categories', 'field' => 'category'],
            ['column' => 'prix de départ (= prix de réserve - obligatoire)', 'field' => 'starting_price'],
        ];
    }
}