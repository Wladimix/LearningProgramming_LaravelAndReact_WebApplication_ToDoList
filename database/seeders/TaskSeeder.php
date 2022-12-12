<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            'title' => 'Сделать ToDoList',
            'description' => 'Для успешного выполнения задачи нужно распределить обязанности между программами ноутбука.',
            'expirationDate' => '2022-08-02 13:00:00',
            'dateOfCreation' => '2022-08-01 13:00:00',
            'updateDate' => '2022-08-01 13:00:00',
            'priority' => 'Высокий',
            'status' => 'Выполнена',
            'creator_id' => '1',
            'responsible_id' => '1',
        ]);

        DB::table('tasks')->insert([
            'title' => 'Посмотреть лекции по информатике',
            'description' => 'На ютубчике много хорошего контента. Нужно этим пользоваться по возможности.',
            'expirationDate' => '2022-08-02 13:00:00',
            'dateOfCreation' => '2022-08-01 13:00:00',
            'updateDate' => '2022-08-01 13:00:00',
            'priority' => 'Низкий',
            'status' => 'Выполняется',
            'creator_id' => '1',
            'responsible_id' => '1',
        ]);

        DB::table('tasks')->insert([
            'title' => 'Проделегировать полномочия своим программам',
            'description' => 'Каждый должен выполнять ту работу, для которой он сюда скачан.',
            'expirationDate' => '2022-12-01 13:00:00',
            'dateOfCreation' => '2022-08-02 13:00:00',
            'updateDate' => '2022-08-02 13:00:00',
            'priority' => 'Высокий',
            'status' => 'Выполнена',
            'creator_id' => '1',
            'responsible_id' => '2',
        ]);

        DB::table('tasks')->insert([
            'title' => 'Проверить обновления ПО',
            'description' => 'Ежегодный техосмотр для профилактики вирусов.',
            'expirationDate' => '2022-12-01 13:00:00',
            'dateOfCreation' => '2022-09-01 13:00:00',
            'updateDate' => '2022-09-01 13:00:00',
            'priority' => 'Средний',
            'status' => 'Выполнена',
            'creator_id' => '1',
            'responsible_id' => '2',
        ]);

        DB::table('tasks')->insert([
            'title' => 'Разобраться с логами спящего режима',
            'description' => 'Плохо спится последнее время.',
            'expirationDate' => '2022-12-31 13:00:00',
            'dateOfCreation' => '2022-10-01 13:00:00',
            'updateDate' => '2022-10-01 13:00:00',
            'priority' => 'Средний',
            'status' => 'Выполняется',
            'creator_id' => '2',
            'responsible_id' => '2',
        ]);

        DB::table('tasks')->insert([
            'title' => 'Разработать структуру приложения',
            'description' => 'Какие языки программирования будут использоваться?',
            'expirationDate' => '2022-12-01 13:00:00',
            'dateOfCreation' => '2022-09-01 13:00:00',
            'updateDate' => '2022-09-01 13:00:00',
            'priority' => 'Высокий',
            'status' => 'Выполнена',
            'creator_id' => '2',
            'responsible_id' => '3',
        ]);

        DB::table('tasks')->insert([
            'title' => 'Установить необходимые расширения',
            'description' => 'С подсветкой синтаксиса жизнь становится похожа на сказку.',
            'expirationDate' => '2022-12-01 13:00:00',
            'dateOfCreation' => '2022-09-01 13:00:00',
            'updateDate' => '2022-09-01 13:00:00',
            'priority' => 'Высокий',
            'status' => 'Выполнена',
            'creator_id' => '3',
            'responsible_id' => '3',
        ]);

        DB::table('tasks')->insert([
            'title' => 'Договориться с Фронтом об обмене данными.',
            'description' => 'Как вы будете договариваться, ваше дело. Мне нужен результат!',
            'expirationDate' => '2022-12-01 13:00:00',
            'dateOfCreation' => '2022-09-01 13:00:00',
            'updateDate' => '2022-09-01 13:00:00',
            'priority' => 'Высокий',
            'status' => 'Выполнена',
            'creator_id' => '3',
            'responsible_id' => '4',
        ]);
        
        DB::table('tasks')->insert([
            'title' => 'Договориться с Бэком об обмене данными.',
            'description' => 'Как вы будете договариваться, ваше дело. Мне нужен результат!',
            'expirationDate' => '2022-12-01 13:00:00',
            'dateOfCreation' => '2022-09-01 13:00:00',
            'updateDate' => '2022-09-01 13:00:00',
            'priority' => 'Высокий',
            'status' => 'Выполнена',
            'creator_id' => '3',
            'responsible_id' => '5',
        ]);
        
        DB::table('tasks')->insert([
            'title' => 'Настроить маршруты.',
            'description' => 'Каждый маршрут рано или поздно приведёт к контроллеру.',
            'expirationDate' => '2022-12-01 13:00:00',
            'dateOfCreation' => '2022-09-01 13:00:00',
            'updateDate' => '2022-09-01 13:00:00',
            'priority' => 'Высокий',
            'status' => 'Выполнена',
            'creator_id' => '4',
            'responsible_id' => '4',
        ]);
        
        DB::table('tasks')->insert([
            'title' => 'Настроить контроллеры',
            'description' => 'Если фронт что-то запросит, ответ не должен быть пустым.',
            'expirationDate' => '2022-12-01 13:00:00',
            'dateOfCreation' => '2022-09-01 13:00:00',
            'updateDate' => '2022-09-01 13:00:00',
            'priority' => 'Высокий',
            'status' => 'Выполнена',
            'creator_id' => '4',
            'responsible_id' => '4',
        ]);
        
        DB::table('tasks')->insert([
            'title' => 'Настроить аутентификацию и регистрацию',
            'description' => 'Не путайте аутентификацию с авторизацией!',
            'expirationDate' => '2022-12-01 13:00:00',
            'dateOfCreation' => '2022-09-01 13:00:00',
            'updateDate' => '2022-09-01 13:00:00',
            'priority' => 'Высокий',
            'status' => 'Выполнена',
            'creator_id' => '4',
            'responsible_id' => '4',
        ]);
        
        DB::table('tasks')->insert([
            'title' => 'Разобраться с компонентами',
            'description' => 'Каждый компонент, функциональный ли, классовый ли, является неотъемлемой частью морды.',
            'expirationDate' => '2022-12-01 13:00:00',
            'dateOfCreation' => '2022-09-01 13:00:00',
            'updateDate' => '2022-09-01 13:00:00',
            'priority' => 'Высокий',
            'status' => 'Выполнена',
            'creator_id' => '5',
            'responsible_id' => '5',
        ]);
        
        DB::table('tasks')->insert([
            'title' => 'Определить способ связи с Бэком',
            'description' => 'Нужно как-то отправлять запросы на серверную часть.',
            'expirationDate' => '2022-12-01 13:00:00',
            'dateOfCreation' => '2022-09-01 13:00:00',
            'updateDate' => '2022-09-01 13:00:00',
            'priority' => 'Высокий',
            'status' => 'Выполнена',
            'creator_id' => '5',
            'responsible_id' => '5',
        ]);
        
        DB::table('tasks')->insert([
            'title' => 'Отклацать кнопки',
            'description' => 'Реакция курсора не должна быть заторможенной.',
            'expirationDate' => '2022-12-01 13:00:00',
            'dateOfCreation' => '2022-09-01 13:00:00',
            'updateDate' => '2022-09-01 13:00:00',
            'priority' => 'Высокий',
            'status' => 'Выполнена',
            'creator_id' => '2',
            'responsible_id' => '6',
        ]);
        
        DB::table('tasks')->insert([
            'title' => 'Заменить батарейку',
            'description' => 'Мышь не должна подвести в трудную минуту.',
            'expirationDate' => '2022-12-01 13:00:00',
            'dateOfCreation' => '2022-09-01 13:00:00',
            'updateDate' => '2022-09-01 13:00:00',
            'priority' => 'Высокий',
            'status' => 'Выполнена',
            'creator_id' => '6',
            'responsible_id' => '6',
        ]);
        
        DB::table('tasks')->insert([
            'title' => 'Вспомнить ту старую рекламу кириешек с мышкой',
            'description' => 'Если батарейка всё же разрядится, поможет заряд хорошей ностальгии из 2003-го.',
            'expirationDate' => '2022-12-01 13:00:00',
            'dateOfCreation' => '2022-09-01 13:00:00',
            'updateDate' => '2022-09-01 13:00:00',
            'priority' => 'Низкий',
            'status' => 'Выполнена',
            'creator_id' => '6',
            'responsible_id' => '6',
        ]);
    }
}
