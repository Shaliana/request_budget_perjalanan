<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collection = collect([
            [
                'id' => '1',
                'role_name' => 'User',
            ],
            [
                'id' => '2',
                'role_name' => 'Admin',
            ],
            [
                'id' => '3',
                'role_name' => 'Supervisor',
            ],
            [
                'id' => '4',
                'role_name' => 'Finance',
            ],
        ]);

        $data = [];
        foreach ($collection as $val) {
          array_push($data, [
            'id' => $val['id'],
            'role_name' => $val['role_name'],
          ]);
        }

        DB::table('roles')->truncate();
        DB::table('roles')->insert($data);
    }
}
