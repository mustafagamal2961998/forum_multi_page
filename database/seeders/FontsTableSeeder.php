<?php

namespace Database\Seeders;

use App\Models\Font;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FontsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Font::create([
            'name'=>'ArabicKufi',
            'extension'=>'ttf'
        ]);

        Font::create([
            'name'=>'Sarina-Regular',
            'extension'=>'ttf'
        ]);

        Font::create([
            'name'=>'Allison_Script',
            'extension'=>'otf'
        ]);
        Font::create([
            'name'=>'Arty Signature',
            'extension'=>'otf'
        ]);
        Font::create([
            'name'=>'Creattion Demo',
            'extension'=>'otf'
        ]);
        Font::create([
            'name'=>'DrSugiyama-Regular',
            'extension'=>'ttf'
        ]);
        Font::create([
            'name'=>'Holligate Signature Demo',
            'extension'=>'ttf'
        ]);
        Font::create([
            'name'=>'MonsieurLaDoulaise-Regular',
            'extension'=>'ttf'
        ]);
        Font::create([
            'name'=>'MrDafoe-Regular',
            'extension'=>'ttf'
        ]);
        Font::create([
            'name'=>'MrDeHaviland-Regular',
            'extension'=>'ttf'
        ]);
        Font::create([
            'name'=>'Southam Demo',
            'extension'=>'otf'
        ]);
    }
}
