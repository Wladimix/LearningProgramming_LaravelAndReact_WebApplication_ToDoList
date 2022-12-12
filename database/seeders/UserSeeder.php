<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1
        DB::table('users')->insert([
            'name' => 'Владимир',
            'surname' => 'Максимов',
            'patronymic' => 'Владимирович',
            'login' => 'vladimir',
            'password' => Hash::make('11111111'),
            'leader_id' => null,
        ]);

        // 2
        DB::table('users')->insert([
            'name' => 'Эйчпи',
            'surname' => 'Дэсктопов',
            'patronymic' => 'Ноутбукович',
            'login' => 'hp',
            'password' => Hash::make('11111111'),
            'leader_id' => '1',
        ]);

        // 3
        DB::table('users')->insert([
            'name' => 'Визуал',
            'surname' => 'Студиов',
            'patronymic' => 'Майкрософтович',
            'login' => 'vs',
            'password' => Hash::make('11111111'),
            'leader_id' => '2',
        ]);

        // 4
        DB::table('users')->insert([
            'name' => 'Бэк',
            'surname' => 'Эндов',
            'patronymic' => 'Пэхэпэхович',
            'login' => 'php',
            'password' => Hash::make('11111111'),
            'leader_id' => '3',
        ]);

        // 5
        DB::table('users')->insert([
            'name' => 'Фронт',
            'surname' => 'Эндов',
            'patronymic' => 'Джаваскриптович',
            'login' => 'js',
            'password' => Hash::make('11111111'),
            'leader_id' => '3',
        ]);
        
        // 6
        DB::table('users')->insert([
            'name' => 'Фо',
            'surname' => 'Мышова',
            'patronymic' => 'Теховна',
            'login' => 'fortech',
            'password' => Hash::make('11111111'),
            'leader_id' => '2',
        ]);
    }
}

/* 
** Владимир Максимов Владимирович - руководитель
** Логин                          - vladimir
**
** Эйчпи Дэсктопов Ноутбукович    - ноутбук в подчинении руководителя
** Логин                          - hp
**
** Фо Мышова Теховна              - мышь в подчинении ноутбука
** Логин                          - fortech
**
** Визуал Студиов Майкрософтович  - программа в подчинении ноутбука
** Логин                          - vs
**
** Бэк Эндов Пэхэпэхович          - язык в подчинении программы
** Логин                          - php
**
** Фронт Эндов Джаваскриптович    - язык в подчинении программы
** Логин                          - js
*/
