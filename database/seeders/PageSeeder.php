<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $pages = ['Hakkımızda','Vizyon','Misyon','Kariyer'];
        $count = 0;
        foreach ($pages as $page)
        {
            $count++;
            DB::table('pages')->insert([
                'title' => $page,
                'slug' => Str::slug($page),
                'content' => "Ben yeni başlangıçlara inanıyorum arkadaşlar, her ne kadar hayatta her istediğimiz şey yolunda gitmese ve 2023’ü de bizim yılımız yapmak gerçekten elimizde. ihtiyacımız olan şey bakış açısını değiştirmek, hedefler koymak ve bunlara ulaşmak için plan yapmak. Buna süper 3lü diyorum ben. Biz burdaysak ve hayalimiz bir üst versiyonumuz burdaysa 2023 bu mesafeyi katetmek için bizim yılımız olabilir. ama nasıl? Plan, hedefler ve disiplinli heyecanlı bir çalışma ile. ",
                'image' => 'https://assets.entrepreneur.com/content/3x2/2000/20191127190639-shutterstock-431848417-crop.jpeg',
                'order' => $count,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
