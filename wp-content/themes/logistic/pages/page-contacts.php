<?php
/*
Template Name: Контакты
*/
?>
<?php echo get_header() ?>
<section class="section-first conts">
        <div class="wrapper">
            <div class="conts__offer">
                <div class="conts__block">
                    <h1 class="conts__title">
                        контакты
                    </h1>
                    <div class="conts__info">
                        <div class="flex-offer-col gap-15">
                            <a href="mailto:<?php the_field('cont_email', 2) ?>" class="conts__link"><?php the_field('cont_email', 2) ?></a>
                            <a href="tel:<?php the_field('cont_tel', 2) ?>" class="conts__link"><?php the_field('cont_tel', 2) ?></a>
                        </div>
                        <div class="flex-offer-col gap-5">
                            <h4 class="conts__subtitle">
                                Адрес:
                            </h4>
                            <p class="conts__descr">
                                <?php the_field('cont_address', 2) ?>
                            </p>
                        </div>
                        <div class="flex-offer-col gap-5">
                            <h4 class="conts__subtitle">
                                Режим работы::
                            </h4>
                            <p class="conts__descr conts__descr-600">
                            <?php the_field('cont_time', 2) ?>
                            </p>
                        </div>
                    </div>
                    <div class="conts__buttons">
                        <button class="button button-250 open-modal" data-modal="order">
                            Рассчитать стоимость
                        </button>
                        <div class="conts__social">
                            <a href="mailto:<?php the_field('email') ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
                                    <path d="M10.9342 7.36142C15.6362 6.95269 20.3647 6.95269 25.0667 7.36142L27.3321 7.55834C28.8401 7.68943 30.1317 8.58894 30.8009 9.8756C30.8866 10.0402 30.8224 10.2395 30.6646 10.3372L21.2657 16.1555C19.2499 17.4034 16.7081 17.4296 14.667 16.2235L5.20529 10.6325C5.05243 10.5422 4.98226 10.3562 5.05115 10.1926C5.66339 8.73822 7.03983 7.69995 8.66888 7.55834L10.9342 7.36142Z" fill="#990201"/>
                                    <path d="M5.04345 13.1503C4.80951 13.0121 4.511 13.1608 4.48373 13.4312C4.10313 17.2047 4.19525 21.0138 4.76008 24.77C5.05785 26.7502 6.67397 28.2682 8.66888 28.4416L10.9342 28.6386C15.6362 29.0473 20.3648 29.0473 25.0667 28.6386L27.3321 28.4416C29.327 28.2682 30.9431 26.7502 31.2409 24.77C31.8222 20.9044 31.9028 16.9826 31.4827 13.1014C31.4533 12.8291 31.1497 12.6831 30.9168 12.8273L22.45 18.0686C19.7227 19.757 16.2839 19.7924 13.5224 18.1606L5.04345 13.1503Z" fill="#990201"/>
                                </svg>
                            </a>
                            <a href="<?php the_field('tg') ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M26.1846 28.0359L26.1856 28.0335L26.2102 27.9719L30.4585 6.55317V6.48361C30.4585 5.94994 30.2613 5.48406 29.8322 5.20461C29.4567 4.96 29.0249 4.94258 28.7222 4.96556C28.402 4.98987 28.1001 5.06979 27.8911 5.13632C27.7835 5.17054 27.6935 5.20352 27.6292 5.22846C27.5969 5.24098 27.5707 5.2516 27.5516 5.25952L27.5329 5.26739L3.84654 14.5592L3.84002 14.5616C3.82723 14.5662 3.81031 14.5725 3.78988 14.5805C3.74914 14.5963 3.69369 14.619 3.62856 14.6485C3.50066 14.7065 3.32395 14.796 3.14474 14.9187C2.84036 15.1271 2.26078 15.6206 2.35865 16.4029C2.43971 17.0509 2.88639 17.4624 3.18753 17.6755C3.34896 17.7897 3.50339 17.8721 3.61648 17.9259C3.67378 17.9532 3.72246 17.9741 3.75871 17.9889C3.77688 17.9963 3.79208 18.0022 3.80383 18.0066L3.81888 18.0123L3.82851 18.0158L7.9726 19.411C7.95861 19.671 7.9844 19.9361 8.05335 20.1977L10.1292 28.0721C10.3753 29.0057 11.22 29.6561 12.1855 29.6554C13.051 29.6548 13.8186 29.1312 14.1447 28.35L17.3856 24.8847L22.9516 29.1521L23.0308 29.1866C23.5365 29.4073 24.0089 29.4772 24.4409 29.4182C24.8723 29.3592 25.2151 29.1784 25.4726 28.9724C25.7259 28.7696 25.8996 28.5408 26.0088 28.3686C26.0643 28.2811 26.1057 28.2042 26.1343 28.1463C26.1487 28.1172 26.1601 28.0926 26.1686 28.0734L26.1793 28.0487L26.1831 28.0396L26.1846 28.0359ZM10.1081 19.656C10.0609 19.477 10.135 19.2881 10.2912 19.1889L24.3474 10.2626C24.3474 10.2626 25.1741 9.76065 25.1446 10.2626C25.1446 10.2626 25.2921 10.3512 24.8491 10.7645C24.4289 11.157 14.8309 20.4235 13.8597 21.3612C13.8037 21.4153 13.7702 21.4774 13.7505 21.5528L12.1839 27.5304L10.1081 19.656Z" fill="#990201"/>
                                </svg>
                            </a>
                            <a href="<?php the_field('wt') ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="33" viewBox="0 0 32 33" fill="none">
                                    <g clip-path="url(#clip0_218_3285)">
                                      <path d="M26.8796 9.405C23.0396 3.3 15.1996 1.485 9.11965 5.28C3.19965 9.075 1.27965 17.325 5.11965 23.43L5.43965 23.925L4.15965 28.875L8.95965 27.555L9.43965 27.885C11.5196 29.04 13.7596 29.7 15.9996 29.7C18.3996 29.7 20.7996 29.04 22.8796 27.72C28.7996 23.76 30.5596 15.675 26.8796 9.405ZM23.5196 22.11C22.8796 23.1 22.0796 23.76 20.9596 23.925C20.3196 23.925 19.5196 24.255 16.3196 22.935C13.5996 21.615 11.3596 19.47 9.75965 16.995C8.79965 15.84 8.31965 14.355 8.15965 12.87C8.15965 11.55 8.63965 10.395 9.43965 9.57C9.75965 9.24 10.0796 9.075 10.3996 9.075H11.1996C11.5196 9.075 11.8396 9.075 11.9996 9.735C12.3196 10.56 13.1196 12.54 13.1196 12.705C13.2796 12.87 13.2796 13.2 13.1196 13.365C13.2796 13.695 13.1196 14.025 12.9596 14.19C12.7996 14.355 12.6396 14.685 12.4796 14.85C12.1596 15.015 11.9996 15.345 12.1596 15.675C12.7996 16.665 13.5996 17.655 14.3996 18.48C15.3596 19.305 16.3196 19.965 17.4396 20.46C17.7596 20.625 18.0796 20.625 18.2396 20.295C18.3996 19.965 19.1996 19.14 19.5196 18.81C19.8396 18.48 19.9996 18.48 20.3196 18.645L22.8796 19.965C23.1996 20.13 23.5196 20.295 23.6796 20.46C23.8396 20.955 23.8396 21.615 23.5196 22.11Z" fill="#990201"/>
                                    </g>
                                    <defs>
                                      <clipPath id="clip0_218_3285">
                                        <rect width="32" height="33" fill="white"/>
                                      </clipPath>
                                    </defs>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="conts__block conts__block-map">
                    <iframe class="conts__frame" src="https://yandex.ru/map-widget/v1/?um=constructor%3A90d41ec43b7ea4566d4efa71469ca61660ef42324dc23505347635bcbb864929&amp;source=constructor" width="1218" height="400" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </section>
    <section class="section docs">
        <div class="wrapper">
            <h2>
                <?php the_field('docs_title', 149) ?>
            </h2>
            <div class="docs__offer docs__slider swiper">
                <div class="swiper-wrapper">
                    <?php
                        $args = array(
                        'post_type' => 'docs', 
                        'posts_per_page' => -1, 
                        'order' => 'ASC',
                        'tax_query' => array(
                                array(
                                'taxonomy' => 'category', 
                                'field' => 'slug',
                                'terms' => 'docs' 
                                )
                        )
                        );

                        $query = new WP_Query($args);

                        if ($query->have_posts()) {
                        while ($query->have_posts()) {
                                $query->the_post();
                        ?>
                            <img src="<?php the_field('kartinka') ?>" class="docs__item swiper-slide open-modal" data-modal="image">
                        <?php
                        }
                        }

                        wp_reset_postdata();
                    ?>
                </div>
                <div class="swiper-scrollbar docs__scrollbar"></div>
            </div>
        </div>  
    </section>
    <section class="section blog">
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
                'posts_per_page' => 2, // Количество записей, которое вы хотите вывести
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