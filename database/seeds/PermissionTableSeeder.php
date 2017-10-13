<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $permission = [
	    	// Role
	        	[
	        		'name' => 'role-list',
	        		'display_name' => 'Display Role Listing',
	        		'description' => 'index role'
	        	],
	        	[
	        		'name' => 'role-create',
	        		'display_name' => 'Create Role',
	        		'description' => 'Create New Role'
	        	],
	        	[
	        		'name' => 'role-edit',
	        		'display_name' => 'Edit Role',
	        		'description' => 'Edit Role'
	        	],
	        	[
	        		'name' => 'role-delete',
	        		'display_name' => 'Delete Role',
	        		'description' => 'Delete Role'
	        	],
	        // User
	        	[
	        		'name' => 'user-list',
	        		'display_name' => 'Display User Listing',
	        		'description' => 'See only Listing Of User'
	        	],
	        	[
	        		'name' => 'user-create',
	        		'display_name' => 'Create User',
	        		'description' => 'Create New User'
	        	],
	        	[
	        		'name' => 'user-edit',
	        		'display_name' => 'Edit User',
	        		'description' => 'Edit User'
	        	],
	        	[
	        		'name' => 'user-delete',
	        		'display_name' => 'Delete User',
	        		'description' => 'Delete User'
	        	],
	        // Barang
	        	[
	        		'name' => 'barang-list',
	        		'display_name' => 'Display Barang Listing',
	        		'description' => 'See only Listing Of Barang'
	        	],
	        	[
	        		'name' => 'barang-create',
	        		'display_name' => 'Create Barang',
	        		'description' => 'Create New Barang'
	        	],
	        	[
	        		'name' => 'barang-edit',
	        		'display_name' => 'Edit Barang',
	        		'description' => 'Edit Barang'
	        	],
	        	[
	        		'name' => 'barang-delete',
	        		'display_name' => 'Delete Barang',
	        		'description' => 'Delete Barang'
	        	],
	        // Pemesanan
	        	[
	        		'name' => 'pemesaan-list',
	        		'display_name' => 'Display Pemesanan Listing',
	        		'description' => 'See only Listing Of Pemesanan'
	        	],
	        	[
	        		'name' => 'pemesaan-create',
	        		'display_name' => 'Create Pemesanan',
	        		'description' => 'Create New Pemesanan'
	        	],
	        	[
	        		'name' => 'pemesaan-edit',
	        		'display_name' => 'Edit Pemesanan',
	        		'description' => 'Edit Pemesanan'
	        	],
	        	[
	        		'name' => 'pemesaan-delete',
	        		'display_name' => 'Delete Pemesanan',
	        		'description' => 'Delete Pemesanan'
	        	],
	        // Realisasi
	        	[
	        		'name' => 'realisasi-list',
	        		'display_name' => 'Display Realisasi Listing',
	        		'description' => 'See only Listing Of Realisasi'
	        	],
	        	[
	        		'name' => 'realisasi-edit',
	        		'display_name' => 'Edit Realisasi',
	        		'description' => 'Edit Realisasi'
	        	],
	        	[
	        		'name' => 'realisasi-delete',
	        		'display_name' => 'Delete Realisasi',
	        		'description' => 'Delete Realisasi'
	        	],
	        // Penjualan
	        	[
	        		'name' => 'penjualan-list',
	        		'display_name' => 'Display Penjualan Listing',
	        		'description' => 'See only Listing Of Penjualan'
	        	],
	        	[
	        		'name' => 'penjualan-create',
	        		'display_name' => 'Create Penjualan',
	        		'description' => 'Create New Penjualan'
	        	],
	        	[
	        		'name' => 'penjualan-edit',
	        		'display_name' => 'Edit Penjualan',
	        		'description' => 'Edit Penjualan'
	        	],
	        	[
	        		'name' => 'penjualan-delete',
	        		'display_name' => 'Delete Penjualan',
	        		'description' => 'Delete Penjualan'
	        	],
	        	[
	        		'name' => 'penjualan-cetak-faktur',
	        		'display_name' => 'cetak Penjualan',
	        		'description' => 'cetak Penjualan'
	        	],
	        	[
	        		'name' => 'penjualan-cetak-suratjalan',
	        		'display_name' => 'cetak Penjualan',
	        		'description' => 'cetak Penjualan'
	        	]
	        ];

	        foreach ($permission as $key => $value) {
	        	Permission::create($value);
	        }
    }
}
