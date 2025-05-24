<?php /* Template Name: Documents */ ?>
<?php get_header(); ?>
<main class="main">
     <section class="document">
        <div class="document__container">
            <h1 class="document__title"><?php the_field('document__title') ?></h>
            <div class="document__items">
                <?php
                    $documents_posts = get_posts( array(
                        'numberposts' => -1,
                        'category_name'    => 'document-wrapper',
                        'orderby'     => 'date',
                        'order'       => 'ASC',
                        'post_type'   => 'post',
                        'suppress_filters' => true, 
                    ) );

                    global $post;

                    foreach( $documents_posts as $post ){
                        setup_postdata( $post );
                ?>
                    <div class="document__item">
                        <div class="document__item-name"><?php the_field('document-item__name') ?></div>
                        <div class="document__item-date"><?php the_field('document-item__date') ?></div>
                        <?php
                            $document_pdf = get_field('document__item-download');
                            if ($document_pdf && !empty($document_pdf['url'])) {
                                $pdf_url = esc_url($document_pdf['url']);
                                $pdf_title = esc_attr($document_pdf['title'] ?: 'Документ');
                                ?>
                                <a href="<?php echo $pdf_url; ?>" download class="document__item-download">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon_download.png" alt="Скачать">
                                    Скачать
                                </a>
                                <?php
                            } else {
                                ?>
                                <span class="document__item-download document__item-download--disabled">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon_download.png" alt="Скачать">
                                    Файл отсутствует
                                </span>
                                <?php
                            }
                        ?>
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