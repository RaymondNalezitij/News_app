<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('admin_roles')->insert([
            'user_id' => '1',
            'is_admin_at' => 'global',
        ]);
    }
}
