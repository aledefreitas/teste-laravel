<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserAttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_attributes')->insert([
            'attribute' => 'razao_social',
            'label' => 'Razão Social',
        ]);

        DB::table('user_attributes')->insert([
            'attribute' => 'fantasia',
            'label' => 'Nome Fantasia',
        ]);

        DB::table('user_attributes')->insert([
            'attribute' => 'nome',
            'label' => 'Nome',
        ]);

        DB::table('user_attributes')->insert([
            'attribute' => 'sobrenome',
            'label' => 'Sobrenome',
        ]);
    }
}
