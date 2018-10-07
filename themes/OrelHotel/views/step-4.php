<?
global $post;

$title = get_the_title();
$class = get_field('тип_размещения');
$arrival = $_POST['arrival'];
$leaving = $_POST['leaving'];
$email = $_POST['email'];
$phone = $_POST['phone'];
//$sms = $_POST['sms'] ? 'Да' : 'Нет';
$news = $_POST['news'] ? 'Да' : 'Нет';
$arrivalTime = $_POST['arrivalTime'];
$leavingTime = $_POST['leavingTime'];
$comment = $_POST['comment'];
$message = "$title $class\nПрибытие: $arrival\nОтбытие: $leaving\nПочта: $email\nТелефон: $phone\nНовости: $news\nЗаезд: $arrivalTime\nВыезд: $leavingTime\nКомментарий: $comment\n";
$guests = $_POST['guests'];
$adults = $_POST['adults'];
$children = $_POST['children'] || 0;
$message .= "Взрослых : $adults\nДетей: $children\n";
$i = 1;
foreach ($guests as $guest) {
    $first = $guest['firstName'];
    $last = $guest['lastName'];
    $father = $guest['father'];
    $country = $guest['country'];
    $message .= "Клиент $i: $first $last $father $country\n";
    $i++;
}
$services = json_decode(urldecode($_POST['jsonServices']));

$s = 0;
foreach ($services as $service) {
    $title = $service->name;
    $count = $service->count;
    if ($count > 0) {
        if ($s == 0) {
            $message .= "Дополнительные услуги:\n";
        }
        $message .= "$title - $count.\n";
    }
    $s++;
}
 mail(get_option('admin_email'), 'OrelHotel "Бронь номера"', $message);

?>
<p>
    <b>Мы свяжемся с вами в ближайшее время:</b><br><br>
    Ваши данные:<br>
    <? pre($message) ?>
</p>