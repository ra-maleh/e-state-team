<?php

/*
 * 
 */

function returnByte($notByte) {
    switch ($notByte) {
        case ('off'):
            $notByte = 0;
            break;
        case ('on'):
            $notByte = 1;
            break;

        default:
            $notByte = 9;
            break;
    }
    return (int) $notByte;
}

function allowInQuery($col) {
    global $query;
        if (!isset($col)) {
        $query .= ",null";
    } else {
        $query .= ",{$col}";
    }
}
