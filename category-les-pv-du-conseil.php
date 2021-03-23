<?php


namespace AcMarche\Theme;

get_header();

use Symfony\Component\Finder\Finder;

?>

    <!-- PAGE -->
    <section id="page">
        <br/>
        <?php include_once 'social_category.php'; ?>

        <div class="clearBoth"></div>
        <br/>
        <?php
        $category_description = category_description();
        if (!empty($category_description)) {
            echo apply_filters(
                'category_archive_meta',
                '<div class="category-archive-meta">' . $category_description . '</div>'
            );
        }
        ?>

        <?php

        function find_all_files($annee)
        {
            $conseil = '/uploads/conseil/pv/' . $annee . '/';
            $dir = WP_CONTENT_DIR . $conseil;
            $files = array();

            if (!is_dir($dir)) {
                return $files;
            }

            $finder = new Finder();
            $finder->files()->in($dir);
            $finder->sort(
                function ($a, $b) {
                    return ($a->getrelativePathname() > $b->getrelativePathname()) ? -1 : 1;
                }
            );
            $i = 0;

            foreach ($finder as $file) {
                $fileName = $file->getRelativePathname();
                $files[$i]['name'] = $fileName;
                $file_info = pathinfo($dir . $file);
                $fichier = $file_info['filename'];
                $files[$i]['url'] = '/wp-content' . $conseil . $fileName;

                try {
                    $date_time = new DateTime($fichier);
                    $date_fr = $date_time->format("d-m-Y");
                } catch (Exception $e) {
                    $date_fr = $fileName;
                }
                $i++;
            }

            return $files;
        }

        $conseilDb = new ConseilDb();
        ?>
        <h2>Les PV de 2020</h2>
        <ul>
            <?php
            $pvs = $conseilDb->getPvByYear(2020);
            foreach ($pvs as $pv) {
                ?>
                <li>
                    <a href="/wp-content/uploads/conseil/pv/<?php echo $pv['file_name']; ?>"
                       title="Télécharger le pv" target="_blank">
                        <?php echo $pv['nom']; ?>
                    </a>
                </li>
                <?php
            }
            ?>
        </ul>
        <h2>Les PV de 2019</h2>
        <ul>
            <?php
            $pvs = $conseilDb->getPvByYear(2019);
            foreach ($pvs as $pv) {
                ?>
                <li>
                    <a href="/wp-content/uploads/conseil/pv/<?php echo $pv['file_name']; ?>"
                       title="Télécharger le pv" target="_blank">
                        <?php echo $pv['nom']; ?>
                    </a>
                </li>
                <?php
            }
            ?>
        </ul>
        <h2>Les PV de 2018</h2>
        <ul>
            <?php
            $files = find_all_files('2018');
            foreach ($files as $file) {
                ?>
                <li><a href="<?php echo $file['url'] ?>" title="Télécharger le Pv"
                       target="_blank"><?php echo $file['name'] ?></a></li>
                <?php
            }
            ?>
        </ul>
        <h2>Les PV de 2017</h2>
        <ul>
            <?php
            $files = find_all_files('2017');
            foreach ($files as $file) {
                ?>
                <li><a href="<?php echo $file['url'] ?>" title="Télécharger le Pv"
                       target="_blank"><?php echo $file['name'] ?></a></li>
                <?php
            }
            ?>
        </ul>
        <h2>Les PV de 2016</h2>
        <ul>
            <?php
            $files = find_all_files('2016');
            foreach ($files as $file) {
                ?>
                <li><a href="<?php echo $file['url'] ?>" title="Télécharger le Pv"
                       target="_blank"><?php echo $file['name'] ?></a></li>
                <?php
            }
            ?>
        </ul>
        <h2>Les PV de 2015</h2>
        <ul>
            <?php
            $files = find_all_files('2015');
            foreach ($files as $file) {
                ?>
                <li><a href="<?php echo $file['url'] ?>" title="Télécharger le Pv"
                       target="_blank"><?php echo $file['name'] ?></a></li>
                <?php
            }
            ?>
        </ul>
        <h2>Les PV de 2014</h2>
        <ul>
            <?php
            $files = find_all_files('2014');
            foreach ($files as $file) {
                ?>
                <li><a href="<?php echo $file['url'] ?>" title="Télécharger le Pv"
                       target="_blank"><?php echo $file['name'] ?></a></li>
                <?php
            }
            ?>
        </ul>
        <h2>Les PV de 2013</h2>
        <ul>
            <?php
            $files = find_all_files('2013');
            foreach ($files as $file) {
                ?>
                <li><a href="<?php echo $file['url'] ?>" title="Télécharger le Pv"
                       target="_blank"><?php echo $file['name'] ?></a></li>
                <?php
            }
            ?>
        </ul>
        <?php if (have_posts()) : ?>

            <?php /* Start the Loop */ ?>
            <?php while (have_posts()) : the_post(); ?>

                <?php
                get_template_part('content', 'line');
                ?>

            <?php endwhile; ?>

        <?php endif; ?>

    </section>
    <!--- /PAGE -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
