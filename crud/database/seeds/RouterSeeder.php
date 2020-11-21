<?php

use Illuminate\Database\Seeder;
// use Faker\Generator as Faker;

class RouterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $limit = env('n', 1);

        for ($i=0; $i < $limit; $i++) {
            $types = array(
                'AG1',
                'CSS',
            );
            shuffle($types);
            \DB::table('router_details')->insert([
                'sapid' => $faker->randomNumber(6),
                'hostname' => $faker->domainName,
                'loopback' => $faker->ipv4,
                'macaddress' => $faker->macAddress,
                'routertype' => reset($types)
            ]);
        }
    }
}
