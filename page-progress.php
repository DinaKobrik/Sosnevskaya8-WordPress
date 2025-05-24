<?php /* Template Name: Progress */ ?>
<?php get_header(); ?>

<main class="main">
    <section class="progress">
        <div class="progress__container">
            <h1 class="progress__title"><?php the_field('progress__title') ?></h1>
            <div class="progress__years">
                <?php
                $unique_years = [];
                $progress_posts = get_posts(array(
                    'numberposts'      => -1,
                    'category_name'    => 'progress',
                    'orderby'          => 'date',
                    'order'            => 'DESC',
                    'post_type'        => 'post',
                    'suppress_filters' => true,
                ));

                foreach ($progress_posts as $post) {
                    $year = get_field('progress_year', $post->ID);
                    if ($year && !in_array($year, $unique_years)) {
                        $unique_years[] = $year;
                    }
                }

                rsort($unique_years);

                foreach ($unique_years as $year) {
                    echo '<button class="progress__year" data-year="' . esc_attr($year) . '">' . esc_html($year) . '</button>';
                }
                ?>
            </div>
            <div class="progress__items">
                <?php
                global $post;
                foreach ($progress_posts as $post) {
                    setup_postdata($post);
                    $year = get_field('progress_year');
                    $month = get_field('progress_month');
                    $subheader = get_field('progress_subheader');
                    $description = get_field('progress_description');
                    $images = get_field('progress_images');
                ?>
                    <div class="progress__item" data-year="<?php echo esc_attr($year); ?>">
                        <div class="progress__item-month"><?php echo esc_html($month); ?></div>
                        <div class="progress__item-text">
                            <div class="progress__item-subheader"><?php echo esc_html($subheader); ?></div>
                            <div class="progress__item-descr"><?php echo esc_html($description); ?></div>
                        </div>
                        <div class="progress__item-images">
                             <?php
                        $image_fields = [
                            get_field('progress_image_1'),
                            get_field('progress_image_2'),
                            get_field('progress_image_3'),
                            get_field('progress_image_4')
                        ];

                        for ($i = 0; $i < 4; $i++) {
                            if (!empty($image_fields[$i]) && !empty($image_fields[$i]['url'])) {
                                echo '<div class="progress__item-img"><img src="' . esc_url($image_fields[$i]['url']) . '" alt="' . esc_attr($image_fields[$i]['alt'] ?: 'Фото прогресса') . '"></div>';
                            } else {
                                echo '<div class="progress__item-img"><img src="' . get_template_directory_uri() . '/assets/img/no_photo.jpg" alt="Фото пока нет"></div>';
                            }
                        }
                        ?>
                        </div>
                    </div>
                <?php
                }
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>