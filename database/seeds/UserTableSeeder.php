<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            [
                'name'=>'Super',
                'email'=>'super@email.com',
                'password'=>bcrypt('admin'),
                'is_permission'=>'1',

            ],
            [
                'name'=>'Admin',
                'email'=>'admin@email.com',
                'password'=>bcrypt('admin'),
                'is_permission'=>'2',

            ],
        ];
        DB::table('users')->insert($data);

    }
}
