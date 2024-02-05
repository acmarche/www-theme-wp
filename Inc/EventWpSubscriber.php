<?php


namespace AcMarche\Theme\Inc;

use AcMarche\Bottin\Search\MeiliServer;
use AcMarche\Common\Cache;
use AcMarche\Common\Env;
use AcMarche\Common\Mailer;
use WP_Post;

class EventWpSubscriber
{
    public function __construct()
    {
        add_action('post_updated', [$this, 'postUpdated'], 10, 3);
        add_action('edited_category', [$this, 'categoryUpdated'], 10, 3);
        add_action('save_post', [$this, 'postCreated'], 10, 3);
        add_action('deleted_post', [$this, 'postDeleted'], 10, 3);
    }

    function postUpdated($post_ID, WP_Post $post_after, WP_Post $post_before)
    {
        Env::loadEnv();
        $cache = Cache::instance();
        $blodId = get_current_blog_id();
        $code = Cache::generateCodeArticle($blodId, $post_ID);
        $cache->delete($code);

        try {
            $server = new MeiliServer($_ENV['MEILI_INDEX_NAME'], $_ENV['MEILI_MASTER_KEY']);
            $server->indexPost($post_after, get_current_blog_id());
        } catch (\Exception $exception) {
            Mailer::sendError("update post error", "document ".$post_after->post_title.' => '.$exception->getMessage());
        }
    }

    function postCreated(int $post_ID, WP_Post $post, bool $update)
    {
        if (!$update) {
            Env::loadEnv();
            try {
                $server = new MeiliServer($_ENV['MEILI_INDEX_NAME'], $_ENV['MEILI_MASTER_KEY']);
                $server->indexPost($post, get_current_blog_id());
            } catch (\Exception $exception) {
                Mailer::sendError("update post error", "document ".$post->post_title.' => '.$exception->getMessage());
            }
        }
    }

    function postDeleted(int $post_ID, WP_Post $post)
    {
        Env::loadEnv();
        $server = new MeiliServer($_ENV['MEILI_INDEX_NAME'], $_ENV['MEILI_MASTER_KEY']);
        try {
            $server->deletePost($post_ID, get_current_blog_id());
        } catch (\Exception $exception) {
            Mailer::sendError("delete post error", "document: ".$post->post_title.' => '.$exception->getMessage());
        }
    }

    function categoryUpdated(int $category_id)
    {
        $cache = Cache::instance();
        $blodId = get_current_blog_id();
        $code = Cache::generateCodeCategory($blodId, $category_id);
        $cache->delete($code);
    }
}
