<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = 'Ade Prast';
        $user->email = 'adecma18@gmail.com';
        $user->password = bcrypt('rahasia');
        $user->save();
    }
}
