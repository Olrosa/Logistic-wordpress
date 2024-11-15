document.addEventListener("DOMContentLoaded", function () {

    // HEADER

    // Select the burger button, menu, and body
    const burger = document.querySelector('.burger');
    const menu = document.querySelector('.header__nav');
    const body = document.body; // Select the body element

    // Add a click event listener to the burger button
    burger.addEventListener('click', function () {
        // Toggle the 'active' class on the burger button and the menu
        burger.classList.toggle('active');
        menu.classList.toggle('active');

        // Toggle a class on the body to block or allow scrolling
        if (menu.classList.contains('active')) {
            body.classList.add('no-scroll');
        } else {
            body.classList.remove('no-scroll');
        }
    });

    // Close the menu when clicking outside
    document.addEventListener('click', function (event) {
        // Check if the clicked area is outside the menu and the burger button
        if (!menu.contains(event.target) && !burger.contains(event.target)) {
            // Close the menu and remove the 'no-scroll' class only if the menu is open
            if (menu.classList.contains('active')) {
                burger.classList.remove('active');
                menu.classList.remove('active');
                // Remove the no-scroll class only if the menu is closed
                body.classList.remove('no-scroll');
            }
        }
    });

    if (window.innerWidth < 768) {
        const dropdownParents = document.querySelectorAll('.dropdown-parent');
        console.log(dropdownParents); // Check if elements are being selected
    
        dropdownParents.forEach(parent => {
            parent.addEventListener('click', function(event) {
                event.stopPropagation(); // Stops the event from bubbling up
    
                const dropdown = parent.querySelector('.dropdown');
                if (dropdown) {
                    // Add a log to check if the dropdown is found
                    console.log(dropdown);
    
                    // Toggle the 'active' class
                    dropdown.classList.toggle('active');
                }
            });
        });
    
        // Close all dropdowns on click outside
        document.addEventListener('click', function() {
            dropdownParents.forEach(parent => {
                const dropdown = parent.querySelector('.dropdown');
                if (dropdown) dropdown.classList.remove('active');
            });
        });
    }
    



    // FAQ
    const offers = document.querySelectorAll('.vacansy__item-offer');

    offers.forEach(offer => {
        offer.addEventListener('click', () => {
            // Найдем родительский элемент .vacansy__item
            const item = offer.closest('.vacansy__item');
            const content = item.querySelector('.vacansy__content');
            
            // Переключаем класс 'active' для .vacansy__content
            content.classList.toggle('active');
        });
    });

    // MODALS

    // Select elements related to the modal
    const modals = document.querySelectorAll('.custom-modal');
    const openModalButtons = document.querySelectorAll('.open-modal');
    const closeButtons = document.querySelectorAll('.custom-modal__close');
    const closeModalElements = document.querySelectorAll('[data-modal="close"]'); // Добавляем элементы с data-modal="close"

    let scrollPosition = 0;

    const openModal = (modal, src = '') => {
        if (src) {
            const modalImage = modal.querySelector('.custom-modal__image');
            if (modalImage) {
                modalImage.src = src;
            }
        }
        
        // Сохраняем текущую позицию прокрутки
        scrollPosition = window.pageYOffset;
        
        // Добавляем класс для блокировки прокрутки
        document.body.classList.add("no-scroll");
        
        // Устанавливаем верхний отступ для фиксации положения страницы
        document.body.style.top = `-${scrollPosition}px`;
        
        modal.classList.add('custom-modal--active');
        console.log('Классы у body после открытия:', document.body.className);
    };

    const closeModal = (modal) => {
        modal.classList.remove('custom-modal--active');
        document.body.classList.remove('no-scroll');
        
        // Восстанавливаем прокрутку
        document.body.style.top = '';
        window.scrollTo(0, scrollPosition);

        // Очистим src изображения
        const modalImage = modal.querySelector('.custom-modal__image');
        if (modalImage) {
            modalImage.src = '';
        }
    };

    openModalButtons.forEach((button) => {
        const modalId = button.getAttribute('data-modal');
        const modal = document.querySelector(`.custom-modal[data-modal="${modalId}"]`);

        button.addEventListener('click', () => {
            if (modal) {
                const src = button.src || button.getAttribute('src'); // Получаем src изображения
                openModal(modal, src); // Передаем src в функцию открытия модалки
                
            }
        });
    });

    closeButtons.forEach((button) => {
        const modal = button.closest('.custom-modal');
        button.addEventListener('click', () => closeModal(modal));
    });

    // Добавляем обработчики для элементов с data-modal="close"
    closeModalElements.forEach((element) => {
        element.addEventListener('click', () => {
            const modal = element.closest('.custom-modal');
            if (modal) {
                closeModal(modal);
            }
        });
    });

    modals.forEach((modal) => {
        const modalContent = modal.querySelector('.custom-modal__content');
        modal.addEventListener('click', (e) => {
            if (!modalContent.contains(e.target)) {
                closeModal(modal);
            }
        });
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            modals.forEach((modal) => {
                if (modal.classList.contains('custom-modal--active')) {
                    closeModal(modal);
                }
            });
        }
    });



    // SLIDERS

    if (document.querySelector('.services__slider')) {
        const servicesSlider = new Swiper('.services__slider', {
            slidesPerView: 1.2,
            spaceBetween: 20,
            initialSlide: 0,
            scrollbar: {
                el: '.services__scrollbar', // Уникальная полоса прокрутки
                draggable: true,
            },
            mousewheel: {
                forceToAxis: true,
            },
            breakpoints: {
                320: { slidesPerView: 1.2, centeredSlides: false, initialSlide: 0 },
                576: { slidesPerView: 2.2, centeredSlides: false, initialSlide: 0 },
                1024: { slidesPerView: 3.2 },
            },
        });
    }

    if (document.querySelector('.complex__slider')) {
        const complexSlider = new Swiper('.complex__slider', {
            slidesPerView: 3,
            spaceBetween: 20,
            scrollbar: {
                el: '.complex__scrollbar', // Уникальная полоса прокрутки
                draggable: true,
            },
            mousewheel: {
                forceToAxis: true,
            },
            breakpoints: {
                320: { slidesPerView: 1.2, centeredSlides: false, initialSlide: 0 },
                576: { slidesPerView: 2.2, centeredSlides: false, initialSlide: 0 },
                1024: { slidesPerView: 3.2 },
            },
        });
    }

    if (document.querySelector('.advantages__slider')) {
        let advantagesSlider = null; // Ссылка на слайдер
        let initialized = false;
    
        function initializeSlider() {
            if (window.innerWidth < 1024) {
                if (!initialized) {
                    // Добавляем классы Swiper и инициализируем слайдер
                    document.querySelector('.advantages__slider').classList.add('swiper');
                    document.querySelector('.advantages__slider-offer').classList.add('swiper-wrapper'); // Добавляем swiper-wrapper
    
                    // Удаляем элементы с классом advantages__item-empty
                    document.querySelectorAll('.advantages__item-empty').forEach(item => item.remove());
    
                    // Добавляем класс swiper-slide ко всем остальным элементам
                    document.querySelectorAll('.advantages__item').forEach(item => {
                        item.classList.add('swiper-slide');
                    });
    
                    advantagesSlider = new Swiper('.advantages__slider', {
                        slidesPerView: 1.2,
                        spaceBetween: 20,
                        autoHeight: true,
                        centeredSlides: true,
                        scrollbar: {
                            el: '.advantages__scrollbar',
                            draggable: true,
                        },
                        mousewheel: {
                            forceToAxis: true,
                        },
                        breakpoints: {
                            320: { slidesPerView: 1.2, centeredSlides: false, initialSlide: 0 },
                            576: { slidesPerView: 2.2, centeredSlides: false, initialSlide: 0 },
                        },
                    });
                    initialized = true;
                }
            } else {
                if (initialized) {
                    // Удаляем классы Swiper и разрушаем слайдер
                    advantagesSlider.destroy();
                    advantagesSlider = null;
                    document.querySelector('.advantages__slider').classList.remove('swiper');
                    document.querySelector('.advantages__slider-offer').classList.remove('swiper-wrapper'); // Убираем swiper-wrapper
                    document.querySelectorAll('.advantages__item').forEach(item => item.classList.remove('swiper-slide'));
                    initialized = false;
                }
            }
        }
    
        // Запускаем функцию при загрузке и изменении размера окна
        window.addEventListener('load', initializeSlider);
        window.addEventListener('resize', initializeSlider);
    }
    
    

    // Инициализация второго слайдера, если элемент существует
    if (document.querySelector('.clients__slider')) {
        const clientsSlider = new Swiper('.clients__slider', {
            slidesPerView: 4,
            spaceBetween: 20,
            scrollbar: {
                el: '.clients__scrollbar', // Уникальная полоса прокрутки
                draggable: true,
            },
            mousewheel: {
                forceToAxis: true,
            },
            breakpoints: {
                320: { slidesPerView: 2.2, centeredSlides: false, initialSlide: 0 },
                576: { slidesPerView: 2.2, centeredSlides: false, initialSlide: 0 },
                1024: { slidesPerView: 4 },
            },
        });
    }

    // Инициализация второго слайдера, если элемент существует
    if (document.querySelector('.price__slider')) {
        const priceSlider = new Swiper('.price__slider', {
            slidesPerView: 2.5,
            spaceBetween: 20,
            scrollbar: {
                el: '.price__scrollbar', // Уникальная полоса прокрутки
                draggable: true,
            },
            mousewheel: {
                forceToAxis: true,
            },
            breakpoints: {
                320: { slidesPerView: 1.2, centeredSlides: false, initialSlide: 0 },
                576: { slidesPerView: 2.2, centeredSlides: false, initialSlide: 0 },
                1024: { slidesPerView: 2.5 },
            },
        });
    }

    // Инициализация второго слайдера, если элемент существует
    if (document.querySelector('.docs__slider')) {
        const docsSlider = new Swiper('.docs__slider', {
            slidesPerView: 4,
            spaceBetween: 20,
            scrollbar: {
                el: '.docs__scrollbar', // Уникальная полоса прокрутки
                draggable: true,
            },
            mousewheel: {
                forceToAxis: true,
            },
            breakpoints: {
                320: { slidesPerView: 2.2, centeredSlides: false, initialSlide: 0 },
                576: { slidesPerView: 3.2, centeredSlides: false, initialSlide: 0 },
                1024: { slidesPerView: 4 },
            },
        });
    }

    // Инициализация второго слайдера, если элемент существует
    if (document.querySelector('.letters__slider')) {
        const lettersSlider = new Swiper('.letters__slider', {
            slidesPerView: 4,
            spaceBetween: 20,
            scrollbar: {
                el: '.letters__scrollbar', // Уникальная полоса прокрутки
                draggable: true,
            },
            mousewheel: {
                forceToAxis: true,
            },
            breakpoints: {
                320: { slidesPerView: 2.2, centeredSlides: false, initialSlide: 0 },
                576: { slidesPerView: 3.2, centeredSlides: false, initialSlide: 0 },
                1024: { slidesPerView: 4 },
            },
        });
    }

    // Инициализация второго слайдера, если элемент существует
    if (document.querySelector('.live__slider')) {
        const liveSlider = new Swiper('.live__slider', {
            slidesPerView: 4,
            spaceBetween: 20,
            scrollbar: {
                el: '.live__scrollbar', // Уникальная полоса прокрутки
                draggable: true,
            },
            mousewheel: {
                forceToAxis: true,
            },
            breakpoints: {
                320: { slidesPerView: 2.2, centeredSlides: false, initialSlide: 0 },
                576: { slidesPerView: 2.2, centeredSlides: false, initialSlide: 0 },
                1024: { slidesPerView: 4 },
            },
        });
    }


});
