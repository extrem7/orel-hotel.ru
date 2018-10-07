<?
get_header(); ?>
    <div class="main">
        <div class="container">
            <? $OrelHotel->reservationForm() ?>
        </div>
    </div>

    <div class="room-list">
        <? if (have_posts()) : ?>
            <h1 class="title-light">Номерной фонд</h1>
            <?
            $i = 1;
            while (have_posts()) : the_post();
                $reversed = $i % 2 == 0 ? 'room-item-reverse' : '';
                ?>
                <div class="room-item <?= $reversed ?>">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-md-9">
                                <div class="title-block title-padding">
                                    <b><? the_title() ?></b>
                                    <mark class="white-overflow"><? the_field('тип_размещения') ?></mark>
                                </div>
                                <p class="excerpt"><?= get_extended($post->post_content)['main'] ?></p>
                                <p class="price"><i class="fal fa-ruble-sign"></i>от <? the_field('цена') ?> руб./ сутки
                                </p>
                                <div class="room-control">
                                    <form action="<? the_permalink() ?>" method="post">
                                        <button name="step" value="2" class="btn-gold">БРОНИРОВАТЬ</button>
                                    </form>
                                    <a href="<? the_permalink() ?>" class="btn-gold btn-gold-light">Подробнее</a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <? $gallery = get_field('галерея'); ?>
                                <div class="main-photo"
                                     style="background-image: url('<?= $gallery[0]['url'] ?>')"></div>
                                <div class="room-gallery">
                                    <? $active = 'active';
                                    foreach ($gallery as $photo):?>
                                        <a href="<?= $photo['sizes']['room_size'] ?>" class="<?= $active ?>"
                                           style="background-image: url('<?= $photo['sizes']['thumbnail'] ?>')"><span
                                                    class="hover"></span></a>
                                        <? $active = '';
                                    endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?
                $i++;
            endwhile; endif; ?>
    </div>
<? $OrelHotel->services() ?>
<? get_footer() ?>