<? global $price ?>
<script>
    let price = <?= $price ?>;
</script>
<form class="reservation-room-form custom-form-control" id="room-reserv-form-plain" method="post">
    <? get_template_part('views/room-form') ?>
    <div class="reservation-control">
        <p class="subtotal">Общая стоимость:<span>{{subtotal}} руб.</span></p>
        <button class="submit" name="step" value="2" :disabled="!subtotal">ЗАБРОНИРОВАТЬ</button>
    </div>
</form>