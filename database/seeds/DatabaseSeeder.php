<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        $path = 'database/seeds/seederdata.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Insert data successful!');

        $this->call(UsersTableSeeder::class);
    }
}
