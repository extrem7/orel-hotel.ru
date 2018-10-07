<section class="hotel-services color-line-after">
    <div class="container">
        <h2 class="title-light"><? the_field('услуги_прозрачный_заголовок', 'option') ?></h2>
        <div class="title-block title-padding">
            <b><? the_field('услуги_заголовок', 'option') ?></b>
            <mark class="white-overflow"><? the_field('услуги_подзаголовок', 'option') ?><br>
                <span><? the_field('услуги_текст', 'option') ?></span></mark>
        </div>
        <div class="row justify-content-center">
            <?
            $services = get_posts([
                'post_type' => 'service',
                'posts_per_page' => -1
            ]);
            foreach ($services as $post):
                ?>
                <div class="service col-xl-2 col-lg-3 col-md-4 col-sm-6">
                    <div class="icon">
                        <img <? the_image('иконка', $post->ID) ?>>
                    </div>
                    <p class="title"><? the_field('заголовок_для_списка') ?></p>
                    <p class="excerpt"><? the_field('описание_для_списка') ?></p>
                    <a href="<? the_permalink() ?>" class="btn-gold">Подробнее</a>
                </div>
            <? endforeach;
            wp_reset_query(); ?>
        </div>
    </div>
</section>