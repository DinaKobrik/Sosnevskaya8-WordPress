<?php /* Template Name: Debug Front Page */ ?>
<?php get_header(); ?>

<main class="main">
    <section id="promo" class="promo" aria-labelledby="promo-header">
        <div class="promo__gradient"></div>
            <div class="promo__container">
                <h1 class="promo__header"><span><?php the_field('promo__header-italic') ?></span><br><?php the_field('promo__header') ?></h1>
                <p class="promo__descr"><?php the_field('promo__descr') ?></p>
                <div class="promo__items">
                    <?php
                        $promo_posts = get_posts( array(
                            'numberposts' => -1,
                            'category_name'    => 'promo-wrapper',
                            'orderby'     => 'date',
                            'order'       => 'ASC',
                            'post_type'   => 'post',
                            'suppress_filters' => true, 
                        ) );
                        global $post;
                        foreach( $promo_posts as $post ){
                            setup_postdata( $post );
                    ?>
                        <div class="promo__item">
                            <div class="promo__item-number"><?php the_field('promo-item__number') ?></div>
                            <div class="promo__item-divider">/</div>
                            <div class="promo__item-unit"><?php the_field('promo-item__unit') ?></div>
                            <div class="promo__item-descr"><?php the_field('promo-item__descr') ?></div>
                        </div>
                    <?php
                        }
                        wp_reset_postdata();
                    ?>
                </div>
            </div>
    </section>
    <section id="advantages" class="advantages" aria-labelledby="advantages-title">
        <div class="advantages__container">
            <h2 class="advantages__title"><?php the_field('advantages__title') ?></h2>

            <div class="advantages__items">
                <?php
                    $advantages_posts = get_posts( array(
                        'numberposts' => -1,
                        'category_name'    => 'advantages-wrapper',
                        'orderby'     => 'date',
                        'order'       => 'ASC',
                        'post_type'   => 'post',
                        'suppress_filters' => true, 
                    ) );
                    global $post;
                    foreach( $advantages_posts as $post ){
                        setup_postdata( $post );
                ?>
                    <div class="advantages__item">
                        <div class="advantages__item-img">
                                <?php
                                $image = get_field('advantages-item_img');

                                if (!empty($image)): ?>
                                <img 
                                src="<?php echo $image['url']; ?>" 
                                alt="<?php echo $image['alt']; ?>">
                                <?php endif;
                                ?></div>
            
                        <div class="advantages__item-number"><?php the_field('advantages-item_number') ?></div>
                        <div class="advantages__item-descr"><?php the_field('advantages-item_descr') ?></div>
                    </div>
                <?php
                    }
                    wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>
    <section class="slider">
        <div class="slider__container">
        <div class="slider__wrapper">
            <div class="slider__items">
                <?php
                    $slider_images = [
                        get_field('slider_image_1'),
                        get_field('slider_image_2'),
                        get_field('slider_image_3'),
                        get_field('slider_image_4'),
                        get_field('slider_image_5'),
                        get_field('slider_image_6'),
                        get_field('slider_image_7'),
                        get_field('slider_image_8'),
                        get_field('slider_image_9')
                    ];

                    foreach ($slider_images as $image) {
                        if ($image && !empty($image['url'])) {
                            ?>
                            <div class="slider__item" aria-hidden="true">
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?: 'Фото слайдера'); ?>">
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <section id="select" class="select">
        <div class="select__container">
            <?php $page_id = get_the_ID();?>
            <div id="select1" class="select__wrapper select__wrapper--active">
                <h2 class="select__title"><?php the_field('select__title', $page_id); ?></h2>
                <div class="select__step">
                    <span class="select__step-number">Шаг 1 из 3</span>
                    <span class="select__step-divider-bold"></span>
                    <span class="select__step-divider"></span>
                </div>
                <div class="select__step-wrapper">
                    <div class="select__step-subheader">Выберите этаж</div>
                    <div class="select__step-floor">
                        <select name="floor" id="floor" aria-label="Выберите этаж">
                            <?php
                            $floor_posts = get_posts([
                                'numberposts'      => -1,
                                'category_name'    => 'select-step-descr-wrapper',
                                'orderby'          => 'meta_value_num',
                                'meta_key'         => 'floor_number',
                                'order'            => 'ASC',
                                'post_type'        => 'post',
                                'suppress_filters' => true,
                            ]);

                            foreach ($floor_posts as $post) {
                                setup_postdata($post);
                                $floor_number = get_field('floor_number');
                                $floor_text = get_field('floor_text');
                                ?>
                                <option value="<?php echo esc_attr($floor_number); ?>"><?php echo esc_html($floor_text); ?></option>
                                <?php
                            }
                            wp_reset_postdata();
                            ?>
                        </select>
                    </div>
                        <?php
                            global $post;
                            foreach ($floor_posts as $post) {
                                setup_postdata($post);
                                $floor_number = get_field('floor_number');
                                $available_number = get_field('available_number');
                                $available_text = get_field('available_text');
                                $sold_number = get_field('sold_number');
                                $sold_text = get_field('sold_text');
                                ?>
                                <div class="select__step-items" data-floor="<?php echo esc_attr($floor_number); ?>">
                                    <div class="select__step-item">
                                        <div class="select__step-item__number"><?php echo esc_html($available_number); ?></div>
                                        <div class="select__step-item__text"><?php echo esc_html($available_text); ?></div>
                                    </div>
                                    <div class="select__step-item">
                                        <div class="select__step-item__number"><?php echo esc_html($sold_number); ?></div>
                                        <div class="select__step-item__text"><?php echo esc_html($sold_text); ?></div>
                                    </div>
                                </div>
                                <?php
                            }
                            wp_reset_postdata();
                        ?>
                    
                </div>
                <button id="next" class="select__button select__button--active" aria-controls="select2">Продолжить</button>
                <div id="selectImg" class="select__step-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/bg_select.png" alt="ЖК 8-я Сосневская"></div>
                <div class="select__bg"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/select_bg.png" alt=""></div>
            </div>
            <div id="select2" class="select__wrapper">
                <button class="select__back" role="button" aria-label="Предыдущий слайд" aria-controls="cardWrapperX">Назад</button>
                <div class="select__title"><?php the_field('select__title', $page_id); ?></div>
                <div class="select__step select-step-layout">
                    <span class="select__step-number">Шаг 2 из 3</span>
                    <span class="select__step-divider-bold"></span>
                    <span class="select__step-divider"></span>
                </div>
                <div class="select__step-wrapper">
                    <div class="select__step-subheader">Выберите квартиру</div>
                </div>
                <div class="select__step-arrows">
                    <div id="selectArrowLeft" class="select__step-arrow select__step-arrow--active"aria-label="Предыдущий слайд" >&lt;</div>
                    <div id="selectArrowRight" class="select__step-arrow select__step-arrow--active" aria-label="Следующий слайд">&gt;</div>
                </div>
                <div class="select__card-container">
                    <div class="select__card-empty">На этом этаже все квартиры куплены</div>
                    <?php
                    $card_posts = get_posts([
                        'numberposts'      => -1,
                        'category_name'    => 'select-card-container',
                        'orderby'          => 'meta_value_num',
                        'meta_key'         => 'floor_number',
                        'order'            => 'ASC',
                        'post_type'        => 'post',
                        'suppress_filters' => true,
                    ]);

                    $cards_by_floor = [];
                    foreach ($card_posts as $post) {
                        $floor_number = get_field('floor_number', $post->ID);
                        $cards_by_floor[$floor_number][] = $post;
                    }

                    foreach ($cards_by_floor as $floor_number => $posts) {
                        $is_first = $floor_number == array_key_first($cards_by_floor);
                        ?>
                        <div id="cardWrapper<?php echo esc_attr($floor_number); ?>" class="select__card-wrapper <?php echo $is_first ? 'select__card-wrapper--active' : ''; ?>">
                            <?php
                            global $post;
                            foreach ($posts as $post) {
                                setup_postdata($post);
                                $card_area = get_field('card_area');
                                $card_rooms = get_field('card_rooms');
                                $card_image = get_field('card_image');
                                $card_description = get_field('card_description');
                                $card_button_text = get_field('card_button_text');
                                $card_button_active = get_field('card_button_active');
                                ?>
                                <div class="select__card-item">
                                    <div class="select__card-area"><?php echo esc_html($card_area); ?></div>
                                    <div class="select__card-rooms"><?php echo esc_html($card_rooms); ?></div>
                                    <div class="select__card-img">
                                        <?php if (!empty($card_image) && !empty($card_image['url'])): ?>
                                            <img src="<?php echo esc_url($card_image['url']); ?>" alt="<?php echo esc_attr($card_image['alt'] ?: 'Планировка'); ?>">
                                        <?php else: ?>
                                            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/no_layout.jpg" alt="Планировка отсутствует">
                                        <?php endif; ?>
                                    </div>
                                    <div class="select__card-descr"><?php echo esc_html($card_description); ?></div>
                                    <div class="select__card-button modal-trigger" role="button" aria-label="Открыть форму заявки">
                                        <?php echo esc_html($card_button_text); ?>
                                    </div>
                                </div>
                                <?php
                            }
                            wp_reset_postdata();
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="select__bg"></div>
            </div>
        </div>
    </section>
    <section id="infrastructure" class="infrastructure"aria-labelledby="infrastructure-title">
        <h2 class="infrastructure__title"><?php the_field('infrastructure__title') ?></h2>
        <div class="infrastructure__items">
             <?php
                $infrastructure_posts = get_posts( array(
                    'numberposts' => -1,
                    'category_name'    => 'infrastructure-wrapper',
                    'orderby'     => 'date',
                    'order'       => 'ASC',
                    'post_type'   => 'post',
                    'suppress_filters' => true, 
                ) );

                global $post;

                foreach( $infrastructure_posts as $post ){
                    setup_postdata( $post );
            ?>
                <div class="infrastructure__item">
                    <div class="infrastructure__item-img">
                            <?php
                            $image = get_field('infrastructure-item__img');

                            if (!empty($image)): ?>
                            <img 
                            src="<?php echo $image['url']; ?>" 
                            alt="<?php echo $image['alt']; ?>">
                            <?php endif;
                            ?></div>
          
                    <div class="infrastructure__item-text">
                        <div class="infrastructure__item-number"><?php the_field('infrastructure-item__number') ?></div>
                        <div class="infrastructure__item-subheader"><?php the_field('infrastructure-item__subheader') ?></div>
                        <div class="infrastructure__item-descr"><?php the_field('infrastructure-item__descr') ?></div>
                    </div>
                </div>
            <?php
                }
                wp_reset_postdata();
            ?>
        </div>
    </section>
    <section id="mortgage" class="mortgage">
        <?php $page_id = get_the_ID(); ?>
            <div class="mortgage__container">
                <h2 class="mortgage__title"><?php the_field('mortgage__title') ?></h2>
                <div class="mortgage__categories">
                    <?php
                        $unique_categories = [];
                        $mortgage_posts = get_posts(array(
                            'numberposts'      => -1,
                            'category_name'    => 'mortgage',
                            'orderby'          => 'date',
                            'order'            => 'DESC',
                            'post_type'        => 'post',
                            'suppress_filters' => true,
                        ));

                        foreach ($mortgage_posts as $post) {
                            $category = get_field('mortgage_category', $post->ID);
                            if ($category && !in_array($category, $unique_categories)) {
                                $unique_categories[] = $category;
                            }
                        }
                        foreach ($unique_categories as $category) {
                            echo '<button class="mortgage__category" data-category="' . esc_attr($category) . '">' . esc_html($category) . '</button>';
                        }
                    ?>
                </div>
                <div class="mortgage__advantages">
                    <div class="mortgage__advantage">
                        <div class="mortgage__advantage-subheader"><?php the_field('mortgage-advantage__subheader_1', $page_id); ?></div>
                        <div class="mortgage__advantage-descr"><?php the_field('mortgage-advantage__descr_1', $page_id); ?></div>
                    </div>
                    <div class="mortgage__advantage">
                        <div class="mortgage__advantage-subheader"><?php the_field('mortgage-advantage__subheader_2', $page_id); ?></div>
                        <div class="mortgage__advantage-descr"><?php the_field('mortgage-advantage__descr_2', $page_id); ?></div>
                    </div>
                </div>
            <div class="banks">
                <div class="banks__subheader"><?php the_field('banks__subheader', $page_id); ?></div>
                <div class="banks__table">
                    <?php
                    global $post;
                    foreach ($unique_categories as $category) {
                        echo '<div class="banks__category" data-category="' . esc_attr($category) . '">';
                        echo '<table class="banks__table-container">';
                        echo '<thead class="banks__table-head">';
                        echo '<tr class="banks__table-row">';
                        echo '<th class="banks__table-column">Банк</th>';
                        echo '<th class="banks__table-column">Первоначальный взнос</th>';
                        echo '<th class="banks__table-column">Срок кредитования</th>';
                        echo '<th class="banks__table-column">Процентная ставка</th>';
                        echo '<th class="banks__table-column">Ежемесячный платеж</th>';
                        echo '<th class="banks__table-column"></th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody class="banks__table-body">';

                        foreach ($mortgage_posts as $post) {
                            setup_postdata($post);
                            $post_category = get_field('mortgage_category');
                            if ($post_category === $category) {
                                $bank_name = get_field('mortgage_bank_name');
                                $initial_payment = get_field('mortgage_initial_payment');
                                $loan_term = get_field('mortgage_loan_term');
                                $interest_rate = get_field('mortgage_interest_rate');
                                $monthly_payment = get_field('mortgage_monthly_payment');
                                $bank_logo = get_field('mortgage_bank_logo');
                                ?>
                                <tr class="banks__table-row">
                                    <td class="banks__table-cell banks__name">
                                        <span class="banks__name-img">
                                            <?php if (!empty($bank_logo) && !empty($bank_logo['url'])): ?>
                                                <img src="<?php echo esc_url($bank_logo['url']); ?>" alt="<?php echo esc_attr($bank_logo['alt'] ?: 'Логотип банка'); ?>">
                                            <?php else: ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/img/no_logo.jpg" alt="Логотип отсутствует">
                                            <?php endif; ?>
                                        </span>
                                        <?php echo esc_html($bank_name); ?>
                                    </td>
                                    <td class="banks__table-cell"><?php echo esc_html($initial_payment); ?></td>
                                    <td class="banks__table-cell"><?php echo esc_html($loan_term); ?></td>
                                    <td class="banks__table-cell"><?php echo esc_html($interest_rate); ?></td>
                                    <td class="banks__table-cell"><?php echo esc_html($monthly_payment); ?></td>
                                    <td class="banks__table-cell banks__button modal-trigger" role="button" aria-label="Подать заявку на ипотеку"><?php the_field('banks__button', $page_id); ?></td>
                                </tr>
                                <?php
                            }
                        }
                        echo '</tbody>';
                        echo '</table>';
                        echo '</div>';
                    }
            wp_reset_postdata();
        ?>
                </div>
            </div>
            <div class="mortgage__bottom">
                <button class="mortgage__button mortgage__button--active modal-trigger" aria-label="Открыть форму заявки на ипотеку"><?php the_field('mortgage-button') ?></button>
                <div class="mortgage__bottom-descr"><?php the_field('mortgage-button__descr') ?></div>
            </div>
        </div>
    </section>
    <section class="location">
        <div class="location__container">
            <div class="location__grid">
                <div class="location__text">
                    <h2 class="location__title"><?php the_field('location-title') ?></h2>
                    <div class="location__descr"><?php the_field('location-title__descr') ?></div>
                </div>
                <div class="location__items">
                    <?php
                        $location_posts = get_posts( array(
                            'numberposts' => -1,
                            'category_name'    => 'location-wrapper',
                            'orderby'     => 'date',
                            'order'       => 'ASC',
                            'post_type'   => 'post',
                            'suppress_filters' => true, 
                        ) );

                        global $post;

                        foreach( $location_posts as $post ){
                            setup_postdata( $post );
                    ?>
                        <div class="location__item">
                            <div class="location__item-img">
                                    <?php
                                    $image = get_field('location-item__img');

                                    if (!empty($image)): ?>
                                    <img 
                                    src="<?php echo $image['url']; ?>" 
                                    alt="<?php echo $image['alt']; ?>">
                                    <?php endif;
                                    ?></div>
                
                            <div class="location__item-name"><?php the_field('location-item__name') ?></div>
                        </div>
                    <?php
                        }

                        wp_reset_postdata();
                    ?>
                </div>
                <div class="location__advantages">
                    <?php
                        $locationadvantages_posts = get_posts( array(
                            'numberposts' => -1,
                            'category_name'    => 'location-advantages',
                            'orderby'     => 'date',
                            'order'       => 'ASC',
                            'post_type'   => 'post',
                            'suppress_filters' => true, 
                        ) );

                        global $post;

                        foreach( $locationadvantages_posts as $post ){
                            setup_postdata( $post );
                    ?>
                        <div class="location__advantage">
                            <div class="location__advantage-number"><?php the_field('location-advantage__number') ?></div>
                            <div class="location__advantage-divider">/</div>
                            <div class="location__advantage-unit"><?php the_field('location-advantage__unit') ?></div>
                            <div class="location__advantage-descr"><?php the_field('location-advantage__descr') ?></div>
                        </div>
                    <?php
                        }

                        wp_reset_postdata();
                    ?>
                    </div>
                <div class="location__maps">
                    <iframe title="Карта местоположения" aria-label="Карта местоположения"
                        src="https://yandex.ru/map-widget/v1/?um=constructor%3A595c39b9f09c0e8a30c0547148c74c845da437d65eace9fe11b545cf4abfe5bc&amp;source=constructor"
                         frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </section>
    <section id="contact" class="contact">
        <div class="contact__container">
            <h2 class="contact__title"><?php the_field('contact__title') ?></h2>
            <div class="contact__grid">
                <div class="contact__items">
                    <?php
                    $contact_posts = get_posts(array(
                        'numberposts'      => -1,
                        'category_name'    => 'contact-wrapper',
                        'orderby'          => 'date',
                        'order'            => 'ASC',
                        'post_type'        => 'post',
                        'suppress_filters' => true,
                    ));

                    global $post;

                    foreach ($contact_posts as $post) {
                        setup_postdata($post);
                    ?>
                        <div class="contact__item">
                            <div class="contact__item-contact">
                                <span class="contact__item-link" aria-label="Связаться">
                                    <?php
                                    $image = get_field('contact__item-icon');
                                    if (!empty($image)) : ?>
                                        <img 
                                            class="contact__item-img"
                                            src="<?php echo esc_url($image['url']); ?>" 
                                            alt="<?php echo esc_attr($image['alt']); ?>">
                                    <?php endif;

                                    $contact_type = get_field('contact_type');

                                    if ($contact_type === 'phone') {
                                        $phone = get_field('contact__item-phone');
                                        if (!empty($phone)) : ?>
                                            <a href="tel:<?php echo esc_attr($phone); ?>" class="phone">
                                                <?php echo esc_html($phone); ?>
                                            </a>
                                        <?php endif;
                                    } elseif ($contact_type === 'mail') {
                                        $mail = get_field('contact__item-mail');
                                        if (!empty($mail)) : ?>
                                            <a href="mailto:<?php echo esc_attr($mail); ?>">
                                                <?php echo esc_html($mail); ?>
                                            </a>
                                        <?php endif;
                                    }
                                    ?>
                                </span>
                            </div>
                            <div class="contact__item-descr">
                                <?php the_field('contact__item-descr'); ?>
                            </div>
                        </div>
                    <?php
                    }
                    wp_reset_postdata();
                    ?>
                </div>
                <div class="contact__adress">
                    <div class="contact__adress-subheader"> <?php the_field('contact-adress__subheader'); ?></div>
                    <div class="contact__adress-descr"> <?php the_field('contact-adress__descr'); ?></div>
                </div>
                <div class="contact__links">
                    <?php
                        wp_nav_menu( [
                            'menu'            => 'Bottom menu',
                            'container'       => false,
                            'container'       => 'nav',
                            'menu_class'      => 'contact__links-wrapper',
                            'echo'            => true,
                            'fallback_cb'     => 'wp_page_menu',
                            'items_wrap'      => '<ul class="contact__links-wrapper">%3$s</ul>',
                            'depth'           => 1,
                        ] );
                    ?>
                    <button class="contact__links-button contact__links-button--active modal-trigger" aria-label="Открыть форму обратной связи">
                        <?php the_field('contact-link__button'); ?>
                    </button>
                </div>
            </div>
        </div>
    </section>
    <div class="modal" aria-hidden="true" aria-modal="true" role="dialog">
        <div class="modal__content">
            <div class="modal__close" role="button" aria-label="Закрыть модальное окно">&times;</div>
            <div class="modal__img"><img src="<?php echo bloginfo('template_url'); ?>/assets/img/bg_select.png" alt="ЖК 8-я Сосневская"></div>
            <div class="modal__text">
                <div class="modal__subheader">Оставьте заявку</div>
                <form id="form" action="#" class="modal__form">
                    <input type="name" name="name" id="name" class="modal__input" placeholder="Ваше имя" aria-required="true">
                    <input type="email" name="email" id="email" class="modal__input" placeholder="Ваш E-mail" aria-required="true">
                    <input type="phone" name="phone" id="phone" class="modal__input" placeholder="Ваш Телефон" aria-required="true">
                    <button class="modal__submit" aria-label="Отправить заявку">Оставить заявку</button>
                    <div class="modal__privat">Нажимая кнопку "Отправить заявку" вы соглашаетесь с <a
                            href="<?php echo esc_url(home_url('/privacy-policy')); ?>" target="_blank" class="modal__privat-link">политикой
                            конфиденциальности</a></div>
                </form>
            </div>
            <div class="modal__thanks">
                <div class="modal__thanks-subheader">Спасибо за заявку</div>
                <div class="modal__thanks-descr">Наш менеджер свяжется с вами в ближайшее время</div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>