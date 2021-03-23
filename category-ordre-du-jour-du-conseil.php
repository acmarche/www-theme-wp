<?php
/**
 * The template for displaying pvs
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

use AcMarche\Conseil\ConseilDb;

get_header();
?>

<!-- PAGE -->
<section id="page"><br/>
    <?php include_once 'social_category.php'; ?>

    <div class="clearBoth"></div>
    <br/>

    <?php
    $category_description = category_description();
    if (!empty($category_description)) {
        echo apply_filters(
            'category_archive_meta',
            '<div class="category-archive-meta">'.$category_description.'</div>'
        );
    }
    ?>

    <?php if (have_posts()) : ?>

        <?php /* Start the Loop */ ?>
        <?php while (have_posts()) : the_post(); ?>


            <?php
            get_template_part('content', get_post_format());
            ?>

        <?php endwhile;

    endif;

    $conseilDb = new ConseilDb();
    $ordres = $conseilDb->getAllOrdre();

    foreach ($ordres as $ordre) {
        ?>
        <p>
            <a href="/wp-content/uploads/conseil/ordre/<?php echo $ordre['file_name']; ?>"
               title="Télécharger l'ordre" target="_blank">
                <?php echo $ordre['nom']; ?>
            </a>
        </p>
        <?php
    }
    ?>
</section>
<!--- /PAGE -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
