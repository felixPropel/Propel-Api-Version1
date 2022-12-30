<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddessOfTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pims_com_address_types')->insert(array(
            array(
                'address_of' => "Home",
            ),
            array(
                'address_of' => "Office",
            )
        ));
    }
}
