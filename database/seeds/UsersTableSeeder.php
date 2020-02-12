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
      $users = [ 
          [
            'name' => 'System Admin',
            'email' => 'sysad@schedulerapp.com',
            'password' => Hash::make('123123123'),
            'id_number' => 0,
            'course' => 1,
            'age' => '20',
            'isConfirmed' => 1
        ],
        [
            'name' => 'Vince',
            'email' => 'vince@gmail.com',
            'password' => Hash::make('123123123'),
            'id_number' => 401589,
            'course' => 'BSCS',
            'age' => '23',
            'isConfirmed' => 1
        ]
            ];
            \DB::table('users')->insert($users);
    }
}
