<?php
namespace Database\Seeds;

use Illuminate\Database\Seeder;
use Backpack\Base\app\Http\Controllers\Auth\RegisterController;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            ['name'=>'Admin', 'email'=>'webmaster@morillas.com', 'password'=>'admin'],
        ];
        foreach($seeds as $seed) {
            $user_model_fqn = config('backpack.base.user_model_fqn');
            $user = new $user_model_fqn();

            return $user->create([
                'name'     => $seed['name'],
                'email'    => $seed['email'],
                'password' => bcrypt($seed['password']),
            ]);
        }
    }
}
