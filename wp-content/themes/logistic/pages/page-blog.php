<?php
/*
Template Name: Блог
*/
?>
<?php echo get_header() ?>
    <section class="section-first blog">
        <div class="wrapper">
            <div class="flex-offer jus-con-sb al-it-cen">
                <h2>
                    <?php the_field('blog_title', 2) ?>
                </h2>
            </div>
            <div class="blog__offer">
            <?php
            // Параметры для WP_Query
            $args = array(
                'post_type' => 'post', // Обычные записи (блог)
                'category_name' => 'blog', // Слаг категории "blog"
                'posts_per_page' => -1, // Количество записей, которое вы хотите вывести
                'order' => 'DESC', // Порядок сортировки записей
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    ?>
                    <article class="blog__card">
                        <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" class="blog__img">
                        <span class="blog__date">
                            <?php echo get_the_date('d.m.Y'); ?>г.
                        </span>
                        <p class="blog__descr">
                            <?php the_field('descr') ?>
                        </p>
                        <a href="<?php the_permalink(); ?>" class="button button-250">
                            Читать подробнее
                        </a>
                    </article>
                    <?php
                }
            }

            wp_reset_postdata();
            ?>

            </div>
        </div>
    </section>
    
<?php echo get_footer() ?>