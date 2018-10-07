<? get_header(); ?>
    <div class="main">
        <div class="container">
            <h1 class="main-title"><? the_field('акции_обложка_заголовок', 'option') ?></h1>
            <h2 class="main-subtitle"><? the_field('акции_обложка_подзаголовок', 'option') ?></h2>
        </div>
    </div>
<? $OrelHotel->breadcrumb() ?>
    <div class="content color-line-after">
        <div class="container">
            <h2 class="promotion-title"><? the_title() ?></h2>
            <? the_post_thumbnail('full', ['class' => 'main-photo', 'height' => 'auto']) ?>
            <?= apply_filters('the_content', wpautop(get_post_field('post_content', $id), true)); ?>
        </div>
    </div>
    <div class="other-promotions color-line-after">
        <div class="container">
            <h3 class="other-title">ДРУГИЕ СПЕЦПРЕДЛОЖЕНИЯ</h3>
            <div class="promotion-carousel owl-carousel owl-carousel-common">
                <?
                $posts = get_posts([
                    'post_type' => 'stock',
                    'posts_per_page' => -1,
                    'exclude' => [get_the_ID()]
                ]);
                foreach ($posts as $post): ?>
                    <a href="<? the_permalink() ?>" class="item">
                        <div class="photo"
                             style="background-image: url('<? the_post_thumbnail_url('medium_size') ?>')"></div>
                        <p class="title"><? the_field('заголовок_короткий') ?></p>
                        <p class="excerpt"><? the_field('отрывок_короткий') ?></p>
                        <div class="d-flex justify-content-center">
                            <div class="btn-gold">Подробнее</div>
                        </div>
                    </a>
                <? endforeach; ?>
            </div>
        </div>
    </div>
<? get_footer() ?>