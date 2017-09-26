<?php
if (!defined('ABSPATH')) die('-1');

if (!class_exists("WD_ASP_Priorities")) {
    /**
     * Class WD_ASP_Priorities
     *
     * Temporary wrapper class for priorities handling
     *
     * @class         WD_ASP_Priorities
     * @version       1.0
     * @package       AjaxSearchPro/Classes/Etc
     * @category      Class
     * @author        Ernest Marcinko
     */
    class WD_ASP_Priorities {
        /**
         *
         */
        static function ajax_get_posts() {
            global $wpdb;
            parse_str($_POST['options'], $o);

            $w_post_type = '';
            $w_filter = '';
            $w_limit = (int)$o['p_asp_limit'];
            $pt = wd_asp()->db->table("priorities");

            if (isset($o['blog_id']) && $o['blog_id'] != 0 && is_multisite())
                switch_to_blog($o['p_asp_blog']);

            if ($o['p_asp_filter'] != '') {
                $w_filter = "AND $wpdb->posts.post_title LIKE '%" . $o['p_asp_filter'] . "%'";
            }

            if ($o['p_asp_post_type'] != 'all') {
                $w_post_type = "AND $wpdb->posts.post_type = '" . $o['p_asp_post_type'] . "'";
            }

            $querystr = "
    		SELECT
          $wpdb->posts.post_title as title,
          $wpdb->posts.ID as id,
          $wpdb->posts.post_date as date,
          $wpdb->users.user_nicename as author,
          $wpdb->posts.post_type as post_type,
          CASE WHEN $pt.priority IS NULL
                   THEN 100
                   ELSE $pt.priority
          END AS priority
    		FROM $wpdb->posts
        LEFT JOIN $wpdb->users ON $wpdb->users.ID = $wpdb->posts.post_author
        LEFT JOIN $pt ON ($pt.post_id = $wpdb->posts.ID AND $pt.blog_id = " . get_current_blog_id() . ")
    	WHERE
          $wpdb->posts.ID>0 AND
          $wpdb->posts.post_status IN ('publish', 'pending') AND
          $wpdb->posts.post_type NOT IN ('revision', 'attachment')
          $w_post_type
          $w_filter
        GROUP BY
          $wpdb->posts.ID
        ORDER BY " . $o['p_asp_ordering'] . "
        LIMIT $w_limit";

            echo "!!PASPSTART!!" . json_encode($wpdb->get_results($querystr, OBJECT)) . '!!PASPEND!!';

            if (is_multisite())
                restore_current_blog();

            die();
        }


        /**
         *
         */
        static function ajax_set_priorities() {
            global $wpdb;
            $i = 0;
            parse_str($_POST['options'], $o);

            if ($o['p_blogid'] == 0)
                $o['p_blogid'] = get_current_blog_id();

            foreach ($o['priority'] as $k => $v) {

                // See if the value changed, count them
                if ($v != $o['old_priority'][$k]) {

                    $i++;
                    $query = "INSERT INTO ".wd_asp()->db->table("priorities")."
                    (post_id, blog_id, priority)
                    VALUES($k, " . $o['p_blogid'] . ", $v)
                    ON DUPLICATE KEY UPDATE priority=" . $v;
                    $wpdb->query($query);
                }
            }
            echo "!!PSASPSTART!!" . $i . "!!PSASPEND!!";

            if (is_multisite())
                restore_current_blog();

            // Cleanup
            $wpdb->query("DELETE FROM " . wd_asp()->db->table("priorities") . " WHERE priority=100");

            die();
        }
    }
}