<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    use DatabaseTrait;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();
        $this->disableForeignKeys();
        $this->truncate('users');
        $defaultUsers = [
            [
                'id' => 0,
                'name' => 'System Admin',
                'email' => 'system@admin.com',
                'email_verified_at' => $now,
                'password' => bcrypt('supermost@admin.com'),
                'remember_token' => str_random(10),
                'active' => 1,
                'verify' => 1,
                'agree' => 1,
                'role' => 'all'
            ],
            [

                'name' => 'Supermost Admin',
                'email' => 'supermost@admin.com',
                'email_verified_at' => $now,
                'password' => bcrypt('supermost@admin.com'),
                'remember_token' => str_random(10),
                'active' => 1,
                'verify' => 1,
                'agree' => 1,
                'role' => 'all'
            ],
            [

                'name' => 'Account Manager',
                'email' => 'account@manager.com',
                'email_verified_at' => $now,
                'password' => bcrypt('account@manager.com'), // secret
                'remember_token' => str_random(10),
                'active' => 1,
                'verify' => 1,
                'agree' => 1,
                'role' => 'admin'
            ],
            [

                'name' => 'Guest',
                'email' => 'guest@admin.com',
                'email_verified_at' => $now,
                'password' => bcrypt('account@manager.com'), // secret
                'remember_token' => str_random(10),
                'active' => 1,
                'verify' => 1,
                'agree' => 1,
                'role' => 'admin'
            ]
        ];

        foreach ($defaultUsers as $user) {
            $role = $user['role'];
            unset($user['role']);

            $user = new \App\Entities\User($user);

            if ($role == 'all') {
                $user->assignRole(\App\Entities\Acl\Role\Role::all());
            } else {
                $user->assignRole($role);
            }

            $user->save();
        }

        factory(\App\Entities\User::class, 500)->create();


    }
}
