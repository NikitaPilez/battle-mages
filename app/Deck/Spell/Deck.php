<?php

namespace App\Deck\Spell;

class Deck
{
    public const DECK = [
        Merzopakostny::class,
        OtInkolduni::class,
        PotroshokZaPyatochok::class,
        ZlakManyak::class
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
