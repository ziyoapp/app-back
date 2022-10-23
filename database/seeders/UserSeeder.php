<?php

namespace Database\Seeders;

use Amir\Permission\Models\Role;
use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'moderator']);
        Role::firstOrCreate(['name' => 'user']);

        User::factory(1)->create([
            'role_id' => UserRole::ADMIN,
            'email' => 'admin@bonus-app.uz',
            'first_name' => 'Admin',
            'last_name' => 'User',
            'password' => bcrypt('d7a[5{UNt`x/rbC-')
        ]);

        User::factory(1)->create([
            'role_id' => UserRole::MODERATOR,
            'email' => 'moderator@bonus-app.uz',
            'first_name' => 'Moderator',
            'last_name' => 'User',
            'password' => bcrypt('d7a[5{UNt`x/rbC-')
        ]);

        User::factory(1)->create([
            'role_id' => UserRole::USER,
            'email' => 'john@bonus-app.uz',
            'first_name' => 'John',
            'last_name' => 'Wick',
        ]);

        User::factory(10)->create([
            'role_id' => UserRole::USER
        ]);
    }
}
