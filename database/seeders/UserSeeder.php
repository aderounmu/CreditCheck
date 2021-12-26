<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            [
                'name'=>'yam',
                'email'=>'yam@yam.com',
                'password'=>Hash::make('yam123'),
                'isAdmin' => '0',
                "updated_at" => Carbon::now(),
                "created_at" => Carbon::now()
            ],
            [
                'name'=>'admin',
                'email'=>'admin@admin.com',
                'password'=>Hash::make('admin123'),
                'isAdmin' => '1',
                "updated_at" => Carbon::now(),
                "created_at" => Carbon::now()
            ]
        ]);
    }
}
