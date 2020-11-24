<?php

add_action('pre_get_posts', 'alterMainQuery');
add_action('pre_get_posts', 'modify_where_category');

function alterMainQuery($query)
{
    if ( ! is_admin() && $query->is_main_query()) {
        $query->set('post_type', array('post', 'page', 'bottin_fiche'));
    }

    return $query;
}

function modify_where_category(WP_Query $query)
{
    if ( ! is_admin() && $query->is_category()) :

        $object = get_queried_object();

        if ($object != null) {
            if ($object->cat_ID) {
                if ($query->is_main_query()) {
                    $ID_cat = $object->cat_ID;

                    //sinon prend enfant
                    $query->set('category__in', $ID_cat);
                }
            }
        }
    endif;
}
