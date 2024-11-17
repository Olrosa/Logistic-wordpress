<?php
add_action('wp_enqueue_scripts', 'logistic_scripts');

function logistic_scripts() {
    wp_enqueue_style('swiper-style', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css');
    wp_enqueue_style('logistic-style', get_stylesheet_uri());
    wp_enqueue_script('swiper-scripts', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array(), null, true);
    wp_enqueue_script('logistic-scripts', get_template_directory_uri() . '/assets/js/script.js', array(), '1.0', true);
};

add_theme_support('custom-logo');
add_theme_support('post-thumbnails');
add_theme_support('menus');

// Отключение автоматического оборачивания полей в теги <p> в Contact Form 7
add_filter('wpcf7_autop_or_not', '__return_false');

class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
    // Начало уровня (обёртка ul)
    function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown\">\n";
    }

    // Начало элемента (теги li и a)
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'header__nav-item';

        // Проверка на наличие дочерних элементов
        if (in_array('menu-item-has-children', $classes)) {
            $classes[] = 'dropdown-parent';
        }

        // Объединяем имена классов
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        // Создание элемента списка с классами
        $output .= '<li' . $class_names . '>';

        // Убедимся, что $args - это объект перед доступом к его свойствам
        $item_output = '';
        if (is_object($args)) {
            $item_output .= '<div class="flex-offer gap-5 al-it-cen no-wrap">';
            $item_output .= '<a href="' . esc_attr($item->url) . '" class="header__nav-link">';
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            $item_output .= '</a>';

            // Добавляем SVG иконку, если есть дочерние элементы
            if (in_array('menu-item-has-children', $classes)) {
                $item_output .= '
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.5303 8.96967C16.8232 9.26256 16.8232 9.73744 16.5303 10.0303L12.5303 14.0303C12.2374 14.3232 11.7626 14.3232 11.4697 14.0303L7.46967 10.0303C7.17678 9.73744 7.17678 9.26256 7.46967 8.96967C7.76256 8.67678 8.23744 8.67678 8.53033 8.96967L12 12.4393L15.4697 8.96967C15.7626 8.67678 16.2374 8.67678 16.5303 8.96967Z" fill="#2E2E2E"/>
                    </svg>';
            }

            $item_output .= '</div>';
            $item_output .= $args->after;
        } else {
            $item_output .= '<a href="' . esc_attr($item->url) . '" class="header__nav-link">';
            $item_output .= apply_filters('the_title', $item->title, $item->ID);
            $item_output .= '</a>';
        }

        // Вывод элемента
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

class Custom_Walker_Footer_Nav_Menu extends Walker_Nav_Menu {

    // Start Level (submenu)
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat( $t, $depth );
        // Добавляем класс "dropdown" для подменю
        $output .= "{$n}{$indent}<ul class=\"dropdown\">{$n}";
    }

    // End Level
    public function end_lvl( &$output, $depth = 0, $args = null ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat( $t, $depth );
        $output .= "{$indent}</ul>{$n}";
    }

    // Start Element
public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
    if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
        $t = '';
        $n = '';
    } else {
        $t = "\t";
        $n = "\n";
    }
    $indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

    $classes = empty( $item->classes ) ? [] : (array) $item->classes;
    $class_names = join( ' ', array_filter( $classes ) );

    // Add "dropdown-parent" class for items with sub-menus
    if ( in_array( 'menu-item-has-children', $classes ) ) {
        $class_names .= ' dropdown-parent';
    }

    $class_names = ' class="footer__nav-item ' . esc_attr( $class_names ) . '"';

    $output .= $indent . '<li' . $class_names . '>';

    $atts = [];
    $atts['class'] = 'footer__nav-link';
    $atts['href']  = ! empty( $item->url ) ? $item->url : '';

    $attributes = '';
    foreach ( $atts as $attr => $value ) {
        if ( ! empty( $value ) ) {
            $attributes .= ' ' . $attr . '="' . esc_attr( $value ) . '"';
        }
    }

    $item_output = $args->before;

    // Check if $args is an object and create the custom structure
    if ( is_object( $args ) ) {
        $item_output .= '<div class="flex-offer gap-5 al-it-cen no-wrap dropdown-offer">';
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';

        // Add SVG icon if the item has children
        if ( in_array( 'menu-item-has-children', $classes ) ) {
            $item_output .= '
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.5303 8.96967C16.8232 9.26256 16.8232 9.73744 16.5303 10.0303L12.5303 14.0303C12.2374 14.3232 11.7626 14.3232 11.4697 14.0303L7.46967 10.0303C7.17678 9.73744 7.17678 9.26256 7.46967 8.96967C7.76256 8.67678 8.23744 8.67678 8.53033 8.96967L12 12.4393L15.4697 8.96967C15.7626 8.67678 16.2374 8.67678 16.5303 8.96967Z" fill="white"/>
                </svg>';
        }

        $item_output .= '</div>';
    } else {
        $item_output .= '<a' . $attributes . '>';
        $item_output .= apply_filters( 'the_title', $item->title, $item->ID );
        $item_output .= '</a>';
    }

    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
}

    // End Element
    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $output .= "</li>{$n}";
    }
}


?>
