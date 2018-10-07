function bodyClass($class) {
    return $('body').hasClass($class);
}

function hotelClock() {
    let local = new Date(),
        utc = local.getTime() + (local.getTimezoneOffset() * 60000),
        today = new Date(utc + (3600000 * 3)),
        h = today.getHours(), m = today.getMinutes();

    if (m < 10) {
        m = "0" + m;
    }
    document.getElementById('hotel-clock').innerHTML = h + ":" + m;
    const t = setTimeout(hotelClock, 500);
}

function reviewsCarousel() {
    $('.reviews-carousel a').click(e => {
        e.preventDefault();
        let $this = $(e.currentTarget),
            text = $this.attr('data-review');
        if (!$this.hasClass('active')) {
            $('.reviews-carousel .active').removeClass('active');
            $('.review-text').fadeOut(250, function () {
                $('.review-text').html(text);
                $(this).fadeIn(250);
            });
            $this.addClass('active');
        }
    });
}

function headerMenu() {
    $('.header .toggle-btn').click(function () {
        $(this).toggleClass('active');
        $('.header .nav-main').slideToggle();
    });
}

function roomGallery() {
    $('.room-gallery a').click(e => {
        e.preventDefault();
        let $this = $(e.currentTarget),
            src = $this.attr('href');
        if (!$this.hasClass('active')) {
            $this.parent().find('.active').removeClass('active');
            $this.closest('.room-item').find('.main-photo').fadeOut(200, function () {
                $this.closest('.room-item').find('.main-photo').css('background-image', `url('${src}')`);
                $(this).fadeIn(200);
                $this.addClass('active');
            });
        }
    });
}

function hotelForm() {
    $('#hotel-form select').change(function (e) {
        let room = $(this).val();
        $('#hotel-form form').attr('action', room);
    });
}


class Gallery {
    constructor() {
        this.limit = 12;
        this.btn = $('.gallery .load-more');
        this.load();
        this.justify();
        this.filter();
        $('.gallery .load-more').click((e) => {
            e.preventDefault();
            this.load();
        });
    }

    justify() {
        $(".gallery .tab").justifiedGallery({
            rowHeight: 371,
            maxRowHeight: 371,
            imgSelector: 'img',
            margins: 8
        });
    }

    filter() {
        $('.category-menu a').click((e) => {
            e.preventDefault();
            const $this = $(e.currentTarget),
                tax = parseInt($this.attr('data-tax'));
            if (!$this.hasClass('active')) {
                $this.closest('ul').find('.active').removeClass('active');
                $this.addClass('active');
            }
            $(`.gallery .tab a`).remove();
            if (!tax) {
                this.load();
            } else {
                $(`.gallery .photos a[data-tax~=${tax}]`).clone().appendTo('.gallery .tab');
                this.btn.fadeOut();
            }
            this.justify();
        });
    }

    load() {
        let gallery = $(`.gallery .tab`),
            offset = gallery.children().length,
            source = $(`.gallery .photos a`);

        source.slice(offset, offset + this.limit).clone().appendTo('.gallery .tab');
        if (!source.slice(gallery.children().length, gallery.children().length + 1)[0]) {
            this.btn.fadeOut();
        } else {
            this.btn.fadeIn();
        }
        this.justify();
    }
}

class RoomReservation {
    constructor() {
        this.plainForm();
        if (bodyClass('reservation-step')) {
            let offset = $('.reservation-room-form').offset().top - 200;
            $('body,html').animate({scrollTop: offset}, Math.abs(offset - $(document).scrollTop()) / 1.5);
        }
        if (bodyClass('payment-step')) {
            let offset = $('.payment-form').offset().top;
            $('body,html').animate({scrollTop: offset}, Math.abs(offset - $(document).scrollTop()) / 1.5);
        }
        if (bodyClass('success-step')) {
            let offset = $('.room-advantages').offset().top;
            $('body,html').animate({scrollTop: offset}, Math.abs(offset - $(document).scrollTop()) / 1.5);
        }
    }

    plainForm() {
        if (!bodyClass('payment-step') && !bodyClass('success-step')) {
            const vue = new Vue({
                el: '#room-reserv-form-plain',
                data: {
                    startDate: null,
                    endDate: null,
                    adults: 1,
                    children: 0,
                    services: []
                },
                computed: {
                    days() {
                        let startDate = new Date(this.startDate),
                            endDate = new Date(this.endDate);
                        if (endDate > startDate)
                            return (endDate - startDate) / (3600 * 24 * 1000);
                    },
                    subtotal() {
                        if (this.days) {
                            let additionalSum = 0;
                            if (this.services) {
                                additionalSum = this.services.reduce((sum, currentValue) => {
                                    return sum + currentValue.price * currentValue.count
                                }, 0);
                                additionalSum *= this.days;
                            }

                            return price * this.days + additionalSum;
                        }
                        return 0;
                    },
                    usedServices() {
                        if (this.services) {
                            return this.services.reduce((sum, curr) => {
                                return sum + curr.count
                            }, 0)
                        }
                    },
                    convertedServices() {
                        return encodeURIComponent(JSON.stringify(this.services))
                    }
                },
                filters: {
                    date(value) {
                        let date = new Date(value),
                            locale = "ru",
                            month = date.toLocaleString(locale, {month: "long"});
                        month = month.charAt(0).toUpperCase() + month.slice(1);
                        return `${month} ${date.getDate()}`
                    }
                },
                created() {
                    if (bodyClass('reservation-step') && services) {
                        services.forEach((value, i) => {
                            services[i].count = '';
                            services[i].max_count = parseInt(services[i].max_count);
                        });
                        this.services = services;
                    }
                },
                mounted() {
                    let today = new Date(),
                        startDate = new Date(),
                        endDate = new Date();
                    startDate.setDate(today.getDate() + 1);
                    endDate.setDate(today.getDate() + 2);
                    startDate = startDate.toISOString().slice(0, 10).replace(/-/g, "-");
                    endDate = endDate.toISOString().slice(0, 10).replace(/-/g, "-");
                    this.startDate = startDate;
                    this.endDate = endDate;
                    if (bodyClass('reservation-step') && formData.arrival) {
                        if (this.startDate) {
                            this.startDate = formData.arrival;
                            this.endDate = formData.leaving;
                            this.adults = formData.adults;
                            this.children = formData.children;
                        }
                    }
                }
            });
        }
    }
}

$(() => {
    headerMenu();
    hotelForm();
    $("input[type=tel]").mask("+7 (999) 999 - 99 - 99");
    let carouselNavText = ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'];
    $(".stock-carousel").owlCarousel({
        nav: true,
        navText: carouselNavText,
        items: 1,
        dots: true
    });
    if (bodyClass('home')) {
        $(".main-owl-carousel").owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            nav: true,
            navText: carouselNavText,
            smartSpeed: 750
        });
        $(".hotel-room-carousel").owlCarousel({
            nav: true,
            margin: 16,
            navText: carouselNavText,
            responsive: {
                1200: {
                    items: 4,
                    // slideBy: 4
                },
                768: {
                    items: 3,
                    //   slideBy: 3
                },
                576: {
                    items: 2,
                    slideBy: 1
                },
                1: {
                    items: 1,
                    center: true,
                    dots: false
                }
            }
        });
        $(".reviews-carousel").owlCarousel({
            nav: true,
            dots: false,
            slideBy: 1,
            navText: carouselNavText,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 4
                }
            }
        });
        hotelClock();
        reviewsCarousel();
    }
    if (bodyClass('home') || bodyClass('page-template-about')) {
        $(".gallery-carousel").owlCarousel({
            loop: true,
            nav: true,
            dots: false,
            slideBy: 1,
            navText: carouselNavText,
            responsive: {
                1200: {
                    items: 3,
                },
                768: {
                    items: 2
                }
            }
        });
    }
    if (bodyClass('post-type-archive-room')) {
        roomGallery();
    }
    if (bodyClass('single-room-service')) {
        $(".room-gallery").owlCarousel({
            loop: true,
            autoplay: true,
            smartSpeed: 750,
            margin: 8,
            nav: true,
            center: true,
            navText: carouselNavText,
            responsive: {
                1200: {
                    items: 3,
                    autoWidth: true,

                },
                576: {
                    items: 1,
                    nav: true,
                },
                0: {
                    items: 1,
                    nav: false
                }
            }
        });
    }
    if (bodyClass('single-room')) {
        new RoomReservation();
    }
    if (bodyClass('single-service')) {
        if (bodyClass('reservation-step')) {
            let offset = $('.reservation-room-form').offset().top - 200;
            $('body,html').animate({scrollTop: offset}, Math.abs(offset - $(document).scrollTop()) / 1.5);
        }
    }
    if (bodyClass('single-stock')) {
        $(".promotion-carousel").owlCarousel({
            loop: true,
            margin: 13,
            navText: carouselNavText,
            responsive: {
                1200: {
                    items: 3,
                },
                576: {
                    items: 2,
                    nav: true,
                },
                0: {
                    items: 1,
                    nav: false
                }
            }
        });
    }
    if (bodyClass('page-template-gallery')) {
        new Gallery();
    }
    if (bodyClass('page-template-restaurant')) {
        $(".food-carousel").owlCarousel({
            nav: true,
            smartSpeed: 500,
            navText: carouselNavText,
            responsive: {
                991: {
                    items: 2,
                },
                576: {
                    dots: true,
                    items: 1,
                },
                0: {
                    items: 1,
                    dots: false,
                }
            }
        });
    }
});