<?php

namespace App\Deck\Spell;

class Deck
{
    public const DECK = [
        Analgilyator::class,
        Chlenomorf::class,
        DosugSAsfiksiei::class,
        Eldovzriv::class,
        Erogril::class,
        Gigazip::class,
        Kotoklizm::class,
        Merzopakostny::class,
        OtInkolduni::class,
        PilkiiOrgazm::class,
        PotroshokZaPyatochok::class,
        Raskulator::class,
        Strupnii::class,
        ZlakManyak::class,
        ZolotoiDush::class
    ];

    public static function defineSpellByKey(string $key)
    {
        /** @var AbstractSpell $spellClass */
        foreach (self::DECK as $spellClass) {
            $obj = new $spellClass;
            if ($key === $obj->getKey()) {
                return $obj;
            }
        }
        return null;
    }
}
