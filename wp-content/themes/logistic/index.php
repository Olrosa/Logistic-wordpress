<?php get_header() ?>
    <div class="custom-modal custom-modal-service" data-modal="service_1">
        <div class="custom-modal__overlay"></div>
        <div class="custom-modal__content">
            <svg class="custom-modal-order-close" data-modal="close" xmlns="http://www.w3.org/2000/svg" width="65" height="65" viewBox="0 0 65 65" fill="none">
                <path d="M43.5117 24.3609C44.3049 23.5677 44.3049 22.2816 43.5117 21.4883C42.7184 20.6951 41.4323 20.6951 40.6391 21.4883L32.5 29.6274L24.3609 21.4883C23.5676 20.6951 22.2815 20.6951 21.4883 21.4883C20.695 22.2816 20.695 23.5677 21.4883 24.3609L29.6274 32.5L21.4882 40.6391C20.695 41.4324 20.695 42.7185 21.4882 43.5117C22.2815 44.305 23.5676 44.305 24.3609 43.5117L32.5 35.3726L40.6391 43.5117C41.4323 44.305 42.7185 44.305 43.5117 43.5117C44.305 42.7185 44.305 41.4324 43.5117 40.6391L35.3726 32.5L43.5117 24.3609Z" fill="#990201"/>
            </svg>
            <div class="custom-modal-service-offer">
                <div class="custom-modal-service-top">
                    <img src="<?php the_field('other_img_2') ?>" class="custom-modal-image">
                    <div class="flex-offer-col gap-15">
                        <h2>
                        <?php the_field('other_title_2') ?>
                        </h2>
                        <div class="custom-modal-top-descr">
                        <?php the_field('other_full_descr_2') ?>    
                        </div>
                    </div>
                </div>
                <?php the_field('other_modal_2') ?>
                
                <button class="button button-300">
                    Заказать звонок
                </button>
            </div>
        </div>
    </div>

    <div class="custom-modal custom-modal-service" data-modal="service_2">
        <div class="custom-modal__overlay"></div>
        <div class="custom-modal__content">
            <svg class="custom-modal-order-close" data-modal="close" xmlns="http://www.w3.org/2000/svg" width="65" height="65" viewBox="0 0 65 65" fill="none">
                <path d="M43.5117 24.3609C44.3049 23.5677 44.3049 22.2816 43.5117 21.4883C42.7184 20.6951 41.4323 20.6951 40.6391 21.4883L32.5 29.6274L24.3609 21.4883C23.5676 20.6951 22.2815 20.6951 21.4883 21.4883C20.695 22.2816 20.695 23.5677 21.4883 24.3609L29.6274 32.5L21.4882 40.6391C20.695 41.4324 20.695 42.7185 21.4882 43.5117C22.2815 44.305 23.5676 44.305 24.3609 43.5117L32.5 35.3726L40.6391 43.5117C41.4323 44.305 42.7185 44.305 43.5117 43.5117C44.305 42.7185 44.305 41.4324 43.5117 40.6391L35.3726 32.5L43.5117 24.3609Z" fill="#990201"/>
            </svg>
            <div class="custom-modal-service-offer">
                <div class="custom-modal-service-top">
                    <img src="<?php the_field('other_img_3') ?>" class="custom-modal-image">
                    <div class="flex-offer-col gap-15">
                        <h2>
                        <?php the_field('other_title_3') ?>
                        </h2>
                        <div class="custom-modal-top-descr">
                        <?php the_field('other_full_descr_3') ?>    
                        </div>
                    </div>
                </div>
                <?php the_field('other_modal_3') ?>
                
                <button class="button button-300">
                    Заказать звонок
                </button>
            </div>
        </div>
    </div>

    <section id="hero" class="hero">
        <div class="wrapper">
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/hero_bg.png" class="hero__bg">
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/hero_mob_bg.png" class="hero__bg-mob">
            <div class="hero__content">
                <div class="flex-offer-col">
                    <h1 class="hero__title">
                        <?php the_field('hero_title') ?>
                    </h1>
                    <p class="hero__subtitle">
                        <?php the_field('hero_subtitle') ?>
                    </p>
                </div>
                <div class="hero__descr">
                    <?php the_field('hero_descr') ?>
                </div>
                <button class="button button-300 open-modal hero__button" data-modal="order">
                    Заказать звонок
                </button>
            </div>
            <?php echo do_shortcode('[contact-form-7 id="d4035cf" title="Основная форма" html_class="form hero__form form-offer"]') ?>
        </div>
    </section>
    <section class="section services">
        <div class="wrapper">
            <span class="section-theme">
                Наши услуги
            </span>
            <h2 >
                <?php the_field('services_title', 2) ?>
            </h2>

            <div class="swiper services__slider">
                <div class="swiper-wrapper">
                <?php
                    $args = array(
                    'post_type' => 'services', 
                    'posts_per_page' => -1, 
                    'order' => 'ASC',
                    'tax_query' => array(
                            array(
                            'taxonomy' => 'category', 
                            'field' => 'slug',
                            'terms' => 'services' 
                            )
                    )
                    );

                    $query = new WP_Query($args);

                    if ($query->have_posts()) {
                    while ($query->have_posts()) {
                            $query->the_post();
                    ?>
                        <div class="swiper-slide services__slide card">
                            <img src="<?php the_field('img'); ?>" alt="<?php the_title(); ?>" class="card__img">
                            <h4 class="card__title"><?php the_title(); ?></h4>
                            <p class="card__descr"><?php the_field('descr'); ?></p>
                            <button class="button button-250 open-modal" data-modal="order_old">Узнать подробнее</button>
                        </div>
                    <?php
                    }
                    }

                    wp_reset_postdata();
                ?>
                    
                </div>
                <!-- Add Scrollbar -->
                <div class="swiper-scrollbar services__scrollbar"></div>
            </div>

        </div>
    </section>
    <section class="employees">
        <div class="wrapper">
            <div class="employees__card">
                <h3 class="employees__title">
                    <?php the_field('employees_title', 2) ?>
                </h3>
                <div class="flex-offer gap-20 employees__buttons">
                    <button class="button button-300 open-modal" data-modal="order_old">
                        Рассчитать стоимость
                    </button>
                    <button class="button button-250 button-no-bg open-modal" data-modal="order">
                        Заказать звонок
                    </button>
                </div>
            </div>
        </div>
    </section>
    <section class="section other">
        <div class="wrapper">
            <span class="section-theme">
                Дополнительные услуги
            </span>
            <h3 class="fs-28 services__title">
                <?php the_field('other_title', 2) ?>
            </h3>
            <div class="other__offer complex__slider swiper">
                <div class="swiper-wrapper">
                    <div class="services__slide card swiper-slide">
                        <img src="<?php the_field('other_img_1', 2) ?>" class="card__img">
                        <h4 class="card__title">
                           <?php the_field('other_title_1', 2) ?>
                        </h4>
                        <p class="card__descr">
                        <?php the_field('other_descr_1', 2) ?>
                        </p>
                        <button class="button button-250">
                            Узнать подробнее
                        </button>
                    </div>
                    <div class="services__slide card swiper-slide">
                        <img src="<?php the_field('other_img_2', 2) ?>" class="card__img">
                        <h4 class="card__title">
                        <?php the_field('other_title_2', 2) ?>
                        </h4>
                        <p class="card__descr">
                        <?php the_field('other_descr_2', 2) ?>
                        </p>
                        <button class="button button-250 open-modal" data-modal="service_1">
                            Узнать подробнее
                        </button>
                    </div>
                    <div class="services__slide card swiper-slide">
                        <img src="<?php the_field('other_img_3', 2) ?>" class="card__img">
                        <h4 class="card__title">
                        <?php the_field('other_title_3', 2) ?>
                        </h4>
                        <p class="card__descr">
                        <?php the_field('other_descr_3', 2) ?>
                        </p>
                        <button class="button button-250 open-modal" data-modal="service_2">
                            Узнать подробнее
                        </button>
                    </div>
                </div>
                <div class="swiper-scrollbar complex__scrollbar"></div>
            </div>
        </div>
    </section>
    <section class="section advantages">
        <div class="wrapper">
            <div class="advantages__titles">
                <div class="advantages__block">
                    <p class="advantages__subtitle">
                        <?php the_field('adv_subtitle', 2) ?>
                    </p>
                    <h2 class="advantages__title">
                        <?php the_field('adv_title', 2) ?>
                    </h2>
                </div>
            </div>
            <div class="advantages__offer advantages__slider">
                <div class="advantages__slider-offer">
                    <div class="advantages__item advantages__item-empty"></div>
                    <div class="advantages__item ">
                        <span class=" advantages__item-number">
                            01
                        </span>
                        <h4 class="advantages__item-title">
                        <?php the_field('adv_title_1', 2) ?>
                        </h4>
                        <p class="advantages__descr">
                        <?php the_field('adv_descr_1', 2) ?>
                        </p>
                    </div>
                    <div class="advantages__item ">
                        <span class=" advantages__item-number">
                            02
                        </span>
                        <h4 class="advantages__item-title">
                        <?php the_field('adv_title_2', 2) ?>
                        </h4>
                        <p class="advantages__descr">
                        <?php the_field('adv_descr_2', 2) ?>
                        </p>
                    </div>
                    <div class="advantages__item">
                        <span class=" advantages__item-number">
                            03
                        </span>
                        <h4 class="advantages__item-title">
                        <?php the_field('adv_title_3', 2) ?>
                        </h4>
                        <p class="advantages__descr">
                        <?php the_field('adv_descr_3', 2) ?>
                        </p>
                    </div>
                    <div class="advantages__item ">
                        <span class=" advantages__item-number">
                            04
                        </span>
                        <h4 class="advantages__item-title">
                        <?php the_field('adv_title_4', 2) ?>
                        </h4>
                        <p class="advantages__descr">
                        <?php the_field('adv_descr_4', 2) ?>
                        </p>
                    </div>
                    <div class="advantages__item ">
                        <span class=" advantages__item-number">
                            05
                        </span>
                        <h4 class="advantages__item-title">
                        <?php the_field('adv_title_5', 2) ?>
                        </h4>
                        <p class="advantages__descr">
                        <?php the_field('adv_descr_5', 2) ?>
                        </p>
                    </div>
                    <div class="advantages__item advantages__item-empty"></div>
                    <div class="advantages__item advantages__item-medium ">
                        <span class=" advantages__item-number">
                            06
                        </span>
                        <h4 class="advantages__item-title">
                        <?php the_field('adv_title_6', 2) ?>
                        </h4>
                        <p class="advantages__descr">
                        <?php the_field('adv_descr_6', 2) ?>
                        </p>
                    </div>
                </div>
                <div class="swiper-scrollbar advantages__scrollbar"></div>
            </div>
        </div>
    </section>
    <section class="section park">
        <div class="wrapper">
            <div class="park__offer">
                <div class="park__info">
                    <h2>
                        <?php the_field('park_title') ?>
                    </h2>
                    <p class="park__descr">
                        <?php the_field('park_subtitle') ?>
                    </p>
                </div>
                <div class="park__list">
                    <?php
                        $args = array(
                        'post_type' => 'park', 
                        'posts_per_page' => -1, 
                        'order' => 'ASC',
                        'tax_query' => array(
                                array(
                                'taxonomy' => 'category', 
                                'field' => 'slug',
                                'terms' => 'park' 
                                )
                        )
                        );

                        $query = new WP_Query($args);

                        if ($query->have_posts()) {
                        while ($query->have_posts()) {
                                $query->the_post();
                        ?>
                            <div class="park__item park__mobile">
                                <div class="park__item-first">
                                    <div class="park__item-icon">
                                        <img src="<?php the_field('img') ?>" class="park__item-img">
                                    </div>
                                    <div class="flex-offer-col gap-15">
                                        <h4 class="park__title">
                                            <?php echo the_title(); ?>
                                        </h4>
                                        <div class="park__about">
                                            <p><span>Длина:</span> <?php the_field('length') ?></p>
                                            <p><span>Ширина:</span> <?php the_field('width') ?></p>
                                            <p><span>Высота:</span> <?php the_field('height') ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="park__about">
                                    <div class="flex-offer-col gap-15">
                                        <div>
                                            <p><span>Грузоподьемность:</span> <?php the_field('weight') ?></p>
                                            <p><span>Объем:</span> <?php the_field('volume') ?></p>
                                        </div>
                                        <div class="flex-offer-col gap-20">
                                            <p class="park__price"><span>Цена:</span> <?php the_field('price') ?> </p>
                                            <button class="button button-250 park__mobile-button open-modal" data-modal="order_old">Рассчитать стоимость</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="park__item">
                                <div class="park__item-icon">
                                    <img src="<?php echo get_template_directory_uri() ?>/assets/icons/gaz.png" class="park__item-img">
                                </div>
                                <div class="park__content">
                                    <h4 class="park__title">
                                        Газель
                                    </h4>
                                    <div class="park__item-offer">
                                        <div class="park__about">
                                            <div>
                                                <p><span>Длина:</span> <?php the_field('length') ?></p>
                                                <p><span>Ширина:</span> <?php the_field('width') ?></p>
                                                <p><span>Высота:</span> <?php the_field('height') ?></p>
                                            </div>
                                            <div>
                                                <p><span>Грузоподьемность:</span> <?php the_field('weight') ?></p>
                                                <p><span>Объем:</span> <?php the_field('volume') ?></p>
                                            </div>
                                        </div>
                                        <div class="flex-offer-col gap-20">
                                            <p class="park__price"><span>Цена:</span> <?php the_field('price') ?> </p>
                                            <button class="button button-250 open-modal" data-modal="order_old">Рассчитать стоимость</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        }

                        wp_reset_postdata();
                    ?>
                    
                </div>
            </div>
        </div>
    </section>
    <section class="section price">
        <div class="wrapper">
           <div class="price__title-offer">
                <div class="price__block">
                    <h2 class="price__title">
                        <?php the_field('price_title') ?>
                    </h2>
                    <div class="price__descr">
                        <?php the_field('price_subtitle') ?>
                    </div>
                </div>
           </div>
            <div class="price__offer price__slider swiper">
                <div class="swiper-wrapper">
                    <?php
                        $args = array(
                        'post_type' => 'price', 
                        'posts_per_page' => -1, 
                        'order' => 'ASC',
                        'tax_query' => array(
                                array(
                                'taxonomy' => 'category', 
                                'field' => 'slug',
                                'terms' => 'price' 
                                )
                        )
                        );

                        $query = new WP_Query($args);

                        if ($query->have_posts()) {
                        while ($query->have_posts()) {
                                $query->the_post();
                        ?>
                            <div class="swiper-slide price__item">
                                <div class="flex-offer-col gap-5">
                                    <h4 class="price__item-title">
                                        <?php echo the_title(); ?>
                                    </h4>
                                    <h5 class="price__item-price"><?php the_field('price') ?></h5>
                                </div>
                                <div class="price__item-divider"></div>
                                <div class="park__item-offer price__item-offer">
                                    <div class="park__about">
                                        <div>
                                            <p><span>Длина:</span> <?php the_field('dl') ?></p>
                                            <p><span>Ширина:</span> <?php the_field('sh') ?></p>
                                            <p><span>Высота:</span> <?php the_field('vs') ?></p>
                                        </div>
                                        <div>
                                            <p><span>Грузоподьемность:</span> <?php the_field('gr') ?></p>
                                            <p><span>Объем:</span> <?php the_field('ob') ?></p>
                                        </div>
                                    </div>
                                    <div class="flex-offer-col gap-20">
                                    
                                        <button class="button button-250 open-modal" data-modal="order_old">Рассчитать стоимость</button>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        }

                        wp_reset_postdata();
                    ?>
                    
                    
                </div>
                <div class="swiper-scrollbar price__scrollbar"></div>
            </div>
        </div>
    </section>
    <section class="section clients">
        <div class="wrapper">
            <h2>
               <?php the_field('clients_title', 2) ?>
            </h2>
            <div class="clients__slider swiper">
                <div class="swiper-wrapper">
                <?php
                        $args = array(
                        'post_type' => 'clients', 
                        'posts_per_page' => -1, 
                        'order' => 'ASC',
                        'tax_query' => array(
                                array(
                                'taxonomy' => 'category', 
                                'field' => 'slug',
                                'terms' => 'clients' 
                                )
                        )
                        );

                        $query = new WP_Query($args);

                        if ($query->have_posts()) {
                        while ($query->have_posts()) {
                                $query->the_post();
                        ?>
                            <div class="swiper-slide clients__slide">
                                <img src="<?php the_field('kartinka') ?>"class="clients__slide-img">
                            </div>
                        <?php
                        }
                        }

                        wp_reset_postdata();
                    ?>
                </div>
                <div class="swiper-scrollbar clients__scrollbar"></div>
            </div>
        </div>
    </section>
    <section class="feedback">
        <div class="wrapper">
            <div class="feedback__card">
                <h2 class="feedback__title">
                    <?php the_field('feed_title', 2) ?>
                </h2>
                <div class="flex-offer-col gap-10 mt-20">
                    <span class="feedback__time">
                    <?php the_field('feed_time', 2) ?>
                    </span>
                    <span class="feedback__descr">
                    <?php the_field('feed_subtitle', 2) ?>
                    </span>
                </div>
                <?php echo do_shortcode('[contact-form-7 id="d580d20" title="Давайте договариваться" html_class="form feedback__form"]') ?>
            </div>
        </div>
    </section>
    <section class="section blog">
        <div class="wrapper">
            <div class="flex-offer jus-con-sb al-it-cen">
                <h2>
                    <?php the_field('blog_title') ?>
                </h2>
                <span class="blog__theme">
                    Все новости
                </span>
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
    <section class="section contacts">
        <div class="wrapper">
            <h2>
                <?php the_field('cont_title', 2) ?>
            </h2>
            <div class="contacts__offer">
                <div class="contacts__block contacts__block-info">
                    <div class="contacts__contacts">
                        <div class="contacts__contact">
                            <div class="flex-offer gap-10 al-it-cen">
                                <div class="contacts__contact-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="18" viewBox="0 0 22 18" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.25 6C0.25 2.82436 2.82436 0.25 6 0.25H16C19.1756 0.25 21.75 2.82436 21.75 6V12C21.75 15.1756 19.1756 17.75 16 17.75H6C2.82436 17.75 0.25 15.1756 0.25 12V6ZM5.45586 5.58953C5.12694 5.33777 4.6562 5.40032 4.40444 5.72924C4.15268 6.05816 4.21522 6.52889 4.54414 6.78066L9.32852 10.4427C10.3149 11.1978 11.6851 11.1978 12.6715 10.4427L17.4559 6.78066C17.7848 6.52889 17.8473 6.05816 17.5956 5.72924C17.3438 5.40032 16.8731 5.33777 16.5441 5.58953L11.7598 9.25161C11.3114 9.59481 10.6886 9.59481 10.2402 9.25161L5.45586 5.58953Z" fill="#990201"/>
                                    </svg>
                                </div>
                                <span class="contacts__contact-type">
                                    Email
                                </span>
                            </div>
                            <a href="mailto:<?php the_field('cont_email', 2) ?>" class="contacts__contact-link"> <?php the_field('cont_email', 2) ?></a>
                        </div>
                        <div class="contacts__contact">
                            <div class="flex-offer gap-10 al-it-cen">
                                <div class="contacts__contact-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M17.0621 18.2183C15.1077 20.1726 10.1028 18.3363 5.88327 14.1167C1.66372 9.89718 -0.172609 4.89227 1.7817 2.93795L3.06847 1.65118C3.9568 0.762856 5.42054 0.786338 6.33784 1.70363L8.33092 3.69672C9.24822 4.61401 9.2717 6.07776 8.38337 6.96609L8.10699 7.24247C7.62737 7.72209 7.58045 8.49581 8.0261 9.03587C8.45597 9.55679 8.9194 10.0756 9.42188 10.5781C9.92435 11.0806 10.4432 11.544 10.9641 11.9739C11.5042 12.4196 12.2779 12.3726 12.7575 11.893L13.0339 11.6166C13.9222 10.7283 15.386 10.7518 16.3033 11.6691L18.2964 13.6622C19.2137 14.5795 19.2371 16.0432 18.3488 16.9315L17.0621 18.2183Z" fill="#990201" stroke="#990201" stroke-width="1.5"/>
                                </svg>
                                </div>
                                <span class="contacts__contact-type">
                                    Телефон
                                </span>
                            </div>
                            <a href="mailto:<?php the_field('cont_tel', 2) ?>" class="contacts__contact-link"><?php the_field('cont_tel', 2) ?></a>
                        </div>
                    </div>
                    <button class="button button-300 contacts__button">
                        Заказать обратный звонок
                    </button>
                </div>
                <div class="contacts__block contacts__card">
                   <img src="<?php the_field('logo', 2) ?>" class="contacts__logo">
                   <div class="contacts__card-content">
                        <div class="flex-offer-col">
                            <span class="contacts__object">
                                Адрес:
                            </span>
                            <p class="contacts__descr">
                            <?php the_field('cont_address', 2) ?>
                            </p>
                        </div>
                        <div class="flex-offer-col">
                            <span class="contacts__object">
                                Режим работы:
                            </span>
                            <p class="contacts__descr fw-600">
                            <?php the_field('cont_time', 2) ?>
                            </p>
                            <div class="flex-offer gap-10 al-it-cen mt-10">
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
                </div>
            </div>
        </div>
    </section>
    <section class="map">
        <iframe class="map__frame" src="https://yandex.ru/map-widget/v1/?um=constructor%3A90d41ec43b7ea4566d4efa71469ca61660ef42324dc23505347635bcbb864929&amp;source=constructor" width="1218" height="400" frameborder="0"></iframe>
    </section>
<?php get_footer() ?>