<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 0; $i < 4;$i++)
        {
            $title = 'aria2 – İndirme Aracı';
            DB::table('posts')->insert([
               'category_id' => 1,
               'title' => 'aria2 – İndirme Aracı',
                'image' => 'resim',
                'content' => 'Eric meyer ve kızının hikayesini duydunuz mu? Eric Meyer ismini bilmiyorsanız bile eminim onun hazırladığı reset.css’i hepiniz kullanmışsınızdır',
                'slug' => Str::slug($title),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
