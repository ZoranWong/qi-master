<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Master;
use Faker\Generator as Faker;

class FavoritesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = app(Faker::class);
        $users = User::all();
        $users->map(function (User $user) use($faker){
            $masters = [];
            gmp_random_seed(time());
            $count = random_int(1, 10);
            for($i = 0; $i < $count; $i ++){
                $master = Master::inRandomOrder()->first();
                $favorite = [
                    'master_id' => $master->id,
                    'remark' => $faker->text(124)
                ];
                $masters[] = $favorite;
            }
            $user->favouriteMasters()->sync($masters);
        });
    }
}
