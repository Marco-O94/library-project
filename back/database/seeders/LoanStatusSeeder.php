<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LoanStatus;

class LoanStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'In sospeso',
                'color' => 'orange',
            ],
            [
                'name' => 'Consegnato',
                'color' => 'green',
            ],
            [
                'name' => 'Scaduto',
                'color' => 'gray',
            ],
        ];

        foreach ($roles as $role) {
            LoanStatus::create($role);
        }
    }
}
