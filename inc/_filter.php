<?php

//add_filter('get_the_archive_title', [Setup::get_instance(), 'removeCategoryPrefixTitle']);

/**
 * Remove word "Category"
 *
 * @param $title
 *
 * @return string|void
 */
 function removeCategoryPrefixTitle($title)
{
    if (is_category()) {
        //  $title = single_cat_title('', false);
    }

    return $title;
}
