<?php
namespace Database\Seeds;

use Illuminate\Database\Seeder;
use App\Models\Content\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            'Implantes',
            'Cirugia Oral',
            'Periodoncia',
            'Cirugia mínimamente invasiva',
            'Estética dental',
            'Diagnóstico',
            'Esterilización y desinfección',
            'Tratamientos sin dolor, sedación consciente',
            'Segunda opinión',
            'Calidad de servicios y humana',
        ];
        foreach($seeds as $seed) {
            Service::create([ 'name' => $seed ]);
        }
    }
}
