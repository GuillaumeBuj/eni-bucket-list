<?php

namespace App\Services;

class Censurator
{
    const CENSORED_WORDS = ["pass","distanciation","altruisme","resilience"];

    public function purify(string $text):string
    {
        foreach (self::CENSORED_WORDS as $censoredWord) {
            $text = str_ireplace($censoredWord, "*****", $text);
        }

        return $text;
    }
}