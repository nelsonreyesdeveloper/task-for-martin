<?php

/* Incluir el widget */
require get_template_directory() . '/includes/widget_price_bitcoin.php';



function register_bitcoin_price_widget()
{
    register_widget('Bitcoin_Price_Widget');
}
add_action('widgets_init', 'register_bitcoin_price_widget');

// Register Custom Post Type
function custom_post_type_books()
{
    $labels = array(
        'name'                  => _x('Books', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Book', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Books', 'text_domain'),
        'name_admin_bar'        => __('Book', 'text_domain'),
        'archives'              => __('Book Archives', 'text_domain'),
        'attributes'            => __('Book Attributes', 'text_domain'),
        'parent_item_colon'     => __('Parent Book:', 'text_domain'),
        'all_items'             => __('All Books', 'text_domain'),
        'add_new_item'          => __('Add New Book', 'text_domain'),
        'add_new'               => __('Add New', 'text_domain'),
        'new_item'              => __('New Book', 'text_domain'),
        'edit_item'             => __('Edit Book', 'text_domain'),
        'update_item'           => __('Update Book', 'text_domain'),
        'view_item'             => __('View Book', 'text_domain'),
        'view_items'            => __('View Books', 'text_domain'),
        'search_items'          => __('Search Books', 'text_domain'),
        'not_found'             => __('Not found', 'text_domain'),
        'not_found_in_trash'    => __('Not found in Trash', 'text_domain'),
        'featured_image'        => __('Featured Image', 'text_domain'),
        'set_featured_image'    => __('Set featured image', 'text_domain'),
        'remove_featured_image' => __('Remove featured image', 'text_domain'),
        'use_featured_image'    => __('Use as featured image', 'text_domain'),
        'insert_into_item'      => __('Insert into book', 'text_domain'),
        'uploaded_to_this_item' => __('Uploaded to this book', 'text_domain'),
        'items_list'            => __('Books list', 'text_domain'),
        'items_list_navigation' => __('Books list navigation', 'text_domain'),
        'filter_items_list'     => __('Filter books list', 'text_domain'),
    );

    $args = array(
        'label'                 => __('Book', 'text_domain'),
        'description'           => __('Custom Post Type for Books', 'text_domain'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail'),
        'taxonomies'            => array('category', 'post_tag'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-book', // Change this line
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type('books', $args);
}
add_action('init', 'custom_post_type_books', 0);

// Register Shortcode
function display_books_shortcode($atts) {
    ob_start();
    

    // WP_Query arguments
    $args = array(
        'post_type'      => 'books',
        'posts_per_page' => 3,
    );
    $query = new WP_Query($args);
    
    // Check if there are posts
    if ($query->have_posts()) {
        echo '<div class="flex flex-wrap">';

        // Loop through the posts
        while ($query->have_posts()) {
            $query->the_post();
            $image_url = get_field('imagen')['url'];
            ?>
            <div class="w-full md:w-1/3 p-6 flex flex-col flex-grow flex-shrink">
                <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow">
                    <a target="_blank" href="<?php the_permalink(); ?>" class="flex flex-wrap no-underline hover:no-underline">
                        <p class="w-full text-gray-800 text-center text-2xl p-5 px-6">
                            <?php echo esc_html(get_the_title()); ?>
                        </p>
                        <?php if (!$image_url) { ?>
                            <span class="text-red-800 px-6 mb-5">
                                Without Image
                            </span>
                        <?php } else { ?>
                            <img class="px-6 mb-5  h-[300px] object-contain mx-auto" loading="lazy" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>"/>
                        <?php } ?>

                        <span class="text-black px-6 mb-5 ">
                            <?php 
                            echo get_field('ano_publicacion') ? 'Published on ' . get_field('ano_publicacion') : '';
                            ?>
                        </span>
                        <p class="text-gray-800 text-base px-6 mb-5">
                            <?php echo esc_html(get_field('descripcion_breve')); ?>
                        </p>
                    </a>
                </div>
                <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow p-6">
                    <div class="flex items-center justify-start">
                        <a target="_blank" href="<?php the_permalink(); ?>" class="mx-auto lg:mx-0 hover:underline gradient text-white font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                            See More
                        </a>
                    </div>
                </div>
            </div>
            <?php
        }

        echo '</div>'; // End of flex flex-wrap

      
    } else {
        echo '<p>No books found.</p>';
    }

    // Reset post data
    wp_reset_postdata();

    return ob_get_clean();
}

add_shortcode('display_books', 'display_books_shortcode');



//register sidebar
function custom_sidebar()
{
    register_sidebar(array(
        'name' => __('Bitcoin Price Widget', 'theme_text_domain'),
        'id' => 'bitcoin-price-widget',
        'description' => __('Sidebar to display Bitcoin price widget', 'theme_text_domain'),
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'custom_sidebar');


function books_tailwindcss()
{
    wp_enqueue_style('output', get_template_directory_uri() . '/dist/output.css', array());
}
add_action('wp_enqueue_scripts', 'books_tailwindcss');


function books_scripts_and_styles()
{
    wp_enqueue_style('style', get_template_directory_uri() . '/style.css', array());
    wp_enqueue_script('app', get_template_directory_uri() . '/js/app.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'books_scripts_and_styles');


/* Habilitar el menu */
function books_register_menus()
{
    register_nav_menus(
        array(
            'header-menu' => __('Header Menu'),
            'footer-menu' => __('Footer Menu'),
        )
    );
}
add_action('init', 'books_register_menus');
