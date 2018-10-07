<? /* Template Name: Главная */
get_header(); ?>
    <div class="main-section">
        <div class="reservation-container container d-flex justify-content-end">
            <div class="reservation-form custom-form-control">
                <p class="title">БРОНИРОВАНИЕ</p>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#hotel-form">Номера в гостинице</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#restaurant-form">Места в ресторане</a>
                </div>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="hotel-form">
                        <?
                        $rooms = get_posts([
                            'post_type' => 'room',
                            'posts_per_page' => -1
                        ]);
                        ?>
                        <form action="<? the_permalink($rooms[0]->ID) ?>" method="post" class="form">
                            <div class="row-inputs">
                                <label class="input-control date-block">
                                    Дата прибытия
                                    <input type="date" name="arrival"
                                           value="<?= date('Y-m-d', strtotime(' +1 day')) ?>">
                                </label>
                                <label class="input-control date-block">
                                    Дата отъезда
                                    <input type="date" name="leaving"
                                           value="<?= date('Y-m-d', strtotime(' +2 day')) ?>">
                                </label>
                            </div>
                            <label class="input-control select-control">
                                Номер
                                <select>
                                    <?
                                    foreach ($rooms as $post):
                                        ?>
                                        <option value="<? the_permalink() ?>"><? the_title() ?>
                                            (<? the_field('тип_размещения') ?>
                                            )
                                        </option>
                                    <? endforeach; wp_reset_query() ?>
                                </select>
                            </label>
                            <div class="row-inputs">
                                <label class="input-control number-block">
                                    Взрослых
                                    <input type="number" name="adults" value="1">
                                </label>
                                <label class="input-control number-block">
                                    Детей
                                    <input type="number" name="children" value="0">
                                </label>
                            </div>
                            <button type="submit" name="step" class="btn-gold submit" value="2">ЗАБРОНИРОВАТЬ</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="restaurant-form">
                        <div class="form">
                            <?= do_shortcode('[contact-form-7 id="267" title="Бронь ресторана"]') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-owl-carousel owl-carousel owl-carousel-common color-line-after">
            <?
            $gallery = get_field('баннер');
            foreach ($gallery as $photo) : ?>
                <div class="item"
                     style="background-image: url('<?= $photo['url'] ?>')">
                    <div class="shadow-block"></div>
                </div>
            <? endforeach; ?>
        </div>
    </div>
    <section class="hotel-section color-line-after">
        <h2 class="title-light">Добро пожаловать</h2>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-8">
                    <div class="title-block title-padding">
                        <b><? the_field('гостиница_заголовок') ?></b>
                        <mark class="white-overflow"><? the_field('гостиница_подзаголовок') ?></mark>
                    </div>
                    <p class="text"> <?= apply_filters('the_content', wpautop(get_field('гостиница_текст'), true)); ?></p>
                    <div class="info d-flex align-items-center">
                        <div class="info-block">
                            <i class="fal fa-cloud"></i>
                            <p>
                            <div id="meteoprog_informer_standart" data-params="none:Orel:100x65:white:23x22"><a
                                        href="https://www.meteoprog.ua/ru/"></a></div>
                            C</p>
                        </div>
                        <div class="info-block">
                            <i class="fal fa-clock"></i>
                            <p id="hotel-clock">16:32</p>
                        </div>
                    </div>
                    <script src="https://www.meteoprog.ua/ru/weather/informer/standart.js"></script>
                    <a href="<?  the_permalink(172) ?>" class="btn-gold">Подробнее</a>
                </div>
                <div class="photos col-lg-6 col-md-4">
                    <img <? the_image('гостиница_фото', $post) ?>>
                </div>
            </div>
        </div>
    </section>
    <section class="hotel-rooms color-line-after">
        <div class="container">
            <h2 class="title-light">Наши номера</h2>
            <h3 class="section-title text-center text-white mt-3"><? the_field('номера_заголовок') ?></h3>
            <h4 class="subtitle text-center text-white mb-3"><? the_field('номера_подзаголовок') ?></h4>
            <div class="hotel-room-carousel owl-carousel owl-carousel-common">
                <?
                $rooms = get_posts(['post_type' => 'room',
                    'posts_per_page' => -1]);
                foreach ($rooms as $post):
                    ?>
                    <a href="<? the_permalink() ?>" class="item">
                        <div class="photo"
                             style="background-image: url('<? the_post_thumbnail_url('medium_size') ?>')"></div>
                        <div class="padding">
                            <p class="title"><? the_title() ?> (<? the_field('тип_размещения') ?>)</p>
                            <p class="excerpt"><? the_field('описание_в_слайдере') ?></p>
                            <p class="price">от <? the_field('цена') ?>./ сутки</p>
                            <span class="btn-gold">Подробнее</span>
                        </div>
                    </a>
                <? endforeach;
                wp_reset_query() ?>
            </div>
        </div>
    </section>
<? $OrelHotel->services() ?>
<? $OrelHotel->gallery() ?>
    <section class="hotel-reviews color-line-after">
        <div class="container">
            <h2 class="title-light">Подлинные отзывы</h2>
            <div class="row">
                <div class="col-xl-7 col-lg-6">
                    <div class="title-block title-padding">
                        <b><? the_field('отзывы_заголовок') ?></b>
                        <mark class="white-overflow"><? the_field('отзывы_подзаголовок') ?><br>
                            <span><? the_field('отзывы_текст') ?></span></mark>
                    </div>
                    <div class="rate-row">
                        <div class="rate"><? the_field('отзывы_оценка') ?></div>
                        <p class="rate-title"><? the_field('отзывы_оценка_текстом') ?></p>
                        <p class="count"><? the_field('отзывы_количество') ?></p>
                    </div>
                    <div class="rate-lines d-flex justify-content-center justify-content-sm-between flex-wrap">
                        <?
                        $options = get_field('отзывы_параметры');
                        if (!empty($options)):
                            if (count($options) !== 1) {
                                $options = array_chunk($options, ceil(count($options) / 2));
                            } else {
                                $options = [[$options[0]]];
                            }
                            ?>
                            <?
                            foreach ($options as $column):
                                ?>
                                <div>
                                    <? foreach ($column as $option): ?>
                                        <div class="rate-line">
                                            <p class="title"><?= $option['название'] ?></p>
                                            <div class="progress-wrap">
                                                <div class="progress">
                                                    <div class="progress-bar"
                                                         style="width: <?= $option['оценка'] * 10 ?>%"></div>
                                                </div>
                                                <p class="rate"><?= $option['оценка'] ?></p>
                                            </div>
                                        </div>
                                    <? endforeach; ?>
                                </div>
                            <? endforeach; ?>
                        <? endif; ?>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6">
                    <div class="reviews-carousel owl-carousel owl-carousel-common">
                        <?

                        $active = 'active';
                        while (have_rows('отзывы_карусель')):the_row(); ?>
                            <a class="item <?= $active ?>" data-review="<? the_sub_field('текст') ?>">
                                <div class="icon">
                                    <div class="backdrop"></div>
                                    <img <? repeater_image('фото') ?>></div>
                                <p class="name"><? the_sub_field('имя') ?></p>
                            </a>
                            <?
                            $active = '';
                        endwhile; ?>
                    </div>
                    <div class="review-text"><?= get_field('отзывы_карусель')[0]['текст'] ?></div>
                    <!--<a href="" class="btn-gold">Больше отзывов</a>-->
                </div>
            </div>
        </div>
    </section>
<? get_footer() ?>