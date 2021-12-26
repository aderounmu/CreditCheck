<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cards')->insert([
            [
            'wallet_id'=>'1',
            'Cardholder'=>'yam',   
            'provider'=>'VISA',         
            'PAN'=>'4929108054995403',            
            'exp_date'=>'11/2024', 
            "updated_at" => Carbon::now(),
            "created_at" => Carbon::now(),
            ],
            [
            'wallet_id'=>'1',
            'Cardholder'=>'yam',   
            'provider'=>'MASTERCARD',         
            'PAN'=>'5515221287328834',            
            'exp_date'=>'10/2026', 
            "updated_at" => Carbon::now(),
            "created_at" => Carbon::now(),
            ]
        ]);
    }
}
