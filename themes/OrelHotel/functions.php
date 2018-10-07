<?php

add_action('admin_notices', function () {
    if (!function_exists('OrelHotelActivation'))
        echo '<div class="error"><p>' . 'Внимание: Для работы темы требуется включенный плагин OrelHotel' . '</p></div>';
});