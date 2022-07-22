<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'surname' => 'Admin',
            'email' => 'admin@app.com',
            'password' => Hash::make('password'),
            'role' => User::ADMIN_ROLE,
            'country' => 'Ukraine',
            'city' => 'Zp',
            'address' => 'add',
            'post_code' => '12345',
            'phone' => '380681231234'
        ]);
    }
}
