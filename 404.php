<?php
get_header();
?>
<main>
    <section class="error404">
        <div class="error404__container">
            <h1 class="error404__title">Такой страницы не существует</h1>
            <div class="error404__img"><img src="<?php echo bloginfo('template_url'); ?>/assets/img/404.png" alt="Ошибка"></div>
        </div>
    </section>
</main>
<?php
get_footer();
?>