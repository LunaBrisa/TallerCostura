<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidEmailMX implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $domain = substr(strrchr($value, "@"), 1); 

        // Validar si el dominio tiene registros MX
        if (!checkdnsrr($domain, "MX")) {
            $fail("El dominio del correo no es válido.");  
            return;
        }

        $connection = @fsockopen("smtp.$domain", 25);
        if (!$connection) {
            $fail("El correo no es entregable o no existe.");
            return;
        }

        fclose($connection); 
    }
    public function message(): string
    {
        return 'El dominio del correo no es válido o el correo no es entregable.';
    }
}
