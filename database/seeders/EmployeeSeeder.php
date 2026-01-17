<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = [
            [
                'name' => 'Lum Aboubacar',
                'email' => 'lum.a@company.com',
                'department' => 'IT',
                'phone_number' => '+237670123456',
                'biographical_information' => 'Senior software engineer with 10+ years of experience in web development and system design.',
            ],
            [
                'name' => 'Grace Amina',
                'email' => 'grace.a@company.com',
                'department' => 'HR',
                'phone_number' => '+237671234567',
                'biographical_information' => 'HR manager specializing in talent acquisition and employee relations.',
            ],
            [
                'name' => 'Diego Mensah',
                'email' => 'diego.m@company.com',
                'department' => 'Sales',
                'phone_number' => '+237672345678',
                'biographical_information' => 'Sales executive with expertise in B2B solutions and client management.',
            ],
            [
                'name' => 'Precious Osei',
                'email' => 'precious.o@company.com',
                'department' => 'Marketing',
                'phone_number' => '+237673456789',
                'biographical_information' => 'Marketing strategist focused on digital campaigns and brand development.',
            ],
            [
                'name' => 'Richard Tende',
                'email' => 'richard.t@company.com',
                'department' => 'Finance',
                'phone_number' => '+237674567890',
                'biographical_information' => 'Financial analyst with strong background in corporate finance and auditing.',
            ],
            [
                'name' => 'Muluh Njuma',
                'email' => 'muluh.n@company.com',
                'department' => 'Operations',
                'phone_number' => '+237675678901',
                'biographical_information' => 'Operations manager with expertise in process optimization and efficiency.',
            ],
            [
                'name' => 'Sandra Eyong',
                'email' => 'sandra.e@company.com',
                'department' => 'IT',
                'phone_number' => '+237676789012',
                'biographical_information' => 'Database administrator and IT support specialist with strong technical skills.',
            ],
        ];

        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
}
