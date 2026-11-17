<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class CreatePatientCheckupDetailsSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        // Retrieve user ID from the users table
        $userId = DB::table('users')->where('email', 'admin@domain.com')->value('id');
        $patientId = DB::table('patients')->where('user_id', $userId)->value('id');

        $patient_checkup_id = DB::table('patient_checkups')->where(['user_id'=>$userId,'patient_id'=>$patientId])->value('id');

        // Create a patient with a foreign key to the users table
        DB::table('patient_checkup_details')->insert([
            'patient_checkup_id' => $patient_checkup_id,
            'name' => $faker->name,
            'description' => $faker->text,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('patient_checkup_details')->insert([
            'patient_checkup_id' => $patient_checkup_id,
            'name' => $faker->name,
            'description' => $faker->text,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('patient_checkup_details')->insert([
            'patient_checkup_id' => $patient_checkup_id,
            'name' => $faker->name,
            'description' => $faker->text,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('patient_checkup_details')->insert([
            'patient_checkup_id' => $patient_checkup_id,
            'name' => $faker->name,
            'description' => $faker->text,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('patient_checkup_details')->insert([
            'patient_checkup_id' => $patient_checkup_id,
            'name' => $faker->name,
            'description' => $faker->text,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('patient_checkup_details')->insert([
            'patient_checkup_id' => $patient_checkup_id,
            'name' => $faker->name,
            'description' => $faker->text,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        // Add more patients as needed
    }
}
?>
