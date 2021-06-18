<?php

namespace Database\Seeders;

use App\Models\Coffee;
use Illuminate\Database\Seeder;

class CoffeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coffees = [
            [
                'name' => 'Monster Ultra Sunrise',
                'serving' => '75',
                'description' => 'A refreshing orange beverage that has 75mg of caffeine per serving. Every can has two servings.'
            ],
            [
                'name' => 'Black Coffee',
                'serving' => '95',
                'description' => 'The classic, the average 8oz. serving of black coffee has 95mg of caffeine.'
            ],
            [
                'name' => 'Americano',
                'serving' => '77',
                'description' => 'Sometimes you need to water it down a bit... and in comes the americano with an average of 77mg. of caffeine  per serving.'
            ],
            [
                'name' => 'Sugar free NOS',
                'serving' => '130',
                'description' => 'Another orange delight without the sugar. It has 130 mg. per serving and each can has two servings.'
            ],
            [
                'name' => '5 Hour Energy',
                'serving' => '200',
                'description' => 'And amazing shot of get up and go! Each 2 fl. oz. container has 200mg of caffeine to get you going.'
            ]
        ];

        foreach ($coffees as $coffee) {
            Coffee::create($coffee);
        }
    }
}
