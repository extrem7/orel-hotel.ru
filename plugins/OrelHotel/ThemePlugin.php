<?php

/**
 * Plugin Name: OrelHotel
 * Version: 1.0
 * Author: YesTech
 * Author uri: https://t.me/drKeinakh
 */

require_once "includes/functions.php";
require_once "OrelHotel.php";

function OrelHotelActivation()
{
    global $OrelHotel;
    $OrelHotel = new OrelHotel();
}

OrelHotelActivation();