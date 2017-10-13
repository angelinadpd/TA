<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
        	[
        		'name' => 'AdminPembelian',
        		'display_name' => 'Admin pembelian',
        		'description' => 'Sebagian Akses'
        	],
        	[
        		'name' => 'AdminPenjualan',
        		'display_name' => 'Admin Penjualan',
        		'description' => 'Sebagian Akses'
        	],
        ];

        foreach ($role as $key => $value) {
        	Role::create($value);
        }
    }
}
