<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class CreatePatientSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        // Retrieve user ID from the users table
        $userId = DB::table('users')->where('email', 'admin@domain.com')->value('id');

        // Create a patient with a foreign key to the users table
        DB::table('patients')->insert([
            'user_id' => $userId,
            'name' => $faker->name,
            'phone_number' => $faker->numerify('03##-#######'),
            'cnic' => $faker->numerify('####-#######-#'),
            'address' => $faker->address,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Add more patients as needed
    }
}
?>
