<?php

if (! function_exists('format_clp')) {
    function format_clp(int|float|null $amount): string
    {
        if ($amount === null) {
            return '$0';
        }

        return '$'.number_format((int) $amount, 0, ',', '.');
    }
}
