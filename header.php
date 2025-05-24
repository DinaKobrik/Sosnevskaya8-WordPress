<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ЖК 8-я Сосневская — элитные квартиры в Москве. Выберите планировку, этаж и оформите ипотеку. 14 минут до метро Тульская, 100 м до Кремля.">
    <meta name="keywords" content="ЖК 8-я Сосневская, элитные квартиры Москва, купить квартиру, ипотека, метро Тульская, премиум недвижимость, планировки квартир">
    <title><?php bloginfo('name'); echo " | "; bloginfo('description'); ?></title>
     <link rel="apple-touch-icon" sizes="180x180" href="<?php echo bloginfo('template_url'); ?>/assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo bloginfo('template_url'); ?>/assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo bloginfo('template_url'); ?>/assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo bloginfo('template_url'); ?>/assets/img/favicon/site.webmanifest">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:opsz@14..32&family=Montserrat:wght@100..900&family=Playfair+Display:ital@1&display=swap"
        rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body>
    <div class="preloader">
        <div class="preloader__box">
            <div class="preloader__letter">L</div>
            <div class="preloader__letter">O</div>
            <div class="preloader__letter">A</div>
            <div class="preloader__letter">D</div>
            <div class="preloader__letter">I</div>
            <div class="preloader__letter">N</div>
            <div class="preloader__letter">G</div>
        </div>
    </div>
    <header class="header" id="header">
        <div class="hamburger">
            <span class="hamburger__line"></span>
            <span class="hamburger__line"></span>
            <span class="hamburger__line"></span>
        </div>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="header__logo"><img src="<?php echo bloginfo('template_url'); ?>/assets/img/logo.png" alt="Логотип"></a>
        <div class="menu__overlay">
            <nav class="menu">
                <div class="menu__close">&times;</div>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="menu__logo">
                    <img src="<?php echo bloginfo('template_url'); ?>/assets/img/logo_invert.png" alt="Логотип"></a>
                <ul class="menu__list">
                    <li class="menu__item"><a href="#advantages" class="menu__link">Преимущества</a></li>
                    <li class="menu__item"><a href="#infrastructure" class="menu__link">Инфраструктура</a></li>
                    <li class="menu__item"><a href="#select" class="menu__link">Квартиры</a></li>
                    <li class="menu__item"><a href="#mortgage" class="menu__link">Ипотека</a></li>
                    <li class="menu__item"><a href="#contact" class="menu__link">Контакты</a></li>
                </ul>
                <a href="tel:<?php the_field("phone") ?>" class="menu__phone">
                    <span class="menu__phone-icon"><img src="<?php echo bloginfo('template_url'); ?>/assets/img/icon_social/phone.svg" alt="Позвонить"></span>
                    <span class="menu__phone-number phone"><?php the_field("phone") ?></span>
                </a>
            </nav>
        </div>
        <a href="tel:<?php the_field("phone") ?>"  class="header__phone">
            <span class="header__phone-icon"><img src="<?php echo bloginfo('template_url'); ?>/assets/img/icon_social/phone.svg" alt="Позвонить"></span>
            <span class="header__phone-number phone"><?php the_field("phone") ?></span>
        </a>
    </header>