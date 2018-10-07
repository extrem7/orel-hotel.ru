<? /* Template Name: Ресторан */
get_header(); ?>
    <div class="main">
        <div class="container">
            <? $OrelHotel->reservationForm() ?>
        </div>
    </div>
    <section class="about color-line-after">
        <h1 class="title-light"><? the_field('заголовок') ?></h1>
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-6">
                    <div class="title-block title-padding">
                        <b><? the_field('заголовок') ?></b>
                        <mark class="white-overflow"><? the_field('подзаголовок') ?></mark>
                    </div>
                    <div class="text"><?= apply_filters('the_content', wpautop(get_post_field('post_content', $id), true)); ?></div>
                    <!--<div class="buttons">
                        <a href="" class="btn-gold">БРОНИРОВАТЬ</a>
                        <a href="" class="btn-gold">ЗАКАЗАТЬ НА ДОМ</a>
                    </div>-->
                </div>
                <div class="d-none d-lg-block col-xl-5 col-lg-6">
                    <? the_post_thumbnail() ?>
                </div>
            </div>
        </div>
    </section>
    <section class="food-menu color-line-after">
        <div class="container">
            <h1 class="title-light">Наше меню</h1>
            <div class="title-block title-padding">
                <b><? the_field('заголовок_меню') ?></b>
                <mark class="white-overflow"><? the_field('подзаголовок_меню') ?></mark>
            </div>
            <ul class="nav category-menu">
                <li class="nav-item">
                    <a class=" active" data-toggle="tab" href="#all">Все блюда</a>
                </li>
                <?
                $categories = get_terms('restaurant_cat', ['hide_empty' => false]);
                foreach ($categories as $category):
                    ?>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#tax-<?= $category->term_id ?>"><?= $category->name ?></a>
                    </li>
                <? endforeach; ?>
            </ul>
            <? $foodMenu = get_field('меню'); ?>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="home-tab">
                    <div class="food-carousel owl-carousel owl-carousel-common">
                        <?
                        global $foodGroups;
                        $foodGroups = array_chunk($foodMenu, 4);
                        get_template_part('views/food')
                        ?>
                    </div>
                </div>
                <? foreach ($categories as $category):
                    $products = [];
                    foreach ($foodMenu as $product) {
                        if (in_array($category->term_id, $product['категории'])) array_push($products, $product);
                    }
                    ?>
                    <div class="tab-pane fade" id="tax-<?= $category->term_id ?>" role="tabpanel"
                         aria-labelledby="profile-tab">
                        <div class="food-carousel owl-carousel owl-carousel-common">
                            <?
                            $foodGroups = array_chunk($products, 4);
                            get_template_part('views/food')
                            ?>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    </section>
<?
$post = get_field('услуга');
global $reversed;
$reversed = 'service-item-right';
get_template_part('views/service');
$OrelHotel->services();
get_footer() ?>