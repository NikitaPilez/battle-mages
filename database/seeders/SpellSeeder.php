<?php

namespace Database\Seeders;

use App\Deck\CardsMarkEnum;
use App\Deck\CardsTypeEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpellSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('spells')->insert([
            'name' => 'Мерзопакостный',
            'description' => 'Нанеси 4 урона каждому колдуну, у которого есть 2 или больше ЗПМП (включая тебя). Нежданчик: если ты подох до применения эффектов этой карты, вылечи все свои ЗПМП и накрути столько же жизней.',
            'key' => 'merzopakostniy',
            'image' => 'sdf',
            'mark' => CardsMarkEnum::Darkness->value,
            'type' => CardsTypeEnum::LoveSpell->value,
            'repeat' => 2
        ]);

        DB::table('spells')->insert([
            'name' => 'От инколдуньи',
            'description' => 'Каждый враг заражается одним ЗПМП за каждое свое сокровище. Если ни у кого нет сокровищ, возьми одно сокровище.',
            'key' => 'ot-inkolduni',
            'image' => 'sdf',
            'mark' => CardsMarkEnum::Carbon->value,
            'type' => CardsTypeEnum::Ringleader->value,
            'repeat' => 2
        ]);

        DB::table('spells')->insert([
            'name' => 'Злак маньяк',
            'description' => 'Жертва: Каждый враг. Могучий бросок: (1-4) Ты отхватываешь 2 урона. (5-9) 2 урона (10+) 1 ЗПМП. СТОЯТЬ!',
            'key' => 'zlak-manyak',
            'image' => 'sdf',
            'mark' => CardsMarkEnum::Darkness->value,
            'type' => CardsTypeEnum::Coming->value,
            'repeat' => 2
        ]);

        DB::table('spells')->insert([
            'name' => 'Потрошок за пяточок',
            'description' => 'Жертва: враг хилее тебя. Замок: жертвами становятся все враги. Могучий бросок: (1-4) 2 урона,а ты заражаешься одним ЗПМП, (5-9) 1 ЗПМП, (10+) 2 урона за каждое твое ЗПМП. ',
            'key' => 'potroshok-za-pyatochok',
            'image' => 'sdf',
            'mark' => CardsMarkEnum::Darkness->value,
            'type' => CardsTypeEnum::Coming->value,
            'repeat' => 2
        ]);

        DB::table('spells')->insert([
            'name' => 'Аналгилятор',
            'description' => 'Жертва: левый враг. Могучий бросок: (1-4) 2 урона, (5-9) 3 урона, а ты берешь 1 сокровище, (10+) 2 урона, за каждое твоё ЗПМП',
            'key' => 'analgilyator',
            'image' => 'sdf',
            'mark' => CardsMarkEnum::Damage->value,
            'type' => CardsTypeEnum::Coming->value,
            'repeat' => 2
        ]);

        DB::table('spells')->insert([
            'name' => 'Членоморф',
            'description' => 'Жертва: правый враг. Могучий бросок: (1-4) 1 ЗПМП (5-9) 2 урона, (10+) 2 ЗПМП',
            'key' => 'chlenomorf',
            'image' => 'sdf',
            'mark' => CardsMarkEnum::Darkness->value,
            'type' => CardsTypeEnum::Coming->value,
            'repeat' => 2
        ]);

        DB::table('spells')->insert([
            'name' => 'Досуг с асфиксией',
            'description' => 'Жертва: враг с сокровищем. Замок: жертвами становятся все враги. Могучий бросок: (1-4) Захвати замок (5-9) 2 урона, (10+) 2 урона, 1 ЗПМП',
            'key' => 'dosug-s-asfiksiei',
            'image' => 'sdf',
            'mark' => CardsMarkEnum::Damage->value,
            'type' => CardsTypeEnum::Coming->value,
            'repeat' => 2
        ]);

        DB::table('spells')->insert([
            'name' => 'Эрогриль',
            'description' => 'Жертва: левый враг. Могучий бросок: (1-4) Ты берешь 1 сокровище (5-9) 2 урона (10+) 2 урона за каждое твое ЗПМП',
            'key' => 'erogril',
            'image' => 'sdf',
            'mark' => CardsMarkEnum::Carbon->value,
            'type' => CardsTypeEnum::Coming->value,
            'repeat' => 2
        ]);

        DB::table('spells')->insert([
            'name' => 'Гигацип',
            'description' => 'Жертва: правый враг. Могучий бросок: (1-4) 2 урона (5-9) 2 ЗПМП (10+) 3 урона, СТОЯТЬ!',
            'key' => 'gigazip',
            'image' => 'sdf',
            'mark' => CardsMarkEnum::Grass->value,
            'type' => CardsTypeEnum::Coming->value,
            'repeat' => 2
        ]);

        DB::table('spells')->insert([
            'name' => 'Раскулатор',
            'description' => 'Жертва: каждый враг с 10 жизнями или больше. Замок: жертвами становятся все враги. Могучий бросок: (1-4) 1 урон (5-9) 2 урона, (10+) 2 урона, 1 ЗПМП.',
            'key' => 'raskulator',
            'image' => 'sdf',
            'mark' => CardsMarkEnum::Kumar->value,
            'type' => CardsTypeEnum::Coming->value,
            'repeat' => 2
        ]);

        DB::table('spells')->insert([
            'name' => 'Елдовзрыв',
            'description' => 'Жертва: левый враг. Могучий бросок: (1-4) 1 урон (5-9) 1 урон, 1 ЗПМП (10+) 2 урона за каждое твое ЗПМП.',
            'key' => 'eldovzriv',
            'image' => 'sdf',
            'mark' => CardsMarkEnum::Kumar->value,
            'type' => CardsTypeEnum::Coming->value,
            'repeat' => 2
        ]);

        DB::table('spells')->insert([
            'name' => 'Золотой душ',
            'description' => 'Жертва: враг живучее тебя. Замок: жертвами становятся все враги. Могучий бросок: (1-4) 1 ЗПМП (5-9) 3 урона (10+) 3 урона, 1 ЗПМП',
            'key' => 'zolotoi-dush',
            'image' => 'sdf',
            'mark' => CardsMarkEnum::Grass->value,
            'type' => CardsTypeEnum::Coming->value,
            'repeat' => 2
        ]);
    }
}
