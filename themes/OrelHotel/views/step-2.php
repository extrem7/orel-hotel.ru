<?
global $post, $price;
$services = get_field('дополнительные_услуги');

$adultsMax = get_field('ограничение_взрослых');
$adultsMax = $adultsMax > 0 ? $adultsMax : null;
$childrenMax = get_field('ограничение_детей');
$childrenMax = $childrenMax > 0 ? $childrenMax : null;

$_POST['adults'] = $_POST['adults'] > $adultsMax ? $adultsMax : $_POST['adults'];
$_POST['children'] = $_POST['children'] > $childrenMax ? $childrenMax : $_POST['children'];

?>
<script>
    let price = <?= $price ?>,
        formData = <?= json_encode($_POST) ?>,
        services = <?echo json_encode($services);?>;
</script>
<form class="reservation-room-form reservation-room-form-next custom-form-control"
      id="room-reserv-form-plain" method="POST">
    <? get_template_part('views/room-form') ?>
    <div class="additional-services">
        <p>Перед тем, как завершить бронирование, вы можете заказать дополнительные услуги</p>
        <?
        $i = 0;
        while (have_rows('дополнительные_услуги')): the_row() ?>
            <div class="service row">
                <div class="col-lg-6">
                    <b><? the_sub_field('name') ?></b>
                    <p><? the_sub_field('description') ?></p>
                </div>
                <div class="col-lg-3">
                    <p class="service-price">Стоимость за 1 ночь: <span><? the_sub_field('price') ?>
                            руб.</span></p>
                </div>
                <div class="col-lg-3">
                    <label class="input-control select-control">
                        <select v-model="services[<?= $i ?>].count">
                            <option value="" selected>Выбрать</option>
                            <option value="1" v-for="index in services[<?= $i ?>].max_count"
                                    :value="index">{{index}} доп.место
                            </option>
                        </select>
                    </label>
                </div>
            </div>
            <?
            $i++;
        endwhile; ?>
    </div>
    <div class="reservation-control">
        <a href="" class="btn-gold btn-gold-light">Назад</a>
        <p class="short-review">2 гостя, 1 доп.место<br>26 июня — 27 июня</p>
        <div class="d-flex flex-column flex-md-row align-items-center">
            <p class="subtotal">Общая стоимость:<span>{{subtotal}} руб.</span></p>
            <input type="hidden" name="services" :value="usedServices">
            <input type="hidden" name="jsonServices" :value="convertedServices">
            <input type="hidden" name="subtotal" :value="subtotal">
            <button class="submit" name="step" value="3" :disabled="!subtotal">ЗАБРОНИРОВАТЬ</button>
        </div>
    </div>
</form>