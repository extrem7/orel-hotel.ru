<? /* Template Name: Контакты */
get_header(); ?>
    <div class="main">
        <div class="container">
            <h1 class="main-title"><? the_field('заголовок') ?></h1>
            <h2 class="main-subtitle"><? the_field('подзаголовок') ?></h2>
        </div>
    </div>
<? $OrelHotel->breadcrumb() ?>
    <div class="content">
        <h1 class="title-light"><? the_title() ?></h1>
        <div class="container">
            <div class="info">
                <div class="info-item">
                    <div class="item-header">
                        <i class="fal fa-map-marker-alt"></i>
                        <p class="title">Адрес</p>
                    </div>
                    <div class="item-body"><? the_field('адрес') ?></div>
                </div>
                <div class="info-item">
                    <div class="item-header">
                        <i class="fal fa-phone fa-rotate-90"></i>
                        <p class="title">телефоны</p>
                    </div>
                    <div class="item-body"><? the_field('телефоны') ?></div>
                </div>
                <div class="info-item">
                    <div class="item-header">
                        <i class="fal fa-envelope-open"></i>
                        <p class="title">mail</p>
                    </div>
                    <div class="item-body">
                        <? while (have_rows('почта')) {
                            the_row();
                            $mail = get_sub_field('адрес');
                            echo "<a href='mailto:$mail'>$mail</a><br>";
                        } ?>
                    </div>
                </div>
                <div class="info-item">
                    <div class="item-header">
                        <i class="fal fa-clock"></i>
                        <p class="title">график работы</p>
                    </div>
                    <div class="item-body"><? the_field('график_работы') ?></div>
                </div>
            </div>
            <div class="contact-phones">
                <? while (have_rows('телефоны_служб')): the_row() ?>
                    <div class="phone-item">
                        <img <? repeater_image('иконка') ?>>
                        <p class="title"><? the_sub_field('название') ?></p>
                        <p class="text"><span><? the_sub_field('время_работы') ?></span><? the_sub_field('телефон') ?>
                        </p>
                    </div>
                <? endwhile; ?>
            </div>
        </div>
    </div>
    <div class="color-line-after"><? the_field('карта') ?></div>
<? get_footer() ?>