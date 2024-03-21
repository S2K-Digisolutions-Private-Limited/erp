<?php


if (!function_exists("school_id")) {
    function school_id()
    {
        return Auth::user()->school_id ?? '';
    }
}
