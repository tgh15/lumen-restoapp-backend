<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User as UserTable;
use App\Models\Admin as AdminTable;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        UserTable::create([
            'email' => 'user@email.com',
            'password' => app('hash')->make('user12345678'),
            'name' => 'User 1',
        ]);
        AdminTable::create([
            'email' => 'admin@email.com',
            'password' => app('hash')->make('admin12345678'),
            'name' => 'Admin 1',
        ]);
    }
}
