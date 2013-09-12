<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function confirm_query($result_set) {
   if (!$result_set) {
        die("Database query failed: " . mysql_error());
    }
}


