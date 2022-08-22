<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tableName = 'users';

        $dummies = [
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'email' => 'admin@apps.com',
                'password' => bcrypt('admin12345'),
                'role' => 'admin',
            ],
            [
                'name' => 'Dummy',
                'username' => 'dummy',
                'email' => 'dummy@apps.com',
                'password' => bcrypt('dummy12345'),
                'role' => 'customer',
            ],
            [
                'name' => 'Capung',
                'username' => 'capung',
                'email' => 'capung@apps.com',
                'password' => bcrypt('capung12345'),
                'role' => 'customer',
            ],
        ];

        foreach ($dummies as $dummy) {
            $dummy['created_by'] = 'Migration';
            $dummy['updated_by'] = 'Migration';
            $dummy['created_at'] = now();
            $dummy['updated_at'] = now();

            DB::table($tableName)->insert($dummy);
        }
    }
}
