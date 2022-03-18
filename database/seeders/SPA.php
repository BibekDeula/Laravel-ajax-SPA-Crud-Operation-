<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class SPA extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('cruds')->insert([
        'name'=>'Test',
        'address'=>'Test',
        'trending'=>0
       ]);
    }
}
