<?php

namespace Database\Seeders;

use App\Deck\CardsMarkEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InfectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('infections')->insert([
            'name' => 'Письмо на почту от Алексеева',
            'description' => 'Эффекты всех твоих карт воздействуют только на одного врага',
            'is_eternal' => 0,
            'mark' => CardsMarkEnum::Kumar->value,
            'repeat' => 2
        ]);

        DB::table('infections')->insert([
            'name' => 'Двоечка от Кристинки',
            'description' => 'Твой предел руки снижен на 2',
            'is_eternal' => 0,
            'mark' => CardsMarkEnum::Damage->value,
            'repeat' => 2
        ]);

        DB::table('infections')->insert([
            'name' => 'Звонок от Тонкович',
            'description' => 'В конце своего хода потеряй две жизни',
            'is_eternal' => 0,
            'mark' => CardsMarkEnum::Kumar->value,
            'repeat' => 2
        ]);

        DB::table('infections')->insert([
            'name' => 'Нежданчик от Лихачевского',
            'description' => 'В конце своего хода потеряй 1 жизнь за каждое свое зпмп включая это',
            'is_eternal' => 0,
            'mark' => CardsMarkEnum::Darkness->value,
            'repeat' => 2
        ]);

        DB::table('infections')->insert([
            'name' => 'Подзатыльник от Поляковского',
            'description' => 'Ты не можешь получать иметь или отжимать сокровища',
            'is_eternal' => 0,
            'mark' => CardsMarkEnum::Grass->value,
            'repeat' => 2
        ]);

        DB::table('infections')->insert([
            'name' => 'Удар ниже пояса от Шкоды',
            'description' => 'Ты не можешь накручивать жизни',
            'is_eternal' => 0,
            'mark' => CardsMarkEnum::Darkness->value,
            'repeat' => 2
        ]);

        DB::table('infections')->insert([
            'name' => 'Сюрприз от Бутова',
            'description' => 'Немеделенно потеряй 3 жизни и сбрось это ЗПМП',
            'is_eternal' => 0,
            'mark' => CardsMarkEnum::Carbon->value,
            'repeat' => 2
        ]);

        DB::table('infections')->insert([
            'name' => 'Послание от Михалькевича',
            'description' => 'Твой максимальный размер заклинания снижен на 1',
            'is_eternal' => 0,
            'mark' => CardsMarkEnum::Kumar->value,
            'repeat' => 2
        ]);

        DB::table('infections')->insert([
            'name' => 'Пасхалочка от Хорошко',
            'description' => 'В конце своего хода потеряй 1 жизнь. Вечное',
            'is_eternal' => 1,
            'mark' => CardsMarkEnum::Carbon->value,
            'repeat' => 2
        ]);

        DB::table('infections')->insert([
            'name' => 'Поджопник',
            'description' => 'Убирай все карты Шальная магия из своих заклинаний',
            'is_eternal' => 0,
            'mark' => CardsMarkEnum::Grass->value,
            'repeat' => 2
        ]);
    }
}
