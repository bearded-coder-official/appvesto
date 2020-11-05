<?php

use Illuminate\Database\Seeder;

class SuperAdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Entities\SuperAdmin::create([
            'email' => 'compie',
            'name' => 'Compie',
            'password' => bcrypt(324432),
        ]);
    }
}
