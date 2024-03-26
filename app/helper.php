<?php
use Illuminate\Support\Facades\Auth;


if (!function_exists("school_id")) {
    function school_id()
    {
        return Auth::user()->school_id ?? '';
    }
}
if (!function_exists('school_ref')) {
    function school_ref()
    {
        $limit = 8;
        $text = Auth::user()->school_name ?? 'ERPTEST';
        $words = explode(' ', mb_strtoupper($text));
        $words = array_slice($words, 0, $limit);
        return implode(' ', $words) . '-STU-00';
    }
}



