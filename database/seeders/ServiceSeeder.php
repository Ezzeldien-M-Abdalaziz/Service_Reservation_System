<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $services = [
            'Business Consultation',
            'Life Coaching Session',
            'Laptop Repair',
            'Home Cleaning Service',
            'Personal Fitness Training',
            'Tax Preparation Assistance',
            'Therapy Session',
            'Resume Review & Career Advice',
            'Interior Design Consultation',
        ];
        foreach ($services as $service) {
            Service::create([
                'name' => $service,
                'description' => fake()->sentence(nbWords: 50),
                'price' => rand(100, 1000),
                'available' => rand(0, 1),
            ]);
        }
    }
}
