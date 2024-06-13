<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class WisataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $nama_siswa = $this->faker->name();
        return [
            'nis'   => $this->faker->sentence(),
            'nama_siswa' => $nama_siswa,
            'kelas_id'    => mt_rand(1, 13),
            'jenis_kelmin'   => $this->faker->sentence(),
            'agama'  => $this->faker->sentence(),
            'almat'   => $this->faker->sentence(),
            
           
        ];
    }
}