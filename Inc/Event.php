<?php


namespace AcMarche\Theme\Inc;


use AcMarche\Common\Mailer;
use AcMarche\Elasticsearch\ElasticIndexer;
use WP_Post;

class Event
{
    public function __construct()
    {
   //     add_action('post_updated', [$this, 'postUpdated'], 10, 3);
      //  add_action('save_post', [$this, 'postCreated'], 10, 3);
   //     add_action('deleted_post', [$this, 'postDeleted'], 10, 3);
    }

    function postUpdated($post_ID, WP_Post $post_after, WP_Post $post_before)
    {
        try {
       //     $elastic = new ElasticIndexer();
        //    $elastic->indexPost($post_after, get_current_blog_id());
        } catch (\Exception $exception) {
            Mailer::sendError("update post error", "document ".$post_after->post_title.' => '.$exception->getMessage());
        }
    }

    function postCreated(int $post_ID, WP_Post $post, bool $update)
    {
        if ( ! $update) {
         //   $elastic = new ElasticIndexer();
         //   $elastic->deletePost($post_ID, get_current_blog_id());
        }
    }

    function postDeleted(int $post_ID, WP_Post $post)
    {
       // $elastic = new ElasticIndexer();
      //  $elastic->deletePost($post_ID, get_current_blog_id());
    }
}
