<?php

use Illuminate\Database\Seeder;
use App\Contact;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $phone = [
        	['name' => 'Ade Prast', 'phoneNumber' => '6281952892690']
        ];

        foreach ($phone as $data) {
        	$p = new Contact;
        	$p->name = $data['name'];
        	$p->phoneNumber = $data['phoneNumber'];
        	$p->save();
        }
    }
}
