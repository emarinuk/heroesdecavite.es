<?php

class NewsletterLeads extends NewsletterAddon {

    /**
     * @return NewsletterLeads
     */
    static $instance;
    static $leads_colors = array(
        'autumn' => array('#db725d', '#5197d5'),
        'winter' => array('#38495c', '#5197d5'),
        'summer' => array('#eac545', '#55ab68'),
        'spring' => array('#80c99d', '#ee7e33'),
        'sunset' => array('#d35400', '#ee7e33'),
        'night' => array('#204f56', '#ee7e33'),
        'sky' => array('#5197d5', '#55ab68'),
        'forest' => array('#55ab68', '#5197d5'),
    );
    var $labels;
    var $popup_test = false;
    var $topbar_test = false;
    var $inject_test = false;
    var $popup_enabled = false;
    var $bar_enabled = false;
    var $inject_bottom_enabled = false;

    function __construct($version) {
        self::$instance = $this;
        parent::__construct('leads', $version);

        $this->setup_options();
        $this->popup_test = isset($_GET['newsletter_leads_popup']);
        $this->topbar_test = isset($_GET['newsletter_leads_topbar']);
        $this->inject_test = isset($_GET['newsletter_leads_inject']);
        $this->popup_enabled = !empty($this->options['popup-enabled']);
        $this->bar_enabled = !empty($this->options['bar-enabled']);
        $this->inject_bottom_enabled = !empty($this->options['inject_bottom_enabled']);
    }

    function upgrade($first_install = false) {
        parent::upgrade($first_install);

        $this->merge_defaults([
            'width' => 650,
            'height' => '',
            'delay' => 2,
            'count' => 0,
            'days' => 30,
            'theme_subscribe_label' => 'Subscribe',
            'theme_popup_color' => 'winter',
            'theme_bar_color' => 'winter',
            'inject_labels' => '1'
        ]);

        $this->update_popup_css();
        $this->update_topbar_css();

    }

    function init() {

        parent::init();

        if (!is_admin()) {
            if ($this->popup_enabled || $this->bar_enabled || $this->topbar_test || $this->popup_test) {
                add_action('wp_footer', [$this, 'hook_wp_footer'], 99);
                add_action('wp_enqueue_scripts', [$this, 'hook_wp_enqueue_scripts']);
            }

            if ($this->inject_bottom_enabled) {
                add_filter('the_content', [$this, 'hook_the_content']);
            }
        } else {
            if ($this->is_allowed()) {
                add_action('admin_menu', [$this, 'hook_admin_menu'], 100);
                add_filter('newsletter_menu_subscription', [$this, 'hook_newsletter_menu_subscription']);
            }
        }

        add_action('newsletter_action', [$this, 'hook_newsletter_action']);
    }

    function weekly_check() {
        parent::weekly_check();
        $license_key = Newsletter::instance()->get_license_key();
        $response = wp_remote_post('https://www.thenewsletterplugin.com/wp-content/addon-check.php?k=' . urlencode($license_key)
                . '&a=' . urlencode($this->name) . '&d=' . urlencode(home_url()) . '&v=' . urlencode($this->version)
                . '&ml=' . (Newsletter::instance()->is_multilanguage() ? '1' : '0'));
    }

    function hook_newsletter_action($action) {
        switch ($action) {
            case 'leads-popup':
                include __DIR__ . '/modal.php';
                die();
        }
    }

    function hook_newsletter_menu_subscription($entries) {
        $entries[] = array('label' => 'Leads', 'url' => '?page=newsletter_leads_index', 'description' => 'Simple subscription systems');
        return $entries;
    }

    function hook_admin_menu() {
        add_submenu_page('newsletter_main_index', 'Leads', '<span class="tnp-side-menu">Leads</span>', 'exist', 'newsletter_leads_index', function () {
            include __DIR__ . '/admin/index.php';
        });
        add_submenu_page('admin.php', 'Topbar', '<span class="tnp-side-menu">Topbar</span>', 'exist', 'newsletter_leads_topbar',
                function () {
                    include __DIR__ . '/admin/topbar.php';
                }
        );
        add_submenu_page('admin.php', 'Injection', '<span class="tnp-side-menu">Injection</span>', 'exist', 'newsletter_leads_inject',
                function () {
                    include __DIR__ . '/admin/inject.php';
                }
        );
    }

    function hook_the_content($content) {

        if (!$this->inject_test) {
            if (!is_single()) {
                return $content;
            }

            if ('post' !== get_post_type()) {
                return $content;
            }

            // Check excluded categories
            if (!empty($this->options['inject_exclude_categories'])) {
                $categories = array_map('intval', $this->options['inject_exclude_categories']);
                if ($categories && has_category($categories)) {
                    return $content;
                }
            }
        }

        // Check excluded tags

        $style = '';
        if (!empty($this->options['inject_bottom_background']['id'])) {
            $src = wp_get_attachment_image_src($this->options['inject_bottom_background']['id'], 'full');
            $style .= 'background-image: url(\'' . $src[0] . '\'); background-size: cover; background-repeat: no-repeat;';
        }

        $options = $this->get_options($this->get_current_language());

        $form_attrs = [];
        switch ($this->options['inject_bottom_color']) {
            case 'custom':
                $style .= 'background-color: ' . sanitize_hex_color($this->options['inject_bottom_color_1']) . ';';
                $style .= 'color: ' . sanitize_hex_color($this->options['inject_bottom_color_3']) . ';';
                $form_attrs['button_color'] = sanitize_hex_color($this->options['inject_bottom_color_2']);
                break;
            case 'default':
                break;
            case 'winter':
            case 'night':
            case 'sunset':
                $colors = NewsletterLeads::$leads_colors[$this->options['inject_bottom_color']];
                $style .= 'background-color: ' . sanitize_hex_color($colors[0]) . ';';
                $style .= 'color: #fff !important;';
                $form_attrs['button_color'] = sanitize_hex_color($colors[1]);
            default:
                $colors = NewsletterLeads::$leads_colors[$this->options['inject_bottom_color']];
                $style .= 'background-color: ' . sanitize_hex_color($colors[0]) . ';';
                $form_attrs['button_color'] = sanitize_hex_color($colors[1]);
        }

        $form_attrs['show_labels'] = empty($this->options['inject_labels']) ? 'false' : 'true';

        return $content
                . '<div class="tnp-subscription-posts" id="newsletter-leads-bottom"'
                . ' style="' . esc_attr($style) . '"'
                . '>'
                . $options['inject_bottom_pre']
                . NewsletterSubscription::instance()->get_subscription_form('posts_bottom', null, $form_attrs)
                . $options['inject_bottom_post']
                . '</div>';
    }

    function update_popup_css() {
        $background_color = '';
        $font_color = '';
        $button_color = '';

        switch ($this->options['theme_popup_color']) {
            case 'custom':
                $background_color = sanitize_hex_color($this->options['theme_popup_color_1']);
                $font_color = sanitize_hex_color($this->options['theme_popup_color_3'] ?? '#ffffff');
                $button_color = sanitize_hex_color($this->options['theme_popup_color_2']);
                break;
            case 'default':
                break;
            case 'winter':
            case 'night':
            case 'sunset':
                $colors = NewsletterLeads::$leads_colors[$this->options['theme_popup_color']];
                $background_color = $colors[0];
                $font_color = '#ffffff';
                $button_color = $colors[1];
            default:
                $colors = NewsletterLeads::$leads_colors[$this->options['theme_popup_color']];
                $background_color = $colors[0];
                $font_color = '#ffffff';
                $button_color = $colors[1];
        }

        if ($this->options['theme_popup_color'] == 'custom') {
            $theme_popup_color = array($this->options['theme_popup_color_1'], $this->options['theme_popup_color_2']);
        } else {
            $theme_popup_color = NewsletterLeads::$leads_colors[$this->options['theme_popup_color']];
        }

        $background_image = 'none';
        if (!empty($this->options['theme_background']['id'])) {
            $src = wp_get_attachment_image_src($this->options['theme_background']['id'], 'full');
            $background_image = 'url(\'' . $src[0] . '\')';
        }

        $css = file_get_contents(__DIR__ . '/public/leads.css');

        $height = empty($this->options['height']) ? 'auto' : (int) $this->options['height'] . 'px';
        $css = str_replace(['%height%', '%width%', '%background_color%', '%background_image%', '%font_color%', '%button_color%'],
                [$height, (int) $this->options['width'] . 'px', $background_color, $background_image, $font_color, $button_color],
                $css);

        update_option('newsletter_leads_popup_css', $css);
        return $css;
    }

    function update_topbar_css() {
        if (isset($this->options['theme_bar_color'])) {
            if ($this->options['theme_bar_color'] === 'custom') {
                $theme_bar_color = [$this->options['theme_bar_color_1'], $this->options['theme_bar_color_2']];
            } else {
                $theme_bar_color = NewsletterLeads::$leads_colors[$this->options['theme_bar_color']];
            }
        }
        if ($this->options['position'] == "top") {
            $position = 'top: -200px; transition: top 1s;';
            $position_show = is_admin_bar_showing() ? 'top: 32px' : 'top: 0px';
        } else {
            $position = 'bottom: -200px; transition: bottom 1s;';
            $position_show = 'bottom: 0px';
        }

        $css = file_get_contents(__DIR__ . '/public/topbar.css');
        $css = str_replace(['%position%', '%position_show%', '%background_0%', '%background_1%'],
                [$position, $position_show, $theme_bar_color[0], $theme_bar_color[1]],
                $css);
        update_option('newsletter_leads_topbar_css', $css);
        return $css;
    }

    function build_inject_css() {

    }

    function hook_wp_enqueue_scripts() {

        // If not in test mode and the current visitor is subscribed, do not activate
        if (!$this->popup_test && !$this->topbar_test) {
            $user = Newsletter::instance()->check_user();
            if ($user && $user->status === 'C') {
                return;
            }
        }

        $current_language = $this->get_current_language();

        if ($this->popup_enabled || $this->popup_test) {
            $data = [];
            $data['test'] = $this->popup_test ? true : false;
            $data['delay'] = (int) $this->options['delay'] * 1000;
            $data['days'] = (int) $this->options['days'];
            $data['count'] = (int) $this->options['count'];
            $data['url'] = Newsletter::add_qs(home_url('/'), 'na=leads-popup&language=' . $current_language);
            $data['post'] = home_url('/') . '?na=ajaxsub';

            wp_enqueue_script('newsletter-leads', plugins_url('newsletter-leads') . '/public/leads.js', [], $this->version, true);
            wp_localize_script('newsletter-leads', 'newsletter_leads_data', $data);
        }

        if ($this->bar_enabled || $this->topbar_test) {
            $data = [];
            $data['restart'] = (int) $this->options['days'] * 24 * 3600 * 1000;
            $data['test'] = $this->topbar_test ? true : false;
            wp_enqueue_script('newsletter-leads-topbar', plugins_url('newsletter-leads') . '/public/topbar.js', [], $this->version, true);
            wp_localize_script('newsletter-leads-topbar', 'newsletter_leads_topbar_data', $data);
        }

        wp_enqueue_style('newsletter-leads', plugins_url('newsletter-leads') . '/css/leads.css', [], $this->version);
        if (is_rtl()) {
            wp_enqueue_style('newsletter-leads-rtl', plugins_url('newsletter-leads') . '/css/leads-rtl.css', [], $this->version);
        }

        if ($this->popup_enabled || $this->popup_test) {
            $css = get_option('newsletter_leads_popup_css');
            wp_add_inline_style('newsletter-leads', $css);
        }

        if ($this->bar_enabled || $this->topbar_test) {
            $css = get_option('newsletter_leads_topbar_css');
            wp_add_inline_style('newsletter-leads', $css);
        }
    }

    function hook_wp_footer() {

        if ($this->bar_enabled || $this->topbar_test) {
            ?>
            <div id="tnp-leads-topbar">
                <?php echo $this->getBarMinimalForm(); ?>
                <label id="tnp-leads-topbar-close" onclick="tnp_leads_topbar_close()"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24"><g  transform="translate(0, 0)"><circle fill="#fff" stroke="#fff" stroke-width="1" stroke-linecap="square" stroke-miterlimit="10" cx="12" cy="12" r="11" stroke-linejoin="miter"/><line data-color="color-2" fill="#fff" stroke="#343434" stroke-width="1" stroke-linecap="square" stroke-miterlimit="10" x1="16" y1="8" x2="8" y2="16" stroke-linejoin="miter"/><line data-color="color-2" fill="none" stroke="#343434" stroke-width="1" stroke-linecap="square" stroke-miterlimit="10" x1="16" y1="16" x2="8" y2="8" stroke-linejoin="miter"/></g></svg></label>
            </div>
            <?php
        }

        if ($this->popup_enabled || $this->popup_test) {
            ?>
            <div id="tnp-modal">
                <div id="tnp-modal-content">
                    <div id="tnp-modal-close">&times;</div>
                    <div id="tnp-modal-body">
                    </div>
                </div>
            </div>
            <?php
        }
    }

    private function getBarMinimalForm() {

        $subscription = NewsletterSubscription::instance();

        $language = $subscription->get_current_language();
        $options = $this->get_options($language);

        if (empty($options['bar_subscribe_label'])) {
            $options['bar_subscribe_label'] = $subscription->get_form_text('subscribe');
        }

        if (empty($options['bar_placeholder'])) {
            $options['bar_placeholder'] = $subscription->get_form_text('email');
        }

        $form = '<div class="tnp tnp-subscription-minimal">';
        $form .= '<form action="' . esc_attr($subscription->get_subscribe_url()) . '" method="post">';

        if (!empty($this->options['bar_list'])) {
            $form .= "<input type='hidden' name='nl[]' value='" . esc_attr($this->options['bar_list']) . "'>\n";
        }
        $form .= '<input type="hidden" name="nr" value="leads-bar">';
        $form .= '<input type="hidden" name="nlang" value="' . esc_attr($language) . '">' . "\n";
        $form .= '<input class="tnp-email" type="email" required name="ne" value="" placeholder="' . esc_attr($options['bar_placeholder']) . '">';
        $form .= '<input class="tnp-submit" type="submit" value="' . esc_attr($options['bar_subscribe_label']) . '">';

        // If SET it DISABLES the privacy field
        if (empty($options['bar_field_privacy'])) {
            $privacy_field = $subscription->get_privacy_field();
            if (!empty($privacy_field)) {
                $form .= '<div class="tnp-privacy-field">' . $privacy_field . '</div>';
            }
        }

        $form .= "</form></div>\n";

        return $form;
    }
}
