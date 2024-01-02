<?php

if (!function_exists('settings')) {
    function settings() {
        $settings = cache()->remember('settings', 24*60, function () {
            return \Modules\Setting\Entities\Setting::firstOrFail();
        });

        return $settings;
    }
}
if (!function_exists('bulan_indonesia')) {
    function bulan_indonesia($monthNumber)
    {
        $bulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',
        ];

        return $bulan[$monthNumber - 1] ?? '';
    }
}

if (!function_exists('format_currency')) {
    function format_currency($value, $format = true) {
        if (!$format) {
            return $value;
        }
    
        $settings = settings();
        $position = $settings->default_currency_position;
        $symbol = $settings->currency->symbol;
        $decimal_separator = $settings->currency->decimal_separator;
        $thousand_separator = $settings->currency->thousand_separator;
    
        // Multiply the value by 0.01 to move the last two digits to the left of the decimal point
        $value *= 0.1;
    
        if ($position == 'prefix') {
            $formatted_value = $symbol . number_format((float) $value, 3, $decimal_separator, $thousand_separator);
        } else {
            $formatted_value = number_format((float) $value, 3, $decimal_separator, $thousand_separator) . $symbol;
        }
    
        return $formatted_value;
    }
    
}

if (!function_exists('make_reference_id')) {
    function make_reference_id($prefix, $number) {
        $padded_text = $prefix . '-' . str_pad($number, 5, 0, STR_PAD_LEFT);

        return $padded_text;
    }
}

if (!function_exists('array_merge_numeric_values')) {
    function array_merge_numeric_values() {
        $arrays = func_get_args();
        $merged = array();
        foreach ($arrays as $array) {
            foreach ($array as $key => $value) {
                if (!is_numeric($value)) {
                    continue;
                }
                if (!isset($merged[$key])) {
                    $merged[$key] = $value;
                } else {
                    $merged[$key] += $value;
                }
            }
        }

        return $merged;
    }
}
