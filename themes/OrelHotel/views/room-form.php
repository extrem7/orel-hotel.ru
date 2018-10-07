<?
$adultsMax = get_field('ограничение_взрослых');
$adultsMax = $adultsMax > 0 ? $adultsMax : null;
$childrenMax = get_field('ограничение_детей');
$childrenMax = $childrenMax > 0 ? $childrenMax : null;
?>
<div class="row-inputs flex-wrap">
    <label class="input-control date-block" :class="{error:!days}">
        Дата прибытия
        <input type="date" name="arrival" v-model="startDate">
    </label>
    <label class="input-control date-block" :class="{error:!days}">
        Дата отъезда
        <input type="date" name="leaving" v-model="endDate">
    </label>
    <label class="input-control number-block" :class="{error:(adults % 1)}">
        Взрослых
        <input type="number" name="adults" min="1" max="<?= $adultsMax ?>" v-model.number="adults">
    </label>
    <label class="input-control number-block" :class="{error:(children % 1)}">
        Детей
        <input type="number" name="children" min="0" max="<?= $childrenMax ?>" v-model.number="children">
    </label>
    <p class="price">Стоимость за 1 ночь:<span>2 950 руб.</span></p>
    <p class="come-in">Пребывание:<span>{{startDate | date}} - {{endDate | date}}</span></p>
    <p class="come-out">Гостей:<span>{{adults}} взросл. {{children}} дет.</span></p>
</div>