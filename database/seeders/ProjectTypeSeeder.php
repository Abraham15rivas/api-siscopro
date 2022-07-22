<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\models\ProjectType;

class ProjectTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ptojectTypes = ['type 1', 'type 2', 'type 3'];

        foreach ($ptojectTypes as $type) {
            ProjectType::create([
                'name'          => $type,
                'description'   => $type
            ]);
        }
    }
}
