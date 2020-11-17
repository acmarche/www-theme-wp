<!--OBJECT | HEADER-->
<header>
    <div>
        <a href="#">
            <img src="<?php echo get_template_directory_uri() ?>/assets/rsc/img/img_logo.png" alt="logo">
        </a>

        <!--OBJECT | NAV-->
        <nav>
            <!--home-->
            <div class="home active">
                <a href="#">
                    <i class="icon_nav i-home"></i>
                </a>
            </div>
            <!--search | visible on mobile/tablet && !homepage-extralarge-->
			<?php
			get_template_part( 'template-parts/header/search' );
			?>
            <!--all-->
			<?php
			get_template_part( 'template-parts/header/menu-top' );
			?>
            <?php
			get_template_part( 'template-parts/header/menu-raccourcis' );
			?>
        </nav>

		<?php get_template_part( 'template-parts/header/social' ); ?>
    </div>
</header>
