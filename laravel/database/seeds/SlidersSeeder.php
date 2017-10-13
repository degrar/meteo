<?php
namespace Database\Seeds;

use App\Models\Content\Slider;
use Illuminate\Database\Seeder;

class SlidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            'top',
            'about_us',
        ];
        foreach($seeds as $seed) {
            Slider::create([ 'code' => $seed ]);
        }
    }
}
