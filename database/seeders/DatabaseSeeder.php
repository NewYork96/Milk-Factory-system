<?php

namespace Database\Seeders;

use App\Models\Additive;
use App\Models\AdditiveStore;
use App\Models\coldstore;
use App\Models\DryStore;
use App\Models\MilkStore;
use App\Models\Product;
use App\Models\ProductionOrder;
use App\Models\ProductStore;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()

    {
        MilkStore::create([
            'milk' => '6000',
            'milkfat' => '500'
        ]);

        Drystore::create([
            'position' => 'a1',
            'occupied' => '1',
        ]); 
        Drystore::create([
            'position' => 'a2',
            'occupied' => '0',
        ]); 
        Drystore::create([
            'position' => 'a3',
            'occupied' => '1',
        ]); 
        Drystore::create([
            'position' => 'a4',
            'occupied' => '0',
        ]); 
        Drystore::create([
            'position' => 'a5',
            'occupied' => '1',
        ]); 
                
        Drystore::create([
            'position' => 'b1',
            'occupied' => '0',
        ]); 
        Drystore::create([
            'position' => 'b2',
            'occupied' => '0',
        ]); 
        Drystore::create([
            'position' => 'b3',
            'occupied' => '0',
        ]); 
        Drystore::create([
            'position' => 'b4',
            'occupied' => '0',
        ]); 
        Drystore::create([
            'position' => 'b5',
            'occupied' => '0',
        ]); 
        
        Coldstore::create([
            'position' => 'a1',
            'occupied' => '1',
        ]); 
        Coldstore::create([
            'position' => 'a2',
            'occupied' => '0',
        ]); 
        Coldstore::create([
            'position' => 'a3',
            'occupied' => '1',
        ]); 
        Coldstore::create([
            'position' => 'a4',
            'occupied' => '0',
        ]); 
        Coldstore::create([
            'position' => 'a5',
            'occupied' => '1',
        ]); 
                
        Coldstore::create([
            'position' => 'b1',
            'occupied' => '0',
        ]); 
        Coldstore::create([
            'position' => 'b2',
            'occupied' => '0',
        ]); 
        Coldstore::create([
            'position' => 'b3',
            'occupied' => '0',
        ]); 
        Coldstore::create([
            'position' => 'b4',
            'occupied' => '0',
        ]); 
        Coldstore::create([
            'position' => 'b5',
            'occupied' => '0',
        ]); 
        Coldstore::create([
            'position' => 'c1',
            'occupied' => '0',
        ]); 
        Coldstore::create([
            'position' => 'c2',
            'occupied' => '0',
        ]); 
        Coldstore::create([
            'position' => 'c3',
            'occupied' => '0',
        ]);
        Coldstore::create([
            'position' => 'c4',
            'occupied' => '0',
        ]);
        Coldstore::create([
            'position' => 'c5',
            'occupied' => '0',
        ]);

        Additive::create([
            'name' => 'cukor',
            'provider_id' => '1',
        ]);

        Additive::create([
            'name' => 'kakaó',
            'provider_id' => '1',
        ]);

        Additive::create([
            'name' => 'tejpor',
            'provider_id' => '1',
        ]);

        AdditiveStore::create([
            'additive_id' => '1',
            'dry_Store_id' => '3',
            'quantity' => '32',
        ]);

        AdditiveStore::create([
            'additive_id' => '2',
            'dry_Store_id' => '2',
            'quantity' => '30',
        ]);

        AdditiveStore::create([
            'additive_id' => '1',
            'dry_Store_id' => '5',
            'quantity' => '600',
            
        ]);


        Product::create([
            'product' => 'kis tejföl',
            'size' => '150',
            'price' => '400',
            'best_before' => '28',
            'milkfat' => '200',
    

        ]);

        Product::create([
            'product' => 'nagy tejföl',
            'size' => '325',
            'price' => '150',
            'best_before' => '30',
            'milkfat' => '200',


        ]);

        Product::create([
            'product' => 'vödrös tejföl',
            'size' => '750',
            'price' => '200',
            'best_before' => '25',
            'milkfat' => '200',

        ]);

        ProductStore::create([
            'product_id' => '2',
            'amount' => '150',
            'best_before' => '2020.03.10',
            'amount' => '1200',
            'coldstore_id' => '3',

        ]);

        ProductStore::create([
            'product_id' => '1',
            'amount' => '325',
            'best_before' => '2020.05.10',
            'amount' => '800',
            'coldstore_id' => '1',

        ]);

        ProductStore::create([
            'product_id' => '3',
            'amount' => '750',
            'best_before' => '2020.05.30',
            'coldstore_id' => '5',

        ]);

        ProductionOrder::create([
            'product_id' => '1',
            'milk' => '1000',
            'milkfat' => '200',
            'planned_amount' => '1000',
            'best_before' => '2021.09.10',

        ]);

        ProductionOrder::create([
            'product_id' => '2',
            'milk' => '500',
            'milkfat' => '200',
            'planned_amount' => '1000',
            'best_before' => '2021.09.15'
            
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@email.com',
            'password' => Hash::make('jelszo'),
            'id_card_number' => '526542bc',
            'phone_number' => '06301111111',
            'role_id' => 1
        ]);

        User::create([
            'name' => 'Kis Péter',
            'email' => 'kis@email.com',
            'password' => Hash::make('laravel1'),
            'phone_number' => '06301111111',
            'id_card_number' => '12368ah',
            'role_id' => 2
        ]);

        User::create([
            'name' => 'Ács Ferenc',
            'email' => 'acs@email.com',
            'password' => Hash::make('laravel1'),
            'phone_number' => '06301111111',
            'id_card_number' => '1234ah',
            'role_id' => 3
        ]);

        User::create([
            'name' => 'Tegzes Elelmér',
            'email' => 'tegzes@email.com',
            'password' => Hash::make('laravel1'),
            'phone_number' => '06301111111',
            'id_card_number' => '586842jk',
            'role_id' => 4
        ]);

        User::create([
            'name' => 'Nagy István',
            'email' => 'istvan@email.com',
            'password' => Hash::make('laravel1'),
            'phone_number' => '06301111111',
            'id_card_number' => '546542jk',
            'role_id' => 5
        ]);

        Role::create([
            'role' => 'admin',
            'user_id' => '1',
        ]);

        
        Role::create([
            'role' => 'raktár vezető',
            'user_id' => '2',
        ]);

        
        Role::create([
            'role' => 'termelés vezető',
            'user_id' => '3',
        ]);

        
        Role::create([
            'role' => 'művezető',
            'user_id' => '4',
        ]);

        
        Role::create([
            'role' => 'raktáros',
            'user_id' => '5',
        ]);
        
    }
}
