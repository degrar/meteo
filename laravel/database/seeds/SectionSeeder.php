<?php
namespace Database\Seeds;

use Illuminate\Database\Seeder;
use App\Models\Content\Section;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            'About Us',
            'Team',
            'Privacy Policy',
            'Cookies Policy',
        ];
        foreach($seeds as $seed) {
            Section::create([ 'name' => $seed ]);
        }
    }
}