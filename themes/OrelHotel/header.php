<!DOCTYPE html>
<html lang="<? bloginfo('language') ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= wp_get_document_title() ?></title>
    <? wp_head() ?>
</head>
<?
?>
<body <? body_class() ?>>
<?
$stock = get_posts([
    'post_type' => 'stock',
    'posts_per_page' => -1
]);
if (!empty($stock)):
    ?>
    <div class="stock-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <p class="title">СПЕЦПРЕДЛОЖЕНИЯ</p>
                </div>
                <div class="col-lg-9 col-md-8 stock-carousel owl-carousel owl-carousel-common">
                    <? foreach ($stock as $post): ?>
                        <a href="<? the_permalink() ?>" class="item">
                            <p class="text"><? the_title() ?></p>
                            <div class="photo" style="background-image: url('<? the_post_thumbnail_url() ?>')"></div>
                        </a>
                    <? endforeach; ?>
                </div>
            </div>
        </div>
    </div>
<? endif;
wp_reset_query() ?>
<header class="header">
    <div class="nav-top">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="language-switcher">
                <!-- <a href="" class="lang active">RU</a>
                 <a href="" class="lang">ENG</a>-->
                <?= do_shortcode('[google-translator]') ?>
            </div>
            <div class="header-contacts d-flex flex-wrap justify-content-end">
                <div class="d-flex align-items-center">
                    <i class="fas fa-map-marker-alt"></i>
                    <p><? the_field('хедер_адрес', 'option') ?></p>
                </div>
                <div class="d-flex align-items-center">
                    <i class="fas fa-phone fa-rotate-90"></i>
                    <p>
                        <?
                        $i = 0;
                        while (have_rows('телефоны', 'option')) {
                            the_row();
                            $i++;
                            $phone = get_sub_field('телефон');
                            $rawPhone = phoneLink($phone);
                            $last = $i !== count(get_field('телефоны', 'option')) ? ', ' : '';
                            echo "<a href='$rawPhone'>$phone</a>" . $last;
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="nav-main">
        <div class="container d-flex justify-content-center align-items-center">
            <nav class="nav-menu">
                <ul class="menu">
                    <?
                    $hotelActive = '';
                    $roomActive = '';
                    $restaurantActive = '';
                    $serviceActive = '';
                    $galleryActive = '';
                    $contactActive = '';

                    switch (get_page_template_slug()) {
                        case 'pages/about.php':
                            $hotelActive = 'active';
                            break;
                        case 'pages/restaurant.php':
                            $restaurantActive = 'active';
                            break;
                        case 'pages/gallery.php':
                            $galleryActive = 'active';
                            break;
                        case 'pages/contacts.php':
                            $contactActive = 'active';
                            break;
                    }

                    switch (get_post_type()) {
                        case 'room':
                            $roomActive = 'active';
                            break;
                        case 'service':
                            $serviceActive = 'active';
                            break;
                    }
                    ?>
                    <li><a class="<?= $hotelActive ?>" href="<? the_permalink(172) ?>"><i class="fal fa-building"></i>ГОСТИНИЦА</a>
                    </li>
                    <li><a class="<?= $roomActive ?>" href="<?= get_post_type_archive_link('room') ?>"><i
                                    class="fal fa-bed"></i>НОМЕРА</a></li>
                    <li><a class="<?= $restaurantActive ?>" href="<? the_permalink(186) ?>"><i
                                    class="fal fa-utensils"></i>РЕСТОРАН</a></li>
                </ul>
            </nav>
            <a href="<? bloginfo('url') ?>" class="logo"><img src="<?= path() ?>img/header-logo.png" alt=""></a>
            <nav class="nav-menu">
                <ul class="menu">
                    <li><a class="<?= $serviceActive ?>" href="<?= get_post_type_archive_link('service') ?>"><i
                                    class="fas fa-concierge-bell"></i>УСЛУГИ</a>
                    </li>
                    <li><a class="<?= $galleryActive ?>" href="<? the_permalink(105) ?>"><i class="fal fa-camera"></i>ФОТОГАЛЛЕРЕЯ</a>
                    </li>
                    <li><a class="<?= $contactActive ?>" href="<? the_permalink(149) ?>"><i
                                    class="fal fa-address-book"></i>КОНТАКТЫ</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <button class="toggle-btn">
        <span></span>
        <span></span>
        <span></span>
    </button>
</header>