<?php

namespace Database\Seeders;

use App\Models\listing;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //  \App\Models\User::factory(5)->create();

        $user=User::factory()->create([
            'name'=>'kihara nelson',
            'email'=>'nelki@gmail.com'
        ]);
         listing::factory(6)->create([
            'user_id'=>$user->id
         ]);

        //  listing::create([
        //     'title'=>'laravel senior Developer',
        //     'tags'=>'laravel,javascript',
        //     'company'=>'Nelki corp',
        //     'location'=>'kiambu',
        //     'email'=>'nelkiblog@nelki.com',
        //     'website'=>'http://www.nelkiblog.com',
        //     'description'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis ad beatae ducimus illo molestiae voluptatum nemo architecto delectus doloribus sint, fugiat autem corporis accusamus, ex minima quod quas iure sunt?'
        //  ]);
        //  listing::create([
        //     'title'=>'fullstack senior Developer',
        //     'tags'=>'laravel,javascript',
        //     'company'=>'Nelki corp',
        //     'location'=>'nairobi',
        //     'email'=>'nelkiblog@nelki.com',
        //     'website'=>'http://www.nelkiblog.com',
        //     'description'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis ad beatae ducimus illo molestiae voluptatum nemo architecto delectus doloribus sint, fugiat autem corporis accusamus, ex minima quod quas iure sunt?'
        //  ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
