<?php
/* 
Template Name: Página Inicio
*/

?>

<?php get_header(); ?>


<!--Hero-->
<div class="pt-24">
    <div class="container px-3 mx-auto flex flex-wrap flex-col md:flex-row items-center">
        <!--Left Col-->
        <div class="flex flex-col w-full md:w-2/5 justify-center items-start text-center md:text-left">
            <p class="uppercase tracking-loose w-full">Bitcoin and Books: Empowering Your Financial Knowledge</p>
            <h1 class="my-4 text-4xl font-bold leading-tight">
                Unlock the Future of Finance with Bitcoin.
            </h1>
            <p class="leading-normal text-sm mb-8">
                Discover the transformative power of Bitcoin through expertly curated books. Whether you're a seasoned investor or just starting out, our collection provides the insights and strategies you need to thrive in the evolving financial landscape. Expand your knowledge and secure your financial future today!
            </p>

        </div>
        <!--Right Col-->
        <div class="w-full md:w-3/5 py-6 text-center flex justify-end">
            <img class="w-full md:w-4/5 z-20" src="<?php echo get_template_directory_uri(); ?>/assets/images/main-image.svg" />
        </div>
    </div>
</div>
<div class="relative -mt-12 lg:-mt-24">
    <svg viewBox="0 0 1428 174" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g transform="translate(-2.000000, 44.000000)" fill="#FFFFFF" fill-rule="nonzero">
                <path d="M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496" opacity="0.100000001"></path>
                <path d="M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z" opacity="0.100000001"></path>
                <path d="M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z" id="Path-4" opacity="0.200000003"></path>
            </g>
            <g transform="translate(-4.000000, 76.000000)" fill="#FFFFFF" fill-rule="nonzero">
                <path d="M0.457,34.035 C57.086,53.198 98.208,65.809 123.822,71.865 C181.454,85.495 234.295,90.29 272.033,93.459 C311.355,96.759 396.635,95.801 461.025,91.663 C486.76,90.01 518.727,86.372 556.926,80.752 C595.747,74.596 622.372,70.008 636.799,66.991 C663.913,61.324 712.501,49.503 727.605,46.128 C780.47,34.317 818.839,22.532 856.324,15.904 C922.689,4.169 955.676,2.522 1011.185,0.432 C1060.705,1.477 1097.39,3.129 1121.236,5.387 C1161.703,9.219 1208.621,17.821 1235.4,22.304 C1285.855,30.748 1354.351,47.432 1440.886,72.354 L1441.191,104.352 L1.121,104.031 L0.457,34.035 Z"></path>
            </g>
        </g>
    </svg>
</div>
<main class="flex flex-col md:flex-row-reverse">

    <?php if (is_active_sidebar('bitcoin-price-widget')) : ?>
        <aside id="secondary" class="w-full md:w-1/5 relative bg-gray-50 p-4 border border-gray-200 rounded-lg shadow-md">
            <?php dynamic_sidebar('bitcoin-price-widget'); ?>
        </aside>
    <?php endif; ?>

    <div class="w-full md:w-4/5">

        <section class="bg-white border-b py-8">
            <div class="container max-w-5xl mx-auto m-8">
                <h2 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
                    About us
                </h2>
                <div class="w-full mb-4">
                    <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
                </div>

                <div class="flex flex-wrap flex-col-reverse sm:flex-row">
                    <div class="w-full sm:w-1/2 p-6 mt-6">
                        <img src="<?php echo get_template_directory_uri() . '/template-parts/World.svg'; ?>" alt="World" class="w-full h-auto">
                    </div>
                    <div class="w-full sm:w-1/2 p-6 mt-6">
                        <div class="align-middle">
                            <h3 class="text-3xl text-gray-800 font-bold leading-none mb-3">
                                Bitcoin: The currency of the future.
                            </h3>
                            <p class="text-gray-600 mb-8">
                                We are dedicated to providing you with the most insightful and comprehensive resources on Bitcoin and digital finance. Our mission is to empower you with knowledge and tools to navigate the ever-evolving world of cryptocurrency. Whether you're an experienced investor or just beginning your journey, we offer a curated selection of books and educational materials designed to enhance your understanding and help you make informed financial decisions. Join us as we explore the future of finance together.
                                <br />
                                <br />

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-white border-b py-8">
            <div class="container mx-auto flex flex-wrap pt-4 pb-12">
                <h2 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
                    Our Books!
                </h2>
                <div class="w-full mb-4">
                    <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
                </div>
                <?php echo do_shortcode('[display_books]'); ?>

            </div>
            <a href="/all-books">
                <div class="flex justify-center">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                        View All Books
                    </button>
                </div>
            </a>
        </section>


</main>

<?php get_footer(); ?>