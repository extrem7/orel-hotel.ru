<?
global $foodGroups;
foreach ($foodGroups as $foodGroup): ?>
    <div class="food-group">
        <? foreach ($foodGroup as $item): ?>
            <div class="food-item">
                <div class="photo"
                     style="background-image: url('<?= $item['фото']['url'] ?>')"></div>
                <div class="info">
                    <p class="title"><?= $item['название'] ?></p>
                    <p class="energy"><?= $item['характеристики'] ?></p>
                    <p class="excerpt"><?= $item['описание'] ?></p>
                </div>
                <p class="price"><span><?= $item['цена'] ?></span>руб.</p>
            </div>
        <? endforeach; ?>
    </div>
<? endforeach; ?>