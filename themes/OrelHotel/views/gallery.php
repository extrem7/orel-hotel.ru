<section class="hotel-gallery color-line-after">
    <div class="left">
        <div class="gallery-carousel owl-carousel owl-carousel-common">
            <?
            while (have_rows('галерея', 'option')):
                the_row()
                ?>
                <a href="<?= path() ?>img/gallery-1.png" class="item" data-fancybox="gallery"
                   style="background-image: url('<?= get_sub_field('фото') ?>')">
                    <div class="hover">
                        <div class="border-box">
                            <p><? the_sub_field('текст') ?></p>
                            <i class="fal fa-search-plus"></i>
                        </div>
                    </div>
                </a>
            <? endwhile; ?>
        </div>
    </div>
    <div class="right">
        <h2 class="title-light"><? the_field('галерея_короткий_заголовок', 'option') ?></h2>
        <div class="title-block">
            <b><? the_field('галерея_заголовок', 'option') ?></b>
            <mark class="white-overflow"><span><? the_field('галерея_текст', 'option') ?></span></mark>
        </div>
        <a href="<? the_permalink(105) ?>" class="btn-gold">Больше фото</a>
    </div>
</section>