<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
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
        $navigation = [
            new NavItem([
                'name' => 'Lots',
                'route' => 'lots',
                'icon' => 'i-newspaper'
            ])
        ];
        if(Auth::user()->hasRole('admin'))
        {
            $navigation[] = new NavItem([
                'name' => 'Users',
                'route' => 'users',
                'icon' => 'i-user'
            ]);
        }
        return $navigation;
    }
}
