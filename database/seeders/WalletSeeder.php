<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('wallets')->insert([
            [
                'user_id'=>'1',
               'amount_available'=>'100.00',
               'wallet_limit'=>'100.00',
               "updated_at" => Carbon::now(),
                "created_at" => Carbon::now(),
            ]
        ]);
    }
}
