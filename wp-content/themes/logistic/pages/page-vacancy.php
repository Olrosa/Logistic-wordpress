<?php
/*
Template Name: Вакансии
*/
?>
<?php echo get_header() ?>

<section id="hero" class="hero partners" style="background-image: url('<?php the_field('hero_bg') ?>');">
    <div class="wrapper">
        <h1 class="white hero__title">
           <?php the_field('hero_title') ?>
        </h1>
        <p class="hero__subtitle">
           <?php the_field('hero_subtitle') ?>
            </p>
        <button class="button button-250 hero__button open-modal" data-modal="order_old">
            Рассчитать стоимость 
        </button>
    </div>
</section>
<section class="section vacansy">
    <div class="wrapper">
        <h2>
            Актуальные <span>вакансии</span>
        </h2>
        <div class="vacansy__offer">
            <?php
                $args = array(
                'post_type' => 'vacancy', 
                'posts_per_page' => -1, 
                'order' => 'ASC',
                'tax_query' => array(
                        array(
                        'taxonomy' => 'category', 
                        'field' => 'slug',
                        'terms' => 'vacancy' 
                        )
                )
                );

                $query = new WP_Query($args);

                if ($query->have_posts()) {
                while ($query->have_posts()) {
                        $query->the_post();
                ?>
                    <div class="vacansy__item">
                        <div class="vacansy__item-offer">
                            <div class="flex-offer jus-con-sb al-it-cen w-100 gap-10">
                                <h5 class="vacansy__descr">
                                <?php the_field('title') ?>
                                </h5>
                                <span class="vacansy__descr">
                                <?php the_field('salary') ?>
                                    
                                </span>
                            </div>
                            <svg class="vacansy__plus" fill="#2E2E2E" height="200px" width="200px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 455 455" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <polygon points="455,212.5 242.5,212.5 242.5,0 212.5,0 212.5,212.5 0,212.5 0,242.5 212.5,242.5 212.5,455 242.5,455 242.5,242.5 455,242.5 "></polygon> </g></svg>
                        </div>
                        <div class="vacansy__content active">
                            <span class="vacansy__divider"></span>
                            <div class="flex-offer-col gap-10 vacansy__about-offer">
                                <span class="vacansy__descr">
                                    Тип занятости
                                </span>
                                <span class="vacansy__descr vacansy__descr-400">
                                <?php the_field('type') ?>
                                </span>
                            </div>
                            <div class="flex-offer-col gap-10 vacansy__about-offer">
                                <span class="vacansy__descr">
                                
                                График работы
                                </span>
                                <span class="vacansy__descr vacansy__descr-400">
                                <?php the_field('timetable') ?>
                                    
                                </span>
                            </div>
                            <div class="flex-offer-col gap-10 vacansy__about-offer">
                                <span class="vacansy__descr">
                                    Требуемый опыт
                                </span>
                                <span class="vacansy__descr vacansy__descr-400">
                                <?php the_field('exp') ?>
                                    
                                </span>
                            </div>
                            <div class="vacansy__descr">
                            <?php the_field('main') ?>
                                
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
</section>
<section class="section docs">
    <div class="wrapper">
        <h2>
        жизнь <span>в абсолют</span>
        </h2>
        <div class="docs__offer docs__slider swiper">
            <div class="swiper-wrapper">
                <?php
                    $args = array(
                    'post_type' => 'live', 
                    'posts_per_page' => -1, 
                    'order' => 'ASC',
                    'tax_query' => array(
                            array(
                            'taxonomy' => 'category', 
                            'field' => 'slug',
                            'terms' => 'live' 
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
<section class="section blog">
    <div class="wrapper">
        <div class="flex-offer jus-con-sb al-it-cen">
            <h2>
                <?php the_field('blog_title', 2) ?>
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
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
                                    <path d="M10.9337 7.36124C15.6357 6.9525 20.3643 6.9525 25.0662 7.36124L27.3316 7.55816C28.8396 7.68925 30.1312 8.58875 30.8004 9.87542C30.8861 10.04 30.8219 10.2393 30.6641 10.337L21.2652 16.1554C19.2494 17.4032 16.7076 17.4294 14.6665 16.2233L5.20481 10.6323C5.05194 10.542 4.98177 10.356 5.05067 10.1924C5.6629 8.73803 7.03935 7.69977 8.66839 7.55816L10.9337 7.36124Z" fill="#990201"/>
                                    <path d="M5.04297 13.1501C4.80902 13.0119 4.51052 13.1607 4.48325 13.431C4.10264 17.2045 4.19476 21.0136 4.7596 24.7698C5.05737 26.75 6.67348 28.268 8.6684 28.4415L10.9337 28.6384C15.6357 29.0471 20.3643 29.0471 25.0662 28.6384L27.3316 28.4415C29.3265 28.268 30.9426 26.75 31.2404 24.7698C31.8217 20.9042 31.9023 16.9824 31.4822 13.1012C31.4528 12.829 31.1492 12.6829 30.9163 12.8271L22.4495 18.0685C19.7222 19.7568 16.2834 19.7922 13.5219 18.1604L5.04297 13.1501Z" fill="#990201"/>
                                </svg>
                            </a>
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M26.1846 28.0358L26.1856 28.0334L26.2102 27.9718L30.4585 6.55307V6.4835C30.4585 5.94984 30.2613 5.48395 29.8322 5.2045C29.4567 4.9599 29.0249 4.94248 28.7222 4.96546C28.402 4.98976 28.1001 5.06968 27.8911 5.13621C27.7835 5.17043 27.6935 5.20341 27.6292 5.22836C27.5969 5.24087 27.5707 5.2515 27.5516 5.25941L27.5329 5.26728L3.84654 14.5591L3.84002 14.5614C3.82723 14.5661 3.81031 14.5724 3.78988 14.5804C3.74914 14.5962 3.69369 14.6189 3.62856 14.6484C3.50066 14.7064 3.32395 14.7959 3.14474 14.9186C2.84036 15.127 2.26078 15.6205 2.35865 16.4028C2.43971 17.0508 2.88639 17.4623 3.18753 17.6754C3.34896 17.7896 3.50339 17.872 3.61648 17.9258C3.67378 17.9531 3.72246 17.974 3.75871 17.9888C3.77688 17.9962 3.79208 18.0021 3.80383 18.0065L3.81888 18.0122L3.82851 18.0157L7.9726 19.4109C7.95861 19.6709 7.9844 19.936 8.05335 20.1975L10.1292 28.072C10.3753 29.0056 11.22 29.656 12.1855 29.6553C13.051 29.6547 13.8186 29.1311 14.1447 28.3499L17.3856 24.8846L22.9516 29.1519L23.0308 29.1865C23.5365 29.4072 24.0089 29.4771 24.4409 29.4181C24.8723 29.3591 25.2151 29.1783 25.4726 28.9722C25.7259 28.7695 25.8996 28.5407 26.0088 28.3685C26.0643 28.281 26.1057 28.204 26.1343 28.1461C26.1487 28.1171 26.1601 28.0925 26.1686 28.0733L26.1793 28.0486L26.1831 28.0395L26.1846 28.0358ZM10.1081 19.6559C10.0609 19.4769 10.135 19.288 10.2912 19.1887L24.3474 10.2625C24.3474 10.2625 25.1741 9.76054 25.1446 10.2625C25.1446 10.2625 25.2921 10.3511 24.8491 10.7644C24.4289 11.1569 14.8309 20.4234 13.8597 21.3611C13.8037 21.4152 13.7702 21.4773 13.7505 21.5527L12.1839 27.5303L10.1081 19.6559Z" fill="#990201"/>
                                </svg>
                            </a>
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="33" viewBox="0 0 32 33" fill="none">
                                    <g clip-path="url(#clip0_184_797)">
                                        <path d="M26.8801 9.4046C23.0401 3.2996 15.2001 1.4846 9.12013 5.2796C3.20014 9.0746 1.28014 17.3246 5.12014 23.4296L5.44014 23.9246L4.16014 28.8746L8.96013 27.5546L9.44014 27.8846C11.5201 29.0396 13.7601 29.6996 16.0001 29.6996C18.4001 29.6996 20.8001 29.0396 22.8801 27.7196C28.8001 23.7596 30.5601 15.6746 26.8801 9.4046ZM23.5201 22.1096C22.8801 23.0996 22.0801 23.7596 20.9601 23.9246C20.3201 23.9246 19.5201 24.2546 16.3201 22.9346C13.6001 21.6146 11.3601 19.4696 9.76013 16.9946C8.80013 15.8396 8.32014 14.3546 8.16013 12.8696C8.16013 11.5496 8.64014 10.3946 9.44014 9.5696C9.76014 9.2396 10.0801 9.0746 10.4001 9.0746H11.2001C11.5201 9.0746 11.8401 9.0746 12.0001 9.7346C12.3201 10.5596 13.1201 12.5396 13.1201 12.7046C13.2801 12.8696 13.2801 13.1996 13.1201 13.3646C13.2801 13.6946 13.1201 14.0246 12.9601 14.1896C12.8001 14.3546 12.6401 14.6846 12.4801 14.8496C12.1601 15.0146 12.0001 15.3446 12.1601 15.6746C12.8001 16.6646 13.6001 17.6546 14.4001 18.4796C15.3601 19.3046 16.3201 19.9646 17.4401 20.4596C17.7601 20.6246 18.0801 20.6246 18.2401 20.2946C18.4001 19.9646 19.2001 19.1396 19.5201 18.8096C19.8401 18.4796 20.0001 18.4796 20.3201 18.6446L22.8801 19.9646C23.2001 20.1296 23.5201 20.2946 23.6801 20.4596C23.8401 20.9546 23.8401 21.6146 23.5201 22.1096Z" fill="#990201"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_184_797">
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
    
<?php echo get_footer() ?>