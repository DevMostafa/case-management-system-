<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class,15)->create();
        factory(App\Models\Victim::class,30)->create();

        factory(App\Models\Service::class,15)->create();


    }
}
