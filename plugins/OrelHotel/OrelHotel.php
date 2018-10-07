<?php


class OrelHotel
{

    private $isWoocommerce = false;

    public function __construct()
    {
        $this->themeSetup();
        $this->enqueueStyles();
        $this->enqueueScripts();
        $this->customHooks();
        //$this->registerWidgets();
        $this->registerNavMenus();
        $this->registerTaxonomies();
        $this->registerPostTypes();
        add_action('plugins_loaded', function () {
            if ($this->isWoocommerce) {
                $this->Woocommerce();
            }
            $this->ACF();
            $this->GPSI();
        });
    }

    private function themeSetup()
    {
        add_theme_support('post-thumbnails');
        add_theme_support('menus');
        add_theme_support('widgets');
        show_admin_bar(false);
    }

    private function enqueueStyles()
    {
        add_action('wp_print_styles', function () {
            wp_register_style('main', get_template_directory_uri() . '/css/main.css');
            wp_enqueue_style('main');
        });
    }

    private function enqueueScripts()
    {
        add_action('wp_enqueue_scripts', function () {
            wp_deregister_script('jquery');
            wp_register_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js');
            wp_enqueue_script('jquery');
            wp_register_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js');
            wp_enqueue_script('popper');
            wp_register_script('bootstrap', get_template_directory_uri() . '/node_modules/bootstrap/dist/js/bootstrap.min.js');
            wp_enqueue_script('bootstrap');
            wp_register_script('vue', get_template_directory_uri() . '/node_modules/vue/dist/vue.js');
            wp_enqueue_script('vue');
            wp_register_script('fontawesome', get_template_directory_uri() . '/node_modules/@fortawesome/fontawesome-free/js/all.min.js');
            wp_enqueue_script('fontawesome');
            wp_register_script('fancybox', get_template_directory_uri() . '/node_modules/@fancyapps/fancybox/dist/jquery.fancybox.min.js');
            wp_enqueue_script('fancybox');
            wp_register_script('owl.carousel', get_template_directory_uri() . '/node_modules/owl.carousel/dist/owl.carousel.min.js');
            wp_enqueue_script('owl.carousel');
            wp_register_script('mask', get_template_directory_uri() . '/node_modules/jquery.maskedinput/src/jquery.maskedinput.js');
            wp_enqueue_script('mask');
            wp_register_script('gallery', get_template_directory_uri() . '/js/jquery.justifiedGallery.min.js');
            wp_enqueue_script('gallery');
            wp_register_script('main', get_template_directory_uri() . '/js/main.js');
            wp_enqueue_script('main');
        });
    }

    private function customHooks()
    {
        add_action('admin_menu', function () {
            remove_menu_page('edit-comments.php');
        });
        add_filter('wpcf7_form_elements', function ($content) {
            // pre($content);
            if (strpos($content, 'человек') !== false) {
                $content = strip_tags($content, '<p><span><label><input><div><textarea>');
            } elseif (strpos($content, 'Оставьте') !== false) {
                $content = strip_tags($content, '<h2><h3><p><span><label><input><div><textarea>');
            } else if (strpos($content, 'Пожелания к брони') !== false) {
                $content = strip_tags($content, '<label><input><div><textarea>');
            }
            return $content;
        });
        // add_filter('wpcf7_autop_or_not', '__return_false');
        add_action('wpcf7_init', function () {
            wpcf7_add_form_tag('order_date', function ($tag) {
                $date = '';
                $date .= '<label class="input-control date-block">Дата прибытия';
                $nextDate = date('Y-m-d', strtotime(' + 1 day'));
                $date .= '<input type="date" name="arrival" value="' . $nextDate . '">';
                $date .= '</label>';
                return $date;
            });
        });

        add_image_size('room_size', 1920, 900, ['center', 'center']);

        add_filter('body_class', function ($classes) {
            if (is_single() && (get_post_type() == 'room' || get_post_type() == 'service')) {
                $classes[] = 'single-room-service';
            }
            if (isset($_POST['step']) && $_POST['step'] == 2) {
                $classes[] = 'reservation-step';
            }
            if (isset($_POST['step']) && $_POST['step'] == 3) {
                $classes[] = 'payment-step';
            }
            if (isset($_POST['step']) && $_POST['step'] == 4) {
                $classes[] = 'success-step';
            }
            return $classes;
        });
    }

    private function registerWidgets()
    {
        add_action('widgets_init', function () {
            register_sidebar([
                'name' => "Правая боковая панель сайта",
                'id' => 'right-sidebar',
                'description' => 'Эти виджеты будут показаны в правой колонке сайта',
                'before_title' => '<h1>',
                'after_title' => '</h1>'
            ]);
        });
    }

    private function registerNavMenus()
    {
        add_action('after_setup_theme', function () {
            register_nav_menus(array(
                'header_menu' => 'Меню в шапке',
                'footer_menu' => 'Меню в подвале'
            ));
        });
        if (!file_exists(plugin_dir_path(__FILE__) . 'includes/wp-bootstrap-navwalker.php')) {
            return new WP_Error('wp-bootstrap-navwalker-missing', __('It appears the wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker'));
        } else {
            require_once plugin_dir_path(__FILE__) . 'includes/wp-bootstrap-navwalker.php';
        }

    }

    private function registerPostTypes()
    {
        add_action('init', function () {
            register_post_type('room', [
                'label' => null,
                'labels' => [
                    'name' => 'Номера', // основное название для типа записи
                    'singular_name' => 'Номера', // название для одной записи этого типа
                    'add_new' => 'Добавить номер', // для добавления новой записи
                    'add_new_item' => 'Добавление номера', // заголовка у вновь создаваемой записи в админ-панели.
                    'edit_item' => 'Редактирование номера', // для редактирования типа записи
                    'new_item' => '', // текст новой записи
                    'view_item' => 'Смотреть номер', // для просмотра записи этого типа.
                    'search_items' => 'Искать номера', // для поиска по этим типам записи
                    'not_found' => 'Не найдено', // если в результате поиска ничего не было найдено
                    'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
                    'menu_name' => 'Номера', // название меню
                ],
                'public' => true,
                'menu_position' => 3,
                'menu_icon' => 'dashicons-admin-home',
                'supports' => array('title', 'editor', 'custom-fields', 'thumbnail'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
                'has_archive' => true,
                'rewrite' => ['slug' => 'rooms'],
            ]);
            register_post_type('stock', [
                'label' => null,
                'labels' => [
                    'name' => 'Спецпредложения', // основное название для типа записи
                    'singular_name' => 'Спецпредложения', // название для одной записи этого типа
                    'add_new' => 'Добавить cпецпредложение', // для добавления новой записи
                    'add_new_item' => 'Добавление спецпредложения', // заголовка у вновь создаваемой записи в админ-панели.
                    'edit_item' => 'Редактирование спецпредложения', // для редактирования типа записи
                    'new_item' => '', // текст новой записи
                    'view_item' => 'Смотреть cпецпредложение', // для просмотра записи этого типа.
                    'search_items' => 'Искать cпецпредложение', // для поиска по этим типам записи
                    'not_found' => 'Не найдено', // если в результате поиска ничего не было найдено
                    'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
                    'menu_name' => 'Спецпредложения', // название меню
                ],
                'public' => true,
                'menu_position' => 5,
                'menu_icon' => 'dashicons-sos',
                'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
                'has_archive' => true,
                // 'rewrite' => ['slug' => 'stock'],
            ]);
            register_post_type('service', [
                'label' => null,
                'labels' => [
                    'name' => 'Услуги', // основное название для типа записи
                    'singular_name' => 'Услуги', // название для одной записи этого типа
                    'add_new' => 'Добавить услугу', // для добавления новой записи
                    'add_new_item' => 'Добавление Услуги', // заголовка у вновь создаваемой записи в админ-панели.
                    'edit_item' => 'Редактирование Услуги', // для редактирования типа записи
                    'new_item' => '', // текст новой записи
                    'view_item' => 'Смотреть услугу', // для просмотра записи этого типа.
                    'search_items' => 'Искать услугу', // для поиска по этим типам записи
                    'not_found' => 'Не найдено', // если в результате поиска ничего не было найдено
                    'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
                    'menu_name' => 'Услуги', // название меню
                ],
                'public' => true,
                'menu_position' => 6,
                'menu_icon' => 'dashicons-businessman',
                'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
                'has_archive' => true,
                // 'rewrite' => ['slug' => 'stock'],
            ]);
        });
    }

    private function registerTaxonomies()
    {
        add_action('init', function () {
            register_taxonomy('gallery_cat', ['room'], [
                'label' => '', // определяется параметром $labels->name
                'labels' => [
                    'name' => 'Категории фото',
                    'singular_name' => 'Категории фото',
                    'search_items' => 'Искать Категорию фото',
                    'all_items' => 'Новая Категория фото',
                    'view_item ' => 'Смотреть Категорию фото',
                    'parent_item' => 'Родитель Категории фото',
                    'parent_item_colon' => 'Родитель Категории фото:',
                    'edit_item' => 'Редактировать Категорию фото',
                    'update_item' => 'Обновить Категорию фото',
                    'add_new_item' => 'Добавить новую Категорию фото',
                    'new_item_name' => 'Категории фото',
                    'menu_name' => 'Категории фото',
                ],
                'public' => true,
                'meta_box_cb' => false,
            ]);
            register_taxonomy('restaurant_cat', ['room'], [
                'label' => '', // определяется параметром $labels->name
                'labels' => [
                    'name' => 'Категории блюд',
                    'singular_name' => 'Категории блюд',
                    'search_items' => 'Искать Категорию блюд',
                    'all_items' => 'Новая Категория блюд',
                    'view_item ' => 'Смотреть Категорию блюд',
                    'parent_item' => 'Родитель Категории блюд',
                    'parent_item_colon' => 'Родитель Категории блюд:',
                    'edit_item' => 'Редактировать Категорию блюд',
                    'update_item' => 'Обновить Категорию блюд',
                    'add_new_item' => 'Добавить новую Категорию блюд',
                    'new_item_name' => 'Категории блюд',
                    'menu_name' => 'Категории блюд',
                ],
                'public' => true,
                'meta_box_cb' => false,
            ]);
        });

    }

    private function Woocommerce()
    {
        add_action('after_setup_theme', function () {
            add_theme_support('woocommerce');
        });
        add_filter('woocommerce_enqueue_styles', '__return_empty_array');
        remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
        remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
        /*
                add_filter('woocommerce_checkout_fields', function ($fields) {
                    $fields['billing']['billing_address_1']['required'] = false;
                    $fields['billing']['billing_country']['required'] = false;
                    $fields['billing']['billing_city']['required'] = false;
                    $fields['billing']['billing_postcode']['required'] = false;
                    $fields['billing']['billing_address_2']['required'] = false;
                    $fields['billing']['billing_state']['required'] = false;
                    $fields['billing']['billing_email']['required'] = false;
                    $fields['order']['order_comments']['type'] = 'text';
                    $fields['billing']['billing_postcode']['label'] = 'Квартира';
                    $fields['billing']['billing_state']['label'] = 'Корпус';
                    //unset($fields['billing']['billing_last_name']);
                    //unset($fields['billing']['billing_company']);
                    //unset( $fields['billing']['billing_postcode'] );
                    //unset( $fields['billing']['billing_state'] );
                    //unset( $fields['billing']['billing_email'] );
                    //unset($fields['billing']['billing_country']);
                    //unset($fields['billing']['billing_address_2']);
                    //unset($fields['billing']['billing_state']);
                    return $fields;
                });
*/
        add_filter('woocommerce_currency_symbol', function ($currency_symbol, $currency) {

            switch ($currency) {
                case 'UAH':
                    $currency_symbol = ' грн.';
                    break;
            }

            return $currency_symbol;
        }, 10, 2);
    }

    private function ACF()
    {
        if (function_exists('acf_add_options_page')) {
            $main = acf_add_options_page([
                'page_title' => 'Настройки темы',
                'menu_title' => 'Настройки темы',
                'menu_slug' => 'theme-general-settings',
                'capability' => 'edit_posts',
                'redirect' => false,
                'position' => 2,
                'icon_url' => 'dashicons-admin-customizer',
            ]);
        }
    }

    private function GPSI()
    {
        require_once "includes/GPSI.php";
    }

    public function breadcrumb()
    {
        require_once "includes/breadcrumb.php";
        breadcrumbs();
    }

    public function services()
    {
        get_template_part('views/services');
    }

    public function gallery()
    {
        get_template_part('views/gallery');
    }

    public function reservationForm()
    {
        get_template_part('views/reservation-form');
    }

}