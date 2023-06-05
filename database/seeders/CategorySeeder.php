<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias=[
            'Naturaleza'=>'#145a32',
            'Urbana'=>'#566573',
            'Animales'=>'#943126',
            'Marinas'=>'#2e86c1',
            'Tecnológicas'=>'#f39c12'
        ];
        foreach($categorias as $n=>$c){
            Category::create([
                'nombre'=>$n,
                'color'=>$c
            ]);
        }
    }
}
