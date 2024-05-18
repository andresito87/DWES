<?php
/*Define a function that takes an integer argument and returns a logical value true or false depending on if the integer is a prime.

Per Wikipedia, a prime number ( or a prime ) is a natural number greater than 1 that has no positive divisors other than 1 and itself.

Requirements
You can assume you will be given an integer input.
You can not assume that the integer will be only positive. You may be given negative numbers as well ( or 0 ).
NOTE on performance: There are no fancy optimizations required, but still the most trivial solutions might time out. Numbers go up to 2^31 ( or similar, depending on language ). Looping all the way up to n, or n/2, will be too slow.
Example
is_prime(1)  false 
is_prime(2)  true  
is_prime(-1)  false 
*/

function is_prime(int $n) : bool
{
    // Los números menores o iguales a 1 no son primos
    if ($n <= 1) {
        return false;
    }

    // El 2 y el 3 son números primos
    if ($n == 2 || $n == 3) {
        return true;
    }

    // Los números pares mayores que 2 no son primos
    if ($n % 2 == 0) {
        return false;
    }

    // Comprobar los posibles factores hasta la raíz cuadrada del número
    $sqrt = sqrt($n);
    for ($i = 3; $i <= $sqrt; $i += 2) {
        if ($n % $i == 0) {
            return false;
        }
    }

    return true;
}

echo (is_prime(1) ? "Es primo" : "No es primo");