<?php
while (have_posts()) {
    the_post();

    // Get the image URL for the current post
    $image_url = get_field('imagen')['url'];

    // Display the post title
    echo "<h1 class='text-center text-black mb-5 uppercase font-bold font-h2 text-4xl'>" . get_the_title() . "</h1>";

    // Display content based on whether there is an image or not
    if (!$image_url) { ?>
        <span class="text-red-800 px-6 mb-5 block">
            Without Image
        </span>
    <?php } else { ?>
        <img class="px-6 mb-5 h-[500px] object-contain mx-auto" loading="lazy" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
    <?php }

    // Display the publication year
    ?>
    <span class="text-black px-6 mb-5 block">
        <?php
        echo get_field('ano_publicacion') ? 'Published on ' . get_field('ano_publicacion') : '';
        ?>
    </span>

    <p class="text-gray-800 text-base px-6 mb-5">
        <?php echo esc_html(get_field('descripcion_breve')); ?>
    </p>

<?php

    // Display the post content
    echo "<div class='pb-5 text-base md:text-lg'>" . apply_filters('the_content', get_the_content()) . "</div>";
}
?>