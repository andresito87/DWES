<?php

/*The goal of this exercise is to convert a string to a new string where each character in the new string is "(" if that character appears only once in the original string, or ")" if that character appears more than once in the original string. Ignore capitalization when determining if a character is a duplicate.*/

function duplicate_encode($word)
{
    $wordLowerCase = strtolower($word);
    $arrayLetras = str_split($wordLowerCase);
    $resultado = "";

    foreach ($arrayLetras as $letter) {
        $posicion = strpos($wordLowerCase, $letter);
        $subCadena = substr($wordLowerCase, $posicion + 1);
        if (str_contains($subCadena, $letter))
            $resultado .= ")";
        else
            $resultado .= "(";
    }

    return $resultado . PHP_EOL;
}

duplicate_encode("din");
duplicate_encode("recede");
duplicate_encode("Success");
duplicate_encode("(( @");