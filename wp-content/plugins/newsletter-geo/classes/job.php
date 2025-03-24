<?php

class NewsletterGeoJob {

    var $addon;

    public function __construct($addon) {
        $this->addon = $addon;
    }

    /**
     *
     * @global wpdb $wpdb
     * @param type $test
     * @return type
     */
    function run($test = false) {
        global $wpdb;
        $logger = $this->addon->get_logger();

        $logger->info('Start');

        @set_time_limit(0);

        if (!$test) {
            $this->addon->save_last_run(time());
        } else {
            $logger->debug('Test mode');
            $data = $this->resolve([$_SERVER['REMOTE_ADDR'], '8.8.8.8']);
            return $data;
        }

        $count = 0;
        for ($i = 0; $i < 10; $i++) {

            $list = $wpdb->get_results("select id, ip from " . NEWSLETTER_USERS_TABLE . " where geo=0 and ip<>'' limit 20");
            if (!empty($list)) {
                $this->addon->country_result .= ' Processed ' . count($list) . ' subscribers.';
                $ips = [];
                foreach ($list as $r) {
                    $ips[] = $r->ip;
                }
                $result = $this->resolve($ips);

                if (is_wp_error($result)) {
                    $logger->error('Service unavailable');
                    $logger->error($result);
                    return $result;
                }

                //$logger->debug($result);

                foreach ($list as $r) {
                    //$logger->debug($r);
                    //$logger->debug('Resolving: ' . $r->ip);
                    $data = $result[$r->ip];

                    $count++;

                    if (is_wp_error($data)) {
                        $logger->fatal($data);
                        $wpdb->query($wpdb->prepare("update " . NEWSLETTER_USERS_TABLE . " set geo=1, country='', region='', city='' where id=%d limit 1", $r->id));
                        //return $data;
                    } else {
                        if (!empty($data)) {
                            $rr = $wpdb->query($wpdb->prepare("update " . NEWSLETTER_USERS_TABLE . " set geo=1, country=%s, region=%s, city=%s where id=%d limit 1", $data['country'], $data['region'], $data['city'], $r->id));
                            if (!empty($wpdb->last_error))
                                die($wpdb->last_error);
                        } else {
                            $wpdb->query($wpdb->prepare("update " . NEWSLETTER_USERS_TABLE . " set geo=1, country='XX', region='', city='' where id=%d limit 1", $r->id));
                            if (!empty($wpdb->last_error))
                                die($wpdb->last_error);
                        }
                    }
                }
                sleep(1);
            }
        }
        return $count;
    }

    /**
     *
     * @param string[] $ips
     * @return array
     */
    function resolve($ips) {
        if (empty($ips)) {
            return [];
        }
        $data = $this->get_response_data('http://geo.thenewsletterplugin.com/resolve.php?ip=' . rawurlencode(implode(',', $ips)));

        if (is_wp_error($data)) {
            return $data;
        } else {
            $result = [];
            foreach ($data as $ip => $values) {
                $result[$ip] = (array) $values;
            }
        }

        return $result;
    }

    function get_response_data($url) {
        $response = wp_remote_get($url);
        if (is_wp_error($response)) {
            return $response;
        } else if (wp_remote_retrieve_response_code($response) != 200) {
            return new WP_Error(wp_remote_retrieve_response_code($response), 'Error on connection to ' . $url . ' with error HTTP code ' . wp_remote_retrieve_response_code($response));
        }
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body);
        if (!$data) {
            return new WP_Error(1, 'Unable to decode the JSON from ' . $url, $body);
        }
        return $data;
    }
}
