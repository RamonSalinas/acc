<?php

namespace Database\Seeders;

use App\Http\Traits\UserTrait;
use App\Models\User;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    use UserTrait;
    /**
     * The current Faker instance.
     *
     * @var \Faker\Generator
     */
    protected $faker;

    /**
     * Get a new Faker instance.
     *
     * @return \Faker\Generator
     */
    protected function withFaker()
    {
        return Container::getInstance()->make(Generator::class);
    }

    /**
     * Create a new seeder instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->faker = $this->withFaker();
    } 
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or update Super Admin
        $superAdmin = User::updateOrCreate(
            ['email' => 'superadmin@ims.com'], // Condição de atualização
            [
                'name' => $this->faker->firstName . ' ' . $this->faker->lastName,
                'email_verified_at' => now(),
                'password' => Hash::make(123456), // ajuste conforme necessário
                'is_active' => $this->USER_ACTIVE
            ]
        );

        $superAdmin->assignRole($this->SUPER_ADMIN, $this->ADMIN);

        // Create or update Admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@ims.com'], // Condição de atualização
            [
                'name' => $this->faker->firstName . ' ' . $this->faker->lastName,
                'email_verified_at' => now(),
                'password' => Hash::make(123456), // ajuste conforme necessário
                'is_active' => $this->USER_ACTIVE
            ]
        );

        $admin->assignRole($this->ADMIN);
    }
}
