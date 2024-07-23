<?php
/* 
* Template Name: Show All Books
*/
get_header();
?>

<main class=" bg-gray-50  pt-24 pb-4">
    <div class="flex flex-col-reverse md:flex-row-reverse ">
        <?php if (is_active_sidebar('bitcoin-price-widget')) : ?>
            <aside id="secondary" class="w-full mt-4 md:mt-0 md:w-1/5 relative bg-gray-50 p-4 border border-gray-200 rounded-lg shadow-md">
                <?php dynamic_sidebar('bitcoin-price-widget'); ?>
            </aside>
        <?php endif; ?>

        <div class="md:w-4/5">
            <h2 class="text-center mb-5 text-3xl font-bold bg-gray-50  text-black">All Books!</h2>

            <?php
            // Get current page number
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

            // WP_Query arguments
            $args = array(
                'post_type'      => 'books',
                'posts_per_page' => 3,
                'paged'          => $paged,
            );
            $query = new WP_Query($args);

            // Check if there are posts
            if ($query->have_posts()) {
                echo '<div class="grid grid-cols-1 p-4 pt-0 sm:grid-cols-2 md:grid-cols-3 gap-6">';

                // Loop through the posts
                while ($query->have_posts()) {
                    $query->the_post();
                    $image_url = get_field('imagen')['url'];
            ?>
                    <div class="bg-white pt-4 rounded-lg overflow-hidden shadow">
                        <a target="_blank" href="<?php the_permalink(); ?>" class="no-underline hover:no-underline">
                            <p class="text-gray-800 text-center text-2xl p-5">
                                <?php echo esc_html(get_the_title()); ?>
                            </p>
                            <?php if (!$image_url) { ?>
                                <span class="text-red-800 px-6 mb-5 block">
                                    Without Image
                                </span>
                            <?php } else { ?>
                                <img class="px-6 mb-5  h-[300px] object-contain mx-auto" loading="lazy" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
                            <?php } ?>

                            <span class="text-black px-6 mb-5 block ">
                                <?php
                                echo get_field('ano_publicacion') ? 'Published on ' . get_field('ano_publicacion') : '';
                                ?>
                            </span>

                            <p class="text-gray-800 text-base px-6 mb-5">
                                <?php echo esc_html(get_field('descripcion_breve')); ?>
                            </p>


                        </a>
                        <div class="bg-white rounded-b-lg p-6 text-center">
                            <a target="_blank" href="<?php the_permalink(); ?>" class="hover:underline gradient text-white font-bold rounded-full py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                                See More
                            </a>
                        </div>
                    </div>
            <?php
                }

                echo '</div>'; // End of grid grid-cols-1 md:grid-cols-3 gap-6

                // Pagination
                $pagination_args = array(
                    'total'   => $query->max_num_pages,
                    'current' => $paged,
                    'prev_text' => __('« Prev'),
                    'next_text' => __('Next »'),
                    'before_page_number' => '<span class="page-number">',
                    'after_page_number'  => '</span>',
                );
                echo '<div class="pagination mt-6">';
                echo paginate_links($pagination_args);
                echo '</div>';
            } else {
                echo '<p>No books found.</p>';
            }

            // Reset post data
            wp_reset_postdata();
            ?>
        </div>

    </div>


</main>

<?php get_footer(); ?>