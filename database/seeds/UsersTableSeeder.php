<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            'name' => 'System Admin',
            'email' => 'sysad@schedulerapp.com',
            'password' => Hash::make('123123123'),
            'id_number' => 0,
            'isConfirmed' => 1
        ]);
    }
}
