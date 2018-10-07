<? /* Template Name: Гостиница */
get_header(); ?>
    <div class="main">
        <div class="container">
            <h1 class="main-title"><? the_field('заголовок_обложки') ?><span><? the_field('подзаголовок_обложки') ?></span></h1>
            <h2 class="main-subtitle"><? the_field('текст_обложки') ?></h2>
        </div>
    </div>
<? $OrelHotel->breadcrumb() ?>
    <section class="hotel-section color-line-after">
        <h2 class="title-light"><? the_field('заголовок') ?></h2>
        <div class="container">
            <div class="title-block title-padding">
                <b><? the_field('заголовок') ?></b>
                <mark class="white-overflow"><? the_field('подзаголовок') ?></mark>
            </div>
            <div class="text"><?= apply_filters('the_content', wpautop(get_post_field('post_content', $id), true)); ?></div>
        </div>
    </section>
<? $OrelHotel->gallery() ?>
<? $OrelHotel->services() ?>
<? get_footer() ?>