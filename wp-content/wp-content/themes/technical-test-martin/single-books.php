<?php
/* 
* Template Name: Show All Books
*/
get_header();
?>

<main class="flex flex-col-reverse md:flex-row-reverse pt-24 pb-4 bg-gray-50">

    <?php if (is_active_sidebar('bitcoin-price-widget')) : ?>
        <aside id="secondary" class="w-full mt-4 md:mt-0 md:w-1/5 relative bg-gray-50 p-4 border border-gray-200 rounded-lg shadow-md">
            <?php dynamic_sidebar('bitcoin-price-widget'); ?>
        </aside>
    <?php endif; ?>


    <div class="w-full md:w-2/5 mx-auto">
        <?php get_template_part('template-parts/sigle-book'); ?>
    </div>

</main>

<?php get_footer(); ?>