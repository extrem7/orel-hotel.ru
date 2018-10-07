<?
get_header(); ?>
    <div class="main">
        <div class="container">
            <h1 class="main-title"><? the_field('акции_обложка_заголовок', 'option') ?></h1>
            <h2 class="main-subtitle"><? the_field('акции_обложка_подзаголовок', 'option') ?></h2>
        </div>
    </div>
<? $OrelHotel->breadcrumb() ?>
    <div class="promotion-list">
        <? if (have_posts()) : ?>
            <h1 class="title-light"><? the_field('акции_заголовок', 'option') ?></h1>
            <div class="container">
                <div class="row">
                    <? while (have_posts()) {
                        the_post();
                        get_template_part('views/stock');
                    } ?>
                </div>
            </div>
        <?
        endif; ?>
    </div>
<? $OrelHotel->services();
get_footer() ?>