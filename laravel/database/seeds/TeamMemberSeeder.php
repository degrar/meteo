<?php
namespace Database\Seeds;

use Illuminate\Database\Seeder;
use App\Models\Content\TeamMember;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            'Andrés Garcia Diaz',
            'Mª Rosario Martin Melchor',
        ];
        foreach($seeds as $seed) {
            TeamMember::create([ 'name' => $seed ]);
        }
    }
}
