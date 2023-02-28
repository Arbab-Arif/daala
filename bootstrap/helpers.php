<?php


if (!function_exists('formatDuration')){
    function formatDuration($time, $format = '%02d Hours, %02d Minutes')
    {
        if ($time < 1) {
            return '0 Minutes';
        }
        $hours = floor($time / 60);
        $minutes = ($time % 60);
        return sprintf($format, $hours, $minutes);
    }
}
