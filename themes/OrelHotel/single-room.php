<?
global $price;
$price = get_field('цена');
get_header(); ?>
    <div class="main" style="background-image: url('<? the_post_thumbnail_url('room_size') ?>')">
        <div class="container">
            <h1 class="main-title"><? the_title() ?></h1>
            <h2 class="main-subtitle"><? the_field('тип_размещения') ?></h2>
        </div>
    </div>
<? $OrelHotel->breadcrumb() ?>
    <div class="content">
        <div class="container">
            <div class="title-block title-padding">
                <b><? the_title() ?></b>
                <mark class="white-overflow"><? the_field('тип_размещения') ?></mark>
            </div>
            <div class="description"><?= apply_filters('the_content', wpautop(get_post_field('post_content', $id), true)); ?></div>
            <p class="room-size"><b>Вместимость:</b> <? the_field('вместимость') ?></p>
        </div>
        <div class="room-advantages">
            <div class="line d-none d-md-block">
                <div class="container">
                    <div class="row">
                        <div class="d-none d-md-block col-md-4">В номере:</div>
                        <div class="d-none d-md-block col-md-4">В ванной комнате:</div>
                        <div class="d-none d-md-block col-md-4">В стоимость номера входит:</div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <?
                    $lists = get_field('списки');
                    ?>
                    <div class="col-md-4">
                        <div class="d-block d-md-none pl-2 line">В номере:</div>
                        <?
                        foreach ($lists['в_номере'] as $item):
                            ?>
                            <p class="advantage-item"><img src="<?= $item['иконка']['url'] ?>"
                                                           alt="<?= $item['иконка']['alt'] ?>"><?= $item['текст'] ?></p>
                        <? endforeach; ?>
                    </div>
                    <div class="col-md-4">
                        <div class="d-block d-md-none pl-2 mt-2 line">В ванной комнате:</div>
                        <?
                        foreach ($lists['в_ванной'] as $item):
                            ?>
                            <p class="advantage-item"><img src="<?= $item['иконка']['url'] ?>"
                                                           alt="<?= $item['иконка']['alt'] ?>"><?= $item['текст'] ?></p>
                        <? endforeach; ?>
                    </div>
                    <div class="col-md-4">
                        <div class="d-block d-md-none pl-2 mt-2 line">В стоимость номера входит:</div>
                        <?
                        foreach ($lists['в_стоимость'] as $item):
                            ?>
                            <p class="advantage-item">
                                <i class="fal fa-check-circle"></i><?= $item['текст'] ?></p>
                        <? endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <hr>
            <?
            // pre($_POST);
            $formStep = isset($_POST['step']) ? $_POST['step'] : null;
            switch ($formStep) {
                case null:
                    get_template_part('views/step-1');
                    break;
                case 2:
                    get_template_part('views/step-2');
                    break;
                case 3:
                    get_template_part('views/step-3');
                    break;
                case 4:
                    get_template_part('views/step-4');
                    break;
            } ?>
        </div>
    </div>
<? if ($formStep != 3): ?>
    <div class="room-gallery owl-carousel">
        <?
        $gallery = get_field('галерея');
        foreach ($gallery as $photo):
            ?>
            <div class="item">
                <img src="<?= $photo['url'] ?>" alt="">
                <div class="backdrop"></div>
            </div>
        <? endforeach; ?>
    </div>
    <? $OrelHotel->services();
endif;
get_footer() ?>