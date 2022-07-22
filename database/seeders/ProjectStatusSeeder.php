<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\models\ProjectStatus;

class ProjectStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ptojectStatus = ['status 1', 'status 2', 'status 3'];

        foreach ($ptojectStatus as $status) {
            ProjectStatus::create([
                'name'          => $status,
                'description'   => $status
            ]);
        }
    }
}
