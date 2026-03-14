<?php

namespace App;

enum DelioGenero : string
{
    CASE MPB = 'mpb';
    CASE ROCK = 'rock';
    CASE POP = 'pop';
    CASE SERTANEJO = 'sertanejo';
    CASE KPOP = 'kpop';


    public function label()
    {
        return match($this){
            self::MPB => 'mpb',
            self::ROCK => 'rock',
            self::POP => 'pop',
            self::SERTANEJO => 'sertanejo',
            self::KPOP => 'kpop',
        };

    }

}
