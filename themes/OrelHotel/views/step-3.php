<?

$arrival = $_POST['arrival'];
$leaving = $_POST['leaving'];
$adults = $_POST['adults'];
$children = $_POST['children'] || 0;
$subtotal = $_POST['subtotal'];
$usedServices = $_POST['services'];
$services = $_POST['jsonServices'];

$humanCount = (string)($adults + $children);
$lastDigit = $humanCount[strlen($humanCount) - 1];

if ($lastDigit == 1) {
    $humanCount .= ' гость';
} elseif ($lastDigit < 5) {
    $humanCount .= ' гостя';
} else {
    $humanCount .= ' гостей';
}

$ruMonths = array('Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь');
$enMonths = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

$arrivalDate = new DateTime($arrival);
$arrivalDate = $arrivalDate->format('F d');
$arrivalDate = str_replace($enMonths, $ruMonths, $arrivalDate);
$leavingDate = new DateTime($leaving);
$leavingDate = $leavingDate->format('F d');
$leavingDate = str_replace($enMonths, $ruMonths, $leavingDate);

$services = $_POST['jsonServices'];
?>
<form method="POST" class="payment-form custom-form-control">
    <header class="form-header">
        <p class="title">Оплата заказа</p>
        <p class="short-review"><?= $humanCount ?>, <?= $usedServices ?> доп.мест. <br><?= $arrivalDate ?>
            — <?= $leavingDate ?></p>
        <p class="subtotal">Общая стоимость:<span><?= $subtotal ?> руб.</span></p>
    </header>
    <p class="form-title">Как с вами связаться</p>
    <div class="field main-field">
        <label class="input-control email-block">
            <input type="email" name="email" placeholder="Адрес электронной почты (email)" required>
            <span>На этот адрес будет выслано подтверждение бронирования с возможностью отмены брони</span>
        </label>
    </div>
    <div class="field main-field">
        <label class="input-control">
            <input type="tel" name="phone" placeholder="+7" required>
            <span>Пожалуйста, введите номер телефона. Пример: +79010000000</span>
        </label>
    </div>
    <!--<label class="input-control checkbox-block mt-3">
        <input type="checkbox" name="sms"><span class="check-box"></span> Я хочу получить бесплатное
        SMS-подтверждение
        бронирования
    </label>-->
    <label class="input-control checkbox-block">
        <input type="checkbox" name="news" checked><span class="check-box"></span> Я хочу узнавать о
        специальных
        предложениях и новостях гостиницы по email или SMS
    </label>
    <p class="form-title">Информация о гостях</p>
    <? for ($i = 1; $i <= $adults; $i++): ?>
        <div class="field client-field">
            <p><?= $i ?> гость</p>
            <div class="row-inputs">
                <input type="text" name="guests[<?= $i ?>][firstName]" required placeholder="Фамилия">
                <input type="text" name="guests[<?= $i ?>][lastName]" required placeholder="Имя">
                <input type="text" name="guests[<?= $i ?>][father]" required placeholder="Отчество">
                <input type="text" name="guests[<?= $i ?>][country]" placeholder="Гражданство">
            </div>
        </div>
    <? endfor; ?>
    <p class="form-title">Время заезда и выезда</p>
    <div class="field come-in-out">
        <label class="input-control time-block">
            Заезд: <input type="time" name="arrivalTime" value="14:00">
        </label>
        <label class="input-control time-block">
            Выезд: <input type="time" name="leavingTime" value="12:00">
        </label>
        <p>Вы можете выбрать удобное для вас время заезда и выезда.<br>
            Стандартное время заезда — 14:00, выезда — 12:00.</p>
    </div>
    <p class="time-details">Расчет раннего заезда: заезд ранее 12:00 тарифицируется как полные сутки проживания в номере
        заявленной
        категории. Заселение с 12:00 до 14:00 без дополнительной платы осуществляется только при наличии
        свободных и готовых к заселению номеров забронированной категории. Расчет позднего выезда:при выезде с
        12:00-18:00 - оплата почасовая, с 18:00-24:00 - 50% стоимости номера,выезд после 24:00 тарифицируется
        как полные сутки.
    </p>
    <p class="form-title">Дополнительные комментарии</p>
    <div class="field comment-field">
        <label class="input-control">
            <span>Здесь вы можете написать, что вам необходимы<br>дополнительная кровать для ребёнка или другие услуги</span>
            <input type="text" name="comment" placeholder="Комментарии">
        </label>
    </div>
    <label class="checkbox-block personal-field">
        <input type="checkbox" required><span class="check-box"></span> Я согласен с обработкой персональных данных,
        пользовательским соглашением и политикой конфиденциальности
    </label>
    <hr>
    <div class="payment-control">
        <p class="make-payment">
            <b>Оплатить при заселении</b>
            Выбирая этот способ оплаты, вы НЕ ВНОСИТЕ ПРЕДОПЛАТУ за бронь.<br>
            Получаете подтверждение бронирования и предъявляете его при заселении.
        </p>
        <div class="d-flex flex-column flex-sm-row align-items-center">
            <p class="subtotal">Общая стоимость:<span><?= $subtotal ?> руб.</span></p>
            <input type="hidden" name="jsonServices" value="<?= $services ?>">
            <input type="hidden" name="arrival" value="<?= $arrival ?>">
            <input type="hidden" name="leaving" value="<?= $leaving ?>">
            <input type="hidden" name="adults" value="<?= $adults ?>">
            <input type="hidden" name="children" value="<?= $children ?>">
            <button class="submit" name="step" value="4">ЗАБРОНИРОВАТЬ</button>
        </div>
    </div>
</form>