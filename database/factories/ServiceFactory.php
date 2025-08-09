<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    public function definition(): array
    {
        $type = $this->faker->randomElement(['Pengajuan Jasa', 'Alat Kesehatan']);
        
        $equipmentOptions = ['kursi roda', 'tabung oksigen', 'tandu lipat', 'tandu sekop', 'tenda'];
        
        return [
            'name' => $this->faker->name(),
            'nim' => $this->faker->unique()->numerify('#######'),
            'email'=> $this->faker->randomElement(['example@gmail.com', 'example2@gmail.com', 'example3@gmail.com']),
            'type'=> $type,
            'phone' => $this->faker->phoneNumber(),
            'line' => $this->faker->unique()->userName(),
            'organization' => $this->faker->company(),
            'title' => $this->faker->jobTitle(),
            'event_name' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'date' => $this->faker->date(),
            'start_time' => $this->faker->time(),
            'end_time' => $this->faker->time(),
            'location' => $this->faker->address(),
            'person' => $type === 'Pengajuan Jasa' ? $this->faker->numberBetween(1, 20) : null,
            'medical_equipment' => $type === 'Alat Kesehatan' 
                ? $this->faker->randomElements(
                    ['kursi roda', 'tabung oksigen', 'tandu lipat', 'tandu sekop', 'tenda'], 
                    $this->faker->numberBetween(1, 3)
                )
                : null,
            'note' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['Pending', 'On Progress', 'Completed', 'Canceled']),
        ];
    }
}