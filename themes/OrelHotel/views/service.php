<? global $reversed ?>
<section class="service-item <?= $reversed ?>">
    <? if ($reversed): ?>
        <div class="photo" style="background-image: url('<? the_post_thumbnail_url() ?>')"></div>
    <? endif; ?>
    <div class="content">
        <div class="service-container">
            <h1 class="title-light"><? the_field('короткое_название') ?></h1>
            <div class="title-block title-padding">
                <b><? the_title() ?></b>
                <mark class="white-overflow"><? the_field('подзаголовок') ?></mark>
            </div>
            <div class="photo mobile-photo"
                 style="background-image: url('<? the_post_thumbnail_url() ?>')"></div>
            <p class="text"><?= get_extended($post->post_content)['main'] ?></p>
            <div class="buttons">
                <? if (get_field('можно_бронировать')): ?>
                    <form action="<? the_permalink() ?>" method="post">
                        <button name="step" value="2" class="btn-gold">БРОНИРОВАТЬ</button>
                    </form>
                <? endif; ?>
                <a href="<? the_permalink() ?>" class="btn-gold btn-gold-light">Подробнее</a>
            </div>
        </div>
    </div>
    <? if (!$reversed): ?>
        <div class="photo" style="background-image: url('<? the_post_thumbnail_url() ?>')"></div>
    <? endif; ?>
</section>