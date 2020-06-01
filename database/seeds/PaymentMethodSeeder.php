<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'cash'],
            ['name' => 'pos'],
            ['name' => 'transfer']
        ];
        DB::table('payment_methods')->insert($data);
    }
}
