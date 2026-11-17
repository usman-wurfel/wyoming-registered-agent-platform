<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class CreatePatientCheckupSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        // Retrieve user ID from the users table
        $userId = DB::table('users')->where('email', 'admin@domain.com')->value('id');
        $patientId = DB::table('patients')->where('user_id', $userId)->value('id');

        // Create a patient with a foreign key to the users table
        DB::table('patient_checkups')->insert([
            'user_id' => $userId,
            'patient_id' => $patientId,
            'visiting_date' => date('Y-m-d'),
            'visiting_time' => time(),
            'fees' => $faker->numberBetween(200,800),
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Add more patients as needed
    }
}
?>
