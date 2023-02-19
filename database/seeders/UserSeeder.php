<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
                'name' => 'user',
                'email' => 'user@user.com',
                'password' => Hash::make('12341234'),
                'role_id' => 1
            ],
            [
                'id' => '2',
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('12341234'),
                'role_id' => 2
            ],
        ]);

        $data = [];
        foreach ($collection as $val) {
          array_push($data, [
            'id' => $val['id'],
            'name' => $val['name'],
            'email' => $val['email'],
            'password' => $val['password'],
            'role_id' => $val['role_id']
          ]);
        }
        DB::table('users')->truncate();
        DB::table('users')->insert($data);
    }
}
