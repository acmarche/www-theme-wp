<?php
global $wp_query;
if ($wp_query->post_count === 0) {
    return;
}
?>
<div class="pt-24px">
    <ul class="d-flex mx-n12px flex-wrap">
        <?php while (have_posts()) : ?>
            <?php the_post(); ?>
            <li class="pb-12px px-12px col-12 col-md-6">
                <a href="#" class="border border-default p-24px shadow-sm d-block">
                    <h3 class="fs-short-2 ff-semibold text-dark-primary text-hover-primary transition-all ellipsis">
                        <?php echo $post->post_title ?>
                    </h3>
                    <span class="d-block pt-8px fs-short-3 ellipsis text-dark-primary">
                    <?php echo $post->post_excerpt ?>
                    </span>
                </a>
            </li>
        <?php endwhile; ?>
    </ul>
    <!-- TODO JF: à brancher -->
    <a href="#"
       class="button lvl3 mt-12px align-self-ls-md-center align-self-md-center position-relative left-0 d-flex justify-content-center">Charger
        plus d'éléments<i
                class="fas fa-angle-down d-ls-md-inline pl-8px pl-md-12px fs-basic d-md-inline"></i></a>
</div>
