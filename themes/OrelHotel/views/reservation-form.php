<?
$restaurant = get_page_template_slug() == 'pages/restaurant.php';
echo $restaurant;
?>
    <div class="reservation-form custom-form-control">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link <?= $restaurant ? '' : 'active' ?>" data-toggle="tab" href="#hotel-form">Номера
                в гостинице</a>
            <a class="nav-item nav-link <?= $restaurant ? 'active' : '' ?>" data-toggle="tab" href="#restaurant-form">Места
                в ресторане</a>
        </div>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade <?= $restaurant ? '' : 'show active' ?>" id="hotel-form">
                <?
                $rooms = get_posts([
                    'post_type' => 'room',
                    'posts_per_page' => -1
                ]);
                ?>
                <form action="<? the_permalink($rooms[0]->ID) ?>" method="post" class="form">
                    <div class="row-inputs flex-wrap">
                        <label class="input-control date-block">
                            Дата прибытия
                            <input type="date" name="arrival" value="<?= date('Y-m-d', strtotime(' +1 day')) ?>">
                        </label>
                        <label class="input-control date-block">
                            Дата отъезда
                            <input type="date" name="leaving" value="<?= date('Y-m-d', strtotime(' +2 day')) ?>">
                        </label>
                        <label class="input-control select-control">
                            Номер
                            <select>
                                <?
                                foreach ($rooms as $post):
                                    ?>
                                    <option value="<? the_permalink() ?>"><? the_title() ?>
                                        (<? the_field('тип_размещения') ?>)
                                    </option>
                                <? endforeach; ?>
                            </select>
                        </label>
                        <label class="input-control number-block">
                            Взрослых
                            <input type="number" name="adults" value="1">
                        </label>
                        <label class="input-control number-block">
                            Детей
                            <input type="number" name="children" value="0">
                        </label>
                        <button type="submit" name="step" class="btn-gold submit" value="2">ЗАБРОНИРОВАТЬ</button>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade <?= $restaurant ? 'show active' : '' ?>" id="restaurant-form">
                <div class="form">
                    <?= do_shortcode('[contact-form-7 id="267" title="Бронь ресторана"]') ?>
                </div>
            </div>
        </div>
    </div>
<? wp_reset_query() ?>