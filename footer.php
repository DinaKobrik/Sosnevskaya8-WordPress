
<div class="up"><a href="#header">&raquo;</a></div>
<footer class="footer">
    <div class="footer__container">
        <div class="footer__wrapper">
            <div class="hamburger">
                <span class="hamburger__line"></span>
                <span class="hamburger__line"></span>
                <span class="hamburger__line"></span>
            </div>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="footer__logo">
            <span class="footer__logo-top">8-я</span>
            <span class="footer__logo-bottom">сосневская</span>
            </a> 
            <div class="menu__overlay">
                <nav class="menu">
                    <div class="menu__close">&times;</div>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="menu__logo">
                    <span class="menu__logo-top">8-я</span>
                    <span class="menu__logo-bottom">сосневская</span>
                    </a>
                    <ul class="menu__list">
                        <li class="menu__item"><a href="#advantages" class="menu__link">Преимущества</a></li>
                        <li class="menu__item"><a href="#infrastructure" class="menu__link">Инфраструктура</a></li>
                        <li class="menu__item"><a href="#select" class="menu__link">Квартиры</a></li>
                        <li class="menu__item"><a href="#mortgage" class="menu__link">Ипотека</a></li>
                        <li class="menu__item"><a href="#contact" class="menu__link">Контакты</a></li>
                    </ul>
                    <a href="tel:<?php the_field("phone") ?>" class="menu__phone">
                        <span class="menu__phone-icon"><img src="<?php echo bloginfo('template_url'); ?>/assets/img/phone.png" alt="Позвонить"></span>
                        <span class="menu__phone-number phone"><?php the_field("phone") ?></span>
                    </a>
                </nav>
            </div>
            <a href="tel:<?php the_field("phone") ?>" class="footer__phone">
                <span class="footer__phone-icon"><img src="<?php echo bloginfo('template_url'); ?>/assets/img/phone.png" alt="Позвонить"></span>
                <span class="footer__phone-number phone"><?php the_field("phone") ?></span>
            </a>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>

</body>

</html>
