<?php


namespace AcMarche\Theme\Inc;


class Filter
{
    public function __construct()
    {
        add_filter('the_content', [$this, 'FilterContent']);
        add_filter('rest_prepare_category', [$this, 'remove_p_tags_from_category_description'], 10, 3);
    }

    /**
     * Removes <p> tags from the category description in the WP REST API response.
     *
     * @param \WP_REST_Response $response The response object.
     * @param \WP_Term $item The term object.
     * @param \WP_REST_Request $request The request object.
     * @return \WP_REST_Response The modified response object.
     */
    function remove_p_tags_from_category_description($response, $item, $request)
    {
        // Check if the description field exists in the response data.
        if (isset($response->data['description'])) {
            // Get the description.
            $description = $response->data['description'];

            // Remove the opening and closing <p> tags.
            // str_replace is good for specific tags.
          //  $description = str_replace('<p>', '', $description);
          //  $description = str_replace('</p>', '', $description);

            // If you want to remove ALL HTML tags, use strip_tags instead:
            // $description = strip_tags( $description );

            // Update the response data with the cleaned description.
            $response->data['description'] = nl2br(trim($description));
        }

        return $response;
    }

    function FilterContent(string $content)
    {
        $content = preg_replace("#<ul>#", '<ul class="list-group">', $content);
        $content = preg_replace("#<li>#", '<li class="list-group-item">', $content);
        $content = preg_replace("#<table#", '<table class="table table-bordered table-hover"', $content);

        return $content;
    }
}
