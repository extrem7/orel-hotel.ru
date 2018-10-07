<?
get_header(); ?>
    <div class="main" style="background-image: url('<? the_post_thumbnail_url('room_size') ?>')">
        <div class="container">
            <h1 class="main-title"><? the_title() ?></h1>
            <h2 class="main-subtitle"><? the_field('обложка_подзаголовок') ?></h2>
        </div>
    </div>
<? $OrelHotel->breadcrumb() ?>
    <div class="content">
        <div class="container">
            <div class="title-block title-padding">
                <b><? the_title() ?></b>
                <mark class="white-overflow"><? the_field('подзаголовок') ?></mark>
            </div>
            <div class="description"><?= apply_filters('the_content', wpautop(get_post_field('post_content', $id), true)); ?></div>
        </div>
        <div class="room-advantages">
            <div class="line d-none d-md-block">
                <div class="container">
                    <div class="row">
                        <?
                        $lists = get_field('списки');
                        $listHead = [];
                        $listHead[] = $lists['колонка_1_название'];
                        $listHead[] = $lists['колонка_2_название'];
                        $listHead[] = $lists['колонка_3_название'];
                        foreach ($listHead as $item):
                            ?>
                            <div class="d-none d-md-block col-md-4"><?= $item ?></div>
                        <? endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <?
                    $i = 0;
                    foreach ([$lists['колонка_1'], $lists['колонка_2'], $lists['колонка_3']] as $column):
                        if ($column):
                            ?>
                            <div class="col-md-4">
                                <div class="d-block d-md-none pl-2 line"><?= $listHead['колонка_' . $i . '_название'] ?></div>
                                <? foreach ($column as $item): ?>
                                    <p class="advantage-item"><img src="<?= $item['иконка']['url'] ?>"
                                                                   alt="<?= $item['иконка']['alt'] ?>"><?= $item['текст'] ?>
                                    </p>
                                <?
                                endforeach;
                                ?>
                            </div>
                        <? endif; ?>
                        <?
                        $i++;
                    endforeach; ?>
                </div>
            </div>
        </div>
        <? if (get_field('можно_бронировать')): ?>
            <div class="container">
                <hr>
                <div class="reservation-room-form custom-form-control">
                    <div class="row-inputs flex-wrap">
                        <?= do_shortcode('[contact-form-7 id="258" title="Бронь услуги"]') ?>
                    </div>
                </div>
            </div>
        <? endif; ?>
    </div>
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
<? //$OrelHotel->services() ?>
<? get_footer() ?>