<?php

namespace App\Services;

use Talanoff\ImpressionAdmin\Helpers\NavDelimiter;
use Talanoff\ImpressionAdmin\Helpers\NavItem;

class Navigation
{
    public function frontend()
    {
        //
    }

    public function backend()
    {
        return [
            new NavItem([
                'name' => 'Users',
                'route' => 'users',
                'icon' => 'i-user'
            ]),
            new NavItem([
                'name' => 'Lots',
                'route' => 'lots',
                'icon' => 'i-newspaper'
            ])
        ];
    }
}
