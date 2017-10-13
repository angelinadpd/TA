<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_pembelian = Role::where('name', 'AdminPembelian')->first(); 

        $admin_pembelian = new User();
        $admin_pembelian->name = 'admin pembelian';
        $admin_pembelian->email = 'adminpembelian@gmail.com';
        $admin_pembelian->password = bcrypt('adminpembelian');
        $admin_pembelian->save();
        $admin_pembelian->roles()->attach($admin_pembelian);

        $admin_penjualan = Role::where('name', 'AdminPenjualan')->first(); 

        $admin_penjualan = new User();
        $admin_penjualan->name = 'admin penjualan';
        $admin_penjualan->email = 'adminpenjualan@gmail.com';
        $admin_penjualan->password = bcrypt('adminpenjulan');
        $admin_penjualan->save();
        $admin_penjualan->roles()->attach($admin_penjualan);
    }
}
