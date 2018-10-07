<? get_header(); ?>
    <div class="main">
        <div class="container">
            <? $OrelHotel->reservationForm() ?>
        </div>
    </div>
<? $OrelHotel->services();

$i = 1;
while (have_posts()) {
    the_post();
    global $reversed;
    $reversed = $i % 2 == 0 ? '' : 'service-item-right';
    get_template_part('views/service');
    $i++;
}
get_footer() ?>