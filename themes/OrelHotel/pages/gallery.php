<? /* Template Name: Галерея */
get_header(); ?>
    <div class="main">
        <div class="container">
            <h1 class="main-title"><? the_field('заголовок_обложки') ?>
                <span><? the_field('подзаголовок_обложки') ?></span></h1>
        </div>
    </div>
<? $OrelHotel->breadcrumb() ?>
    <div class="content">
        <div class="container">
            <h1 class="title-light"><? the_title() ?></h1>
            <div class="title-block title-padding">
                <b><? the_field('заголовок') ?></b>
                <mark class="white-overflow"><? the_field('подзаголовок') ?></mark>
            </div>
            <div class="text"><?= apply_filters('the_content', wpautop(get_post_field('post_content', $id), true)); ?></div>
        </div>
        <div class="color-line-after"></div>
        <div class="gallery">
            <ul class="category-menu">
                <li><a href="" class="active">Все фотографии</a></li>
                <?
                $categories = get_terms('gallery_cat', ['hide_empty' => false]);
                foreach ($categories as $category):
                    ?>
                    <li><a href="#" data-tax="<?= $category->term_id ?>"><?= $category->name ?></a></li>
                <? endforeach; ?>
            </ul>
            <div class="photos d-none">
                <? while (have_rows('галерея')): the_row();
                    $image = get_sub_field('фото');
                    $categories = get_sub_field('категории');
                    $categories = array_reduce($categories, function ($carry, $item) {
                        $carry .= $carry ? ' | ' : '';
                        $carry .= $item;
                        return $carry;
                    }, '');
                    echo "";
                    ?>
                    <a href="<?= $image['url'] ?>" data-fancybox="gallery" data-tax="<?= $categories ?>"><img
                                src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>"></a>
                <? endwhile; ?>
            </div>
            <div class="tab">

            </div>
            <div class="d-flex justify-content-center">
                <a href="#" class="btn-gold btn-gold-light load-more">Далее</a>
            </div>
        </div>
    </div>
<? $OrelHotel->services() ?>
<? get_footer() ?>