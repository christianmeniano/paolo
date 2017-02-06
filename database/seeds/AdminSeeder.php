<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('admins')->truncate();

        $admins = [
        				['name' => 'Admin','email' => 'admin123@gmail.com', 'password' => Hash::make('admin123')]

        			];

        DB::table('admins')->insert($admins);
    }
}
