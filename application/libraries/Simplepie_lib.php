<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simplepie_lib {

    public function load_feed($url)
    {
        // Load the autoloader
        require_once APPPATH . 'third_party/SimplePie/autoloader.php';

        $feed = new SimplePie();
        $feed->set_feed_url($url);

        // Cache directory
        $feed->set_cache_location(APPPATH . 'cache/simplepie_cache');
        $feed->enable_cache(true);
        $feed->set_cache_duration(3600); // 1 hour

        $feed->init();
        $feed->handle_content_type();

        return $feed;
    }
}
