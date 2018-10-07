<section class="contact-us">
    <div class="container">
        <?= do_shortcode('[contact-form-7 id="26" title="Связаться с нами"]') ?>
    </div>
</section>
<footer class="footer">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-around">
            <div class="footer-block">
                <p class="title">КОНТАКТЫ</p>
                <div class="d-flex">
                    <i class="fas fa-phone fa-rotate-90"></i>
                    <p>
                        <?
                        while (have_rows('телефоны', 'option')) {
                            the_row();
                            $phone = get_sub_field('телефон');
                            $rawPhone = phoneLink($phone);
                            echo "<a href='$rawPhone'>$phone</a>";
                        }
                        ?>
                    </p>
                </div>
                <div class="d-flex">
                    <i class="fas fa-envelope-open"></i>
                    <p><a href=""><? the_field('почта', 'option') ?></a></p>
                </div>
                <div class="d-flex">
                    <i class="fas fa-map-marker-alt"></i>
                    <p><? the_field('футер_адрес', 'option') ?></p>
                </div>
            </div>
            <div class="footer-block">
                <p class="title">БРОНИРОВАНИЕ<br><span>ПО ТЕЛЕФОНУ</span></p>
                <p>Гостиница
                    <b><a href=""><? the_field('бронирование_гостиница', 'option') ?></a></b></p>
                <p>Ресторан
                    <b><a href=""><? the_field('бронирование_ресторан', 'option') ?></a></b></p>
            </div>
            <div class="footer-block">
                <p class="title">Услуги</p>
                <ul>
                    <? $services = get_posts([
                        'post_type' => 'service',
                        'posts_per_page' => -1
                    ]);
                    foreach ($services as $post):
                        ?>
                        <li><a href="<? the_permalink() ?>"><? the_title() ?></a></li>
                    <? endforeach; ?>
                </ul>
            </div>
            <div class="footer-block">
                <p class="title">О Гостинице</p>
                <?php wp_nav_menu(array(
                    'location' => 'footer_menu',
                    'container' => null,
                    'items_wrap' => '<ul>%3$s</ul>',
                )); ?>
            </div>
            <div class="footer-block">
                <p class="title">Присоединяйтесь к нам</p>
                <p>Присоединяйтесь к нам<br>в социальных сетях:</p>
                <div class="social">
                    <?
                    while (have_rows('соц_сети', 'option')) {
                        the_row();
                        $link = get_sub_field('ссылка');
                        $icon = get_sub_field('иконка');
                        echo "<a href='$link'><i class='fab $icon'></i></a>";
                    }
                    ?>
                </div>
                <div class="dev">
                    <p>Создано компанией</p>
                    <a href="<? the_field('itnp', 'option') ?>"><img src="<?= path() ?>img/itnp.png" alt=""></a>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright"><? the_field('копирайт', 'option') ?></div>
</footer>
<? wp_footer() ?>
