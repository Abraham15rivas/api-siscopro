<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Decisor
        User::create([
            'name'          => 'Decisor',
            'email'         => 'decisor@test.com',
            'phone'         => '123456789',
            'dni'           => '123456789',
            'password'      => Hash::make('secret123'),
            'role_id'       => 1,
            'institution_id'=> 1
        ]);
    
        // Signatory
        User::create([
            'name'          => 'Signatory',
            'email'         => 'signatory@test.com',
            'phone'         => '123456789',
            'dni'           => '123456788',
            'password'      => Hash::make('secret123'),
            'role_id'       => 2,
            'institution_id'=> 1
        ]);
    }
}
