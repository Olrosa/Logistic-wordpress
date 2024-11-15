<!DOCTYPE html>
<html lang="ru">
<head>
    <title><?php wp_title('|', true, 'right'); ?></title>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta name="robots" content="index"/>
    <meta http-equiv="content-language" content="ru"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0 ">
    <link rel="icon" type="image/x-icon" href="#">
    
    <?php 
        wp_head();
    ?>
</head>
<body>
    <!-- MODALS -->

    <div class="custom-modal custom-modal--image" data-modal="image">
        <div class="custom-modal__overlay"></div>
        <div class="custom-modal__content">
            <button class="custom-modal__close">&times;</button>
            <img src="" alt="Document" class="custom-modal__image">
        </div>
    </div>

    

    <div class="custom-modal custom-modal-order" data-modal="order_old">
        <div class="custom-modal__overlay"></div>
        <div class="custom-modal__content">
            <svg class="custom-modal-order-close" data-modal="close" xmlns="http://www.w3.org/2000/svg" width="65" height="65" viewBox="0 0 65 65" fill="none">
                <path d="M43.5117 24.3609C44.3049 23.5677 44.3049 22.2816 43.5117 21.4883C42.7184 20.6951 41.4323 20.6951 40.6391 21.4883L32.5 29.6274L24.3609 21.4883C23.5676 20.6951 22.2815 20.6951 21.4883 21.4883C20.695 22.2816 20.695 23.5677 21.4883 24.3609L29.6274 32.5L21.4882 40.6391C20.695 41.4324 20.695 42.7185 21.4882 43.5117C22.2815 44.305 23.5676 44.305 24.3609 43.5117L32.5 35.3726L40.6391 43.5117C41.4323 44.305 42.7185 44.305 43.5117 43.5117C44.305 42.7185 44.305 41.4324 43.5117 40.6391L35.3726 32.5L43.5117 24.3609Z" fill="#990201"/>
            </svg>
            <div class="custom-modal-order-offer">
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/order_img.jpeg" class="custom-modal-order-image">
                <div class="custom-modal-order-info">
                    <h3 class="custom-modal-order-title">
                        <span>Узнайте цену</span> <br>
                        на грузоперевозку!
                    </h3>
                    <p class="custom-modal-order-descr">
                        Хотите быстро получить расчет стоимости грузоперевозки?
                    </p>
                    <p class="custom-modal-order-descr">
                        Заполните форму, и наш менеджер свяжется с вами в ближайшее время!
                    </p>
                    <?php echo do_shortcode('[contact-form-7 id="915fc9f" title="Узнать цену" html_class="form custom-modal-order-form"]') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="custom-modal custom-modal-order" data-modal="order">
        <div class="custom-modal__overlay"></div>
        <div class="custom-modal__content">
            <svg class="custom-modal-order-close" data-modal="close" xmlns="http://www.w3.org/2000/svg" width="65" height="65" viewBox="0 0 65 65" fill="none">
                <path d="M43.5117 24.3609C44.3049 23.5677 44.3049 22.2816 43.5117 21.4883C42.7184 20.6951 41.4323 20.6951 40.6391 21.4883L32.5 29.6274L24.3609 21.4883C23.5676 20.6951 22.2815 20.6951 21.4883 21.4883C20.695 22.2816 20.695 23.5677 21.4883 24.3609L29.6274 32.5L21.4882 40.6391C20.695 41.4324 20.695 42.7185 21.4882 43.5117C22.2815 44.305 23.5676 44.305 24.3609 43.5117L32.5 35.3726L40.6391 43.5117C41.4323 44.305 42.7185 44.305 43.5117 43.5117C44.305 42.7185 44.305 41.4324 43.5117 40.6391L35.3726 32.5L43.5117 24.3609Z" fill="#990201"/>
            </svg>
            <div class="custom-modal-order-offer">
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/order_img.jpeg" class="custom-modal-order-image">
                <div class="custom-modal-order-info custom-modal-order-info-more-pd">
                    <h3 class="custom-modal-order-title">
                        закажите<br>
                        <span> обратный звонок</span>
                    </h3>
                    <p class="custom-modal-order-descr">
                        Заполните форму, и наш менеджер свяжется с вами в ближайшее время!
                    </p>
                    <?php echo do_shortcode('[contact-form-7 id="3bcb10c" title="Обратный звонок" html_class="form custom-modal-order-form"]') ?>
                </div>
            </div>
        </div>
    </div>

    <header class="header <?php if (get_the_ID() !== 2) echo 'service'; ?>">
        <div class="wrapper">
            <div class="header__offer">
                <a href="/" class="header__logo">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/icons/logo.png" alt="logo" class="header__logo-img">
                    <p class="header__logo-descr">
                        АБСОЛЮТ
                    </p>
                </a>
                <nav class="header__nav">
                    <div class="header__mobile-offer">
                        <div class="header__mobile-top mob">
                            <a href="/" class="header__logo header__mobile-logo">
                                <img src="<?php echo get_template_directory_uri() ?>/assets/icons/logo.png" alt="logo" class="header__logo-img">
                                <p class="header__logo-descr">
                                    Транспортная группа компаний “АБСОЛЮТ”
                                </p>
                            </a>
                        </div>
                        <ul class="header__nav-list">
                            <li class="header__nav-item">
                                <a href="#" class="header__nav-link">
                                    Главная
                                </a>
                            </li>
                            <li class="header__nav-item">
                                <a href="#" class="header__nav-link">
                                    О компании
                                </a>
                            </li>
                            <li class="header__nav-item dropdown-parent">
                                <div class="flex-offer gap-5 al-it-cen no-wrap">
                                    <a href="#" class="header__nav-link">
                                        Для грузоперевозчиков
                                    </a> 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.5303 8.96967C16.8232 9.26256 16.8232 9.73744 16.5303 10.0303L12.5303 14.0303C12.2374 14.3232 11.7626 14.3232 11.4697 14.0303L7.46967 10.0303C7.17678 9.73744 7.17678 9.26256 7.46967 8.96967C7.76256 8.67678 8.23744 8.67678 8.53033 8.96967L12 12.4393L15.4697 8.96967C15.7626 8.67678 16.2374 8.67678 16.5303 8.96967Z" fill="#2E2E2E"/>
                                    </svg>
                                </div>
                                <ul class="dropdown">
                                    <li><a href="#">Перевозка негабаритных и тяжеловесных грузов</a></li>
                                    <li><a href="#">Опасный груз</a></li>
                                    <li><a href="#">Температурный груз</a></li>
                                    <li><a href="#">Перевозка негабаритных и тяжеловесных грузов</a></li>
                                    <li><a href="#">Опасный груз</a></li>
                                    <li><a href="#">Температурный груз</a></li>
                                    <li><a href="#">Опасный груз</a></li>

                                </ul>
                                
                            </li>
                            <li class="header__nav-item dropdown-parent">
                                <div class="flex-offer gap-5 al-it-cen no-wrap">
                                    <a href="#" class="header__nav-link">
                                        Карьера
                                    </a>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.5303 8.96967C16.8232 9.26256 16.8232 9.73744 16.5303 10.0303L12.5303 14.0303C12.2374 14.3232 11.7626 14.3232 11.4697 14.0303L7.46967 10.0303C7.17678 9.73744 7.17678 9.26256 7.46967 8.96967C7.76256 8.67678 8.23744 8.67678 8.53033 8.96967L12 12.4393L15.4697 8.96967C15.7626 8.67678 16.2374 8.67678 16.5303 8.96967Z" fill="#2E2E2E"/>
                                    </svg>
                                </div>
                                
                                <ul class="dropdown">
                                    <li><a href="#">Перевозка негабаритных грузов</a></li>
                                    <li><a href="#">Опасный груз</a></li>
                                    <li><a href="#">Температурный груз</a></li>
                                </ul>
                             </li>
                            <li class="header__nav-item">
                                <a href="#" class="header__nav-link">
                                    Контакты
                                </a>
                            </li>
                        </ul>
                        <span class="header__mobile-divider mob"></span>
                        <div class="header__mobile-info  mob">
                            <div class="flex-offer-col gap-10">
                                <div class="flex-offer-col gap-5">
                                    <h5 class="header__mobile-subtitle">
                                        <span>Адрес:</span>
                                    </h5>
                                    <p class="header__mobile-descr">
                                        614087, г. Пермь, Рабочая улица, 3 этаж, 20 офис.
                                    </p>
                                </div>
                                <div class="flex-offer-col gap-5">
                                    <h5 class="header__mobile-subtitle">
                                        <span>Режим работы:</span>
                                    </h5>
                                    <p class="header__mobile-descr header__mobile-descr-bold">
                                        с 09:00 по 19:00 
                                    </p>
                                </div>
                            </div>
                            <a href="tel:" class="header__tel header__mobile-tel  mob">
                                +7 (999) 999-99-99
                            </a>
                            <div class="header__social header__mobile-social">
                                <a href="#" class="header__social-link">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="41" height="40" viewBox="0 0 41 40" fill="none">
                                        <path d="M12.4524 8.17936C17.8074 7.72521 23.1927 7.72521 28.5477 8.17936L31.1277 8.39816C32.8452 8.54382 34.3162 9.54326 35.0784 10.9729C35.1759 11.1558 35.1028 11.3772 34.9231 11.4857L24.2188 17.9506C21.923 19.3371 19.0282 19.3662 16.7036 18.0261L5.92776 11.8139C5.75367 11.7135 5.67375 11.5069 5.75221 11.3251C6.44948 9.70913 8.0171 8.5555 9.87241 8.39816L12.4524 8.17936Z" fill="#990201"/>
                                        <path d="M5.74345 14.6115C5.47701 14.4579 5.13704 14.6232 5.10599 14.9236C4.67252 19.1163 4.77743 23.3487 5.42072 27.5222C5.75985 29.7224 7.60042 31.4091 9.87241 31.6018L12.4524 31.8206C17.8074 32.2748 23.1927 32.2748 28.5477 31.8206L31.1277 31.6018C33.3997 31.4091 35.2403 29.7224 35.5794 27.5222C36.2414 23.2271 36.3332 18.8696 35.8548 14.5571C35.8213 14.2546 35.4755 14.0923 35.2103 14.2525L25.5676 20.0763C22.4615 21.9522 18.545 21.9915 15.4 20.1784L5.74345 14.6115Z" fill="#990201"/>
                                    </svg>
                                </a>
                                <a href="#" class="header__social-link">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 38 38" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M29.2648 31.3342L29.2659 31.3315L29.2935 31.2627L34.0415 7.32413V7.24637C34.0415 6.64993 33.8212 6.12923 33.3416 5.81691C32.9219 5.54353 32.4393 5.52406 32.1009 5.54974C31.7431 5.5769 31.4056 5.66622 31.172 5.74058C31.0519 5.77883 30.9513 5.81569 30.8794 5.84357C30.8433 5.85756 30.814 5.86943 30.7927 5.87828L30.7718 5.88707L4.29876 16.2721L4.29147 16.2747C4.27717 16.2799 4.25827 16.2869 4.23543 16.2958C4.1899 16.3135 4.12793 16.3389 4.05513 16.3719C3.91218 16.4367 3.71468 16.5367 3.51439 16.6738C3.17421 16.9068 2.52644 17.4583 2.63582 18.3326C2.72642 19.0569 3.22565 19.5168 3.56222 19.755C3.74264 19.8826 3.91524 19.9747 4.04164 20.0349C4.10568 20.0653 4.16008 20.0887 4.20059 20.1052C4.2209 20.1135 4.23789 20.1201 4.25103 20.1251L4.26785 20.1313L4.2786 20.1353L8.91024 21.6946C8.8946 21.9852 8.92343 22.2815 9.00049 22.5738L11.3205 31.3747C11.5956 32.4182 12.5396 33.145 13.6188 33.1443C14.5861 33.1436 15.444 32.5584 15.8084 31.6853L19.4306 27.8123L25.6515 32.5817L25.7399 32.6203C26.3051 32.8669 26.8332 32.9451 27.316 32.8791C27.7981 32.8133 28.1812 32.6111 28.469 32.3809C28.7522 32.1543 28.9463 31.8986 29.0684 31.706C29.1304 31.6082 29.1766 31.5223 29.2087 31.4576C29.2248 31.4251 29.2375 31.3976 29.247 31.3761L29.2589 31.3486L29.2631 31.3384L29.2648 31.3342ZM11.297 21.9684C11.2442 21.7684 11.327 21.5572 11.5016 21.4464L27.2115 11.4699C27.2115 11.4699 28.1355 10.9089 28.1025 11.4699C28.1025 11.4699 28.2674 11.569 27.7722 12.0309C27.3026 12.4696 16.5754 22.8263 15.49 23.8742C15.4273 23.9347 15.3899 24.0041 15.3678 24.0884L13.617 30.7692L11.297 21.9684Z" fill="#990201"/>
                                    </svg>  
                                </a>
                                <a href="#" class="header__social-link">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="37" viewBox="0 0 36 37" fill="none">
                                        <g clip-path="url(#clip0_184_417)">
                                          <path d="M30.2401 10.545C25.9201 3.7 17.1001 1.665 10.2601 5.92C3.60009 10.175 1.44009 19.425 5.76009 26.27L6.12009 26.825L4.68009 32.375L10.0801 30.895L10.6201 31.265C12.9601 32.56 15.4801 33.3 18.0001 33.3C20.7001 33.3 23.4001 32.56 25.7401 31.08C32.4001 26.64 34.3801 17.575 30.2401 10.545ZM26.4601 24.79C25.7401 25.9 24.8401 26.64 23.5801 26.825C22.8601 26.825 21.9601 27.195 18.3601 25.715C15.3001 24.235 12.7801 21.83 10.9801 19.055C9.90009 17.76 9.36009 16.095 9.18009 14.43C9.18009 12.95 9.72009 11.655 10.6201 10.73C10.9801 10.36 11.3401 10.175 11.7001 10.175H12.6001C12.9601 10.175 13.3201 10.175 13.5001 10.915C13.8601 11.84 14.7601 14.06 14.7601 14.245C14.9401 14.43 14.9401 14.8 14.7601 14.985C14.9401 15.355 14.7601 15.725 14.5801 15.91C14.4001 16.095 14.2201 16.465 14.0401 16.65C13.6801 16.835 13.5001 17.205 13.6801 17.575C14.4001 18.685 15.3001 19.795 16.2001 20.72C17.2801 21.645 18.3601 22.385 19.6201 22.94C19.9801 23.125 20.3401 23.125 20.5201 22.755C20.7001 22.385 21.6001 21.46 21.9601 21.09C22.3201 20.72 22.5001 20.72 22.8601 20.905L25.7401 22.385C26.1001 22.57 26.4601 22.755 26.6401 22.94C26.8201 23.495 26.8201 24.235 26.4601 24.79Z" fill="#990201"/>
                                        </g>
                                        <defs>
                                          <clipPath id="clip0_184_417">
                                            <rect width="36" height="37" fill="white"/>
                                          </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                            </div>
                            
                        </div>
                    </div>
                </nav>
                <div class="header__social">
                    <a href="#" class="header__social-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="41" height="40" viewBox="0 0 41 40" fill="none">
                            <path d="M12.4524 8.17936C17.8074 7.72521 23.1927 7.72521 28.5477 8.17936L31.1277 8.39816C32.8452 8.54382 34.3162 9.54326 35.0784 10.9729C35.1759 11.1558 35.1028 11.3772 34.9231 11.4857L24.2188 17.9506C21.923 19.3371 19.0282 19.3662 16.7036 18.0261L5.92776 11.8139C5.75367 11.7135 5.67375 11.5069 5.75221 11.3251C6.44948 9.70913 8.0171 8.5555 9.87241 8.39816L12.4524 8.17936Z" fill="#990201"/>
                            <path d="M5.74345 14.6115C5.47701 14.4579 5.13704 14.6232 5.10599 14.9236C4.67252 19.1163 4.77743 23.3487 5.42072 27.5222C5.75985 29.7224 7.60042 31.4091 9.87241 31.6018L12.4524 31.8206C17.8074 32.2748 23.1927 32.2748 28.5477 31.8206L31.1277 31.6018C33.3997 31.4091 35.2403 29.7224 35.5794 27.5222C36.2414 23.2271 36.3332 18.8696 35.8548 14.5571C35.8213 14.2546 35.4755 14.0923 35.2103 14.2525L25.5676 20.0763C22.4615 21.9522 18.545 21.9915 15.4 20.1784L5.74345 14.6115Z" fill="#990201"/>
                        </svg>
                    </a>
                    <a href="#" class="header__social-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 38 38" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M29.2648 31.3342L29.2659 31.3315L29.2935 31.2627L34.0415 7.32413V7.24637C34.0415 6.64993 33.8212 6.12923 33.3416 5.81691C32.9219 5.54353 32.4393 5.52406 32.1009 5.54974C31.7431 5.5769 31.4056 5.66622 31.172 5.74058C31.0519 5.77883 30.9513 5.81569 30.8794 5.84357C30.8433 5.85756 30.814 5.86943 30.7927 5.87828L30.7718 5.88707L4.29876 16.2721L4.29147 16.2747C4.27717 16.2799 4.25827 16.2869 4.23543 16.2958C4.1899 16.3135 4.12793 16.3389 4.05513 16.3719C3.91218 16.4367 3.71468 16.5367 3.51439 16.6738C3.17421 16.9068 2.52644 17.4583 2.63582 18.3326C2.72642 19.0569 3.22565 19.5168 3.56222 19.755C3.74264 19.8826 3.91524 19.9747 4.04164 20.0349C4.10568 20.0653 4.16008 20.0887 4.20059 20.1052C4.2209 20.1135 4.23789 20.1201 4.25103 20.1251L4.26785 20.1313L4.2786 20.1353L8.91024 21.6946C8.8946 21.9852 8.92343 22.2815 9.00049 22.5738L11.3205 31.3747C11.5956 32.4182 12.5396 33.145 13.6188 33.1443C14.5861 33.1436 15.444 32.5584 15.8084 31.6853L19.4306 27.8123L25.6515 32.5817L25.7399 32.6203C26.3051 32.8669 26.8332 32.9451 27.316 32.8791C27.7981 32.8133 28.1812 32.6111 28.469 32.3809C28.7522 32.1543 28.9463 31.8986 29.0684 31.706C29.1304 31.6082 29.1766 31.5223 29.2087 31.4576C29.2248 31.4251 29.2375 31.3976 29.247 31.3761L29.2589 31.3486L29.2631 31.3384L29.2648 31.3342ZM11.297 21.9684C11.2442 21.7684 11.327 21.5572 11.5016 21.4464L27.2115 11.4699C27.2115 11.4699 28.1355 10.9089 28.1025 11.4699C28.1025 11.4699 28.2674 11.569 27.7722 12.0309C27.3026 12.4696 16.5754 22.8263 15.49 23.8742C15.4273 23.9347 15.3899 24.0041 15.3678 24.0884L13.617 30.7692L11.297 21.9684Z" fill="#990201"/>
                        </svg>  
                    </a>
                    <a href="#" class="header__social-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="37" viewBox="0 0 36 37" fill="none">
                            <g clip-path="url(#clip0_184_417)">
                              <path d="M30.2401 10.545C25.9201 3.7 17.1001 1.665 10.2601 5.92C3.60009 10.175 1.44009 19.425 5.76009 26.27L6.12009 26.825L4.68009 32.375L10.0801 30.895L10.6201 31.265C12.9601 32.56 15.4801 33.3 18.0001 33.3C20.7001 33.3 23.4001 32.56 25.7401 31.08C32.4001 26.64 34.3801 17.575 30.2401 10.545ZM26.4601 24.79C25.7401 25.9 24.8401 26.64 23.5801 26.825C22.8601 26.825 21.9601 27.195 18.3601 25.715C15.3001 24.235 12.7801 21.83 10.9801 19.055C9.90009 17.76 9.36009 16.095 9.18009 14.43C9.18009 12.95 9.72009 11.655 10.6201 10.73C10.9801 10.36 11.3401 10.175 11.7001 10.175H12.6001C12.9601 10.175 13.3201 10.175 13.5001 10.915C13.8601 11.84 14.7601 14.06 14.7601 14.245C14.9401 14.43 14.9401 14.8 14.7601 14.985C14.9401 15.355 14.7601 15.725 14.5801 15.91C14.4001 16.095 14.2201 16.465 14.0401 16.65C13.6801 16.835 13.5001 17.205 13.6801 17.575C14.4001 18.685 15.3001 19.795 16.2001 20.72C17.2801 21.645 18.3601 22.385 19.6201 22.94C19.9801 23.125 20.3401 23.125 20.5201 22.755C20.7001 22.385 21.6001 21.46 21.9601 21.09C22.3201 20.72 22.5001 20.72 22.8601 20.905L25.7401 22.385C26.1001 22.57 26.4601 22.755 26.6401 22.94C26.8201 23.495 26.8201 24.235 26.4601 24.79Z" fill="#990201"/>
                            </g>
                            <defs>
                              <clipPath id="clip0_184_417">
                                <rect width="36" height="37" fill="white"/>
                              </clipPath>
                            </defs>
                        </svg>
                    </a>
                </div>
                <div class="search">
                   
                    <a href="tel:" class="header__tel">
                        +7 (999) 999-99-99
                    </a>
                    <div class="burger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
                
            </div>
        </div>
    </header>