<!--CONTENT-->
<section id="content" class="pt-42px pl-ls-42px overflow-ls-hidden overflow-md-hidden pl-ls-lg-0 pt-xl-66px">

    <!--HOME_SEARCH-->
	<?php get_template_part( 'template-parts/content/home/icones-access' ); ?>

    <!--NEWS / CALENDAR-->
    <div class="bg-white pt-24px px-24px text-center position-relative d-ls-md-flex mx-ls-md-n15px d-md-flex mx-md-n15px px-xl-48px mx-xl-n30px justify-content-md-center">
        <i class="curve-svg-home"></i>

        <!--news-->
		<?php get_template_part( 'template-parts/content/home/news' ); ?>

        <!--events-->
		<?php get_template_part( 'template-parts/content/home/agenda' ); ?>

    </div>

    <!--WIDGETS-->
	<?php get_template_part( 'template-parts/content/home/widgets' ); ?>

    <!--PARTNERS-->
	<?php get_template_part( 'template-parts/content/home/partenaires' ); ?>

</section>
