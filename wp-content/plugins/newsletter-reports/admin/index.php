<?php
// phpcs:disable WordPress.Security.NonceVerification.Recommended
// phpcs:disable WordPress.WP.EnqueuedResources.NonEnqueuedStylesheet

/* @var $this NewsletterReports */
/* @var $wpdb wpdb */

global $wpdb;

require_once NEWSLETTER_INCLUDES_DIR . '/controls.php';
$controls = new NewsletterControls();

/* @var $this NewsletterReports */
wp_enqueue_script('tnp-chart');

$statistics_module = NewsletterStatistics::instance();

if ($controls->is_action('update')) {
    $this->save_options($controls->data);
}

$controls->data = $this->get_options();
if (!is_array($controls->data)) {
    $controls->data = [];
}
$controls->data = array_merge(['type' => 'message', 'days' => 180], $controls->data);

if (isset($_GET['type'])) {
    // Direct link to this page with a type specified
    $controls->data['type'] = sanitize_key($_GET['type']);
}

$email_type = $controls->data['type'];
$send_mode = $this->get_email_send_mode($email_type);

$days = (int) $controls->data['days'];

// Emails generated by Autoresponder should be managed in a particular way
$autoresponder = strpos($email_type, 'autoresponder') !== false;
$welcome = strpos($email_type, 'welcome') !== false;
$is_continuous = $send_mode === 'continuous' || $autoresponder || $welcome;

if (!$is_continuous) {
    if (empty($days)) {
        $emails = $wpdb->get_results($wpdb->prepare("select send_on, id, subject, total, sent, type, status, stats_time, open_count, click_count, error_count, unsub_count from " . NEWSLETTER_EMAILS_TABLE . " where status='sent' and type=%s order by send_on desc", $email_type));
    } else {
        $emails = $wpdb->get_results($wpdb->prepare("select send_on, id, subject, total, sent, type, status, stats_time, open_count, click_count, error_count, unsub_count from " . NEWSLETTER_EMAILS_TABLE . " where status='sent' and type=%s and send_on>unix_timestamp()-%d*24*3600 order by send_on desc", $email_type, $days));
    }
} else {
    // TODO: Get the emails IDs from the autoresponder!
    // TODO: Delegate Autoresponder to extract the email list? Should be a good idea!
    $emails = $wpdb->get_results($wpdb->prepare("select send_on, id, subject, total, sent, type, status, stats_time, open_count, click_count, error_count, unsub_count from " . NEWSLETTER_EMAILS_TABLE . " where status='sent' and type=%s", $email_type));
}


$report = new TNP_Report();

// Used to graph the trend
$overview_labels = array(); // X-axis labels
$overview_titles = array(); // Tooltip (with subject)
$overview_open_rate = array();
$overview_click_rate = array();
$overview_reactivity = array();

$total_sent = 0;
$open_count_total = 0;
$click_count_total = 0;
$idx = 0;

$time_offset = get_option('gmt_offset') * 3600;

// Calculates the aggregates
$email_ids = [];
foreach ($emails as $email) {
    // Get updated statistics for each newsletter (cound be very slow if many newsletters need to be updated)
    $data = $this->get_statistics($email);

    $email_ids[] = $email->id;

    if (empty($data->total)) {
        //continue;
    }

    // Used later for the tabled view
    $email->report = $data;

    $idx++;

    $report->total += $data->total;
    $report->open_count += $data->open_count;
    $report->click_count += $data->click_count;
    $report->error_count += $data->error_count;
    $report->unsub_count += $data->unsub_count;

    if ($send_mode == 'standard') {
        $overview_labels[] = gmdate('Y-m-d', $email->send_on + $time_offset);
    } else {
        $overview_labels[] = $idx;
    }

    $overview_open_rate[] = $data->open_rate;
    $overview_click_rate[] = $data->click_rate;
    $overview_reactivity[] = $data->reactivity;
    $overview_titles[] = $email->subject;
}

// Updates the report populated with global data to have the percentages and other derived data
$report->update($this->get_benchmark());

if (!$is_continuous) {
    $overview_labels = array_reverse($overview_labels);
    $overview_open_rate = array_reverse($overview_open_rate);
    $overview_click_rate = array_reverse($overview_click_rate);
    $overview_reactivity = array_reverse($overview_reactivity);
} else {
    // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
    $total_user_count = $wpdb->get_var("select count(distinct user_id) from " . NEWSLETTER_SENT_TABLE . " where email_id in (" . implode(',', $email_ids) . ")");
}
?>

<link rel="stylesheet" href="<?php echo esc_attr(plugins_url('newsletter-reports')); ?>/admin/style.css?ver=<?php echo rawurlencode($this->version); ?>" type="text/css">

<script>
    // Used in graphs tooltips
    var titles = <?php echo wp_json_encode(array_reverse($overview_titles)) ?>;</script>

<div class="wrap" id="tnp-wrap">
    <?php include NEWSLETTER_ADMIN_HEADER ?>
    <div id="tnp-heading">

        <?php $controls->title_help('/reports-extension') ?>
        <h2><?php echo esc_html_e('Reports', 'newsletter') ?></h2>
        <?php include __DIR__ . '/index-nav.php' ?>

    </div>

    <div id="tnp-body" class="tnp-statistics">

        <?php include __DIR__ . '/index-filter-form.php' ?>

        <?php if (empty($emails)) { ?>
            <div class="row">
                <div class="col-md-12">
                    <p>No newsletters sent on specified interval.</p>
                </div>
            </div>


        <?php } else { ?>

            <div class="tnp-cards-container">

                <div class="tnp-card">
                    <div class="tnp-card-title">
                        <?php echo $is_continuous ? 'Sent messages' : 'Reach' ?>
                    </div>
                    <div class="tnp-card-value">
                        <span class="tnp-counter-animationx"><?php echo (int) $report->total ?></span>
                        <div class="tnp-card-description">Total messages sent</div>
                    </div>
                    <div class="tnp-card-icon"><div class="tnp-card-icon-business-contact"></div></div>
                </div>

                <div class="tnp-card">
                    <div class="tnp-card-title">Overall Opens</div>
                    <div class="tnp-card-value">
                        <span class="tnp-counter-animationx percentage"><?php echo esc_html($report->open_rate); ?></span>%
                        <div class="tnp-card-description">
                            <span class="value"><?php echo (int) $report->open_count ?></span> Total opened messages
                        </div>
                    </div>
                    <div class="tnp-card-icon"><div class="tnp-card-icon-preview"></div></div>
                </div>

                <div class="tnp-card">
                    <div class="tnp-card-title">Overall Clicks</div>
                    <div class="tnp-card-value">
                        <span class="tnp-counter-animationx percentage"><?php echo esc_html($report->click_rate); ?></span>%
                        <div class="tnp-card-description">
                            <span class="value"><?php echo (int) $report->click_count ?></span> Total clicks
                        </div>
                    </div>
                    <div class="tnp-card-icon"><div class="tnp-card-icon-mouse"></div></div>
                </div>

                <div class="tnp-card">
                    <div class="tnp-card-title">Overall Reactivity</div>
                    <div class="tnp-card-value">
                        <span class="tnp-counter-animationx percentage"><?php echo esc_html($report->reactivity) ?></span>%
                        <div class="tnp-card-description">
                            <span class="value"><?php echo (int) $report->click_count ?></span> clicks out of
                            <span class="value"><?php echo (int) $report->open_count ?></span> opens
                        </div>
                    </div>
                    <div class="tnp-card-icon"><div class="tnp-card-icon-rabbit"></div></div>
                </div>

            </div>

            <!-- Second row -->
            <div class="tnp-cards-container">
                <?php if (!$is_continuous) { ?>
                    <div class="tnp-card">
                        <div class="tnp-card-title">Opens/Sent</div>
                        <div class="tnp-card-chart">
                            <canvas id="tnp-opens-sent-chart" class="mini-chart"></canvas>
                        </div>
                    </div>
                <?php } else { ?>

                    <div class="tnp-card">
                        <div class="tnp-card-title">Subscribers</div>
                        <div class="tnp-card-value">
                            <span class="tnp-counter-animationx"><?php echo (int) $total_user_count ?></span>
                            <?php
                            /*
                              $url = wp_nonce_url(admin_url('admin-ajax.php'), 'newsletter-reports-user-count');
                              $url = add_query_arg('action', 'newsletter_reports_user_count', $url);
                              $url = add_query_arg('email_ids', implode(',', $email_ids), $url);

                              <br>
                              <button class="button-primary" onclick="jQuery('#tnp-subscriber-count').load('<?php echo $url ?>'); return false;">Compute</button>
                             */
                            ?>
                        </div>
                        <div class="tnp-card-icon"><div class="tnp-card-icon-business-contact"></div></div>
                    </div>
                <?php } ?>

                <div class="tnp-card">
                    <div class="tnp-card-title">Clicks/Opens</div>
                    <div class="tnp-card-chart">
                        <canvas id="tnp-clicks-opens-chart" class="mini-chart"></canvas>
                    </div>
                </div>

                <div class="tnp-card">
                    <div class="tnp-card-title">Unsubscriptions</div>
                    <div class="tnp-card-value">
                        <span class="tnp-counter-animationx"><?php echo (int) $report->unsub_count ?></span>
                        <div class="tnp-card-description">
                            Cancellations started from overall newsletters (cannot always be tracked)
                        </div>
                    </div>
                    <div class="tnp-card-icon"><div class="tnp-card-icon-filter-remove"></div></div>
                </div>

                <div class="tnp-card">
                    <div class="tnp-card-title">Errors</div>
                    <div class="tnp-card-value">
                        <span class="tnp-counter-animationx"><?php echo (int) $report->error_count ?></span>
                        <div class="tnp-card-description">
                            Errors encountered while delivery, usually due to a faulty mailing service.
                        </div>
                    </div>
                    <div class="tnp-card-icon"><div class="tnp-card-icon-remove"></div></div>
                </div>

            </div>


            <?php
            if (!$is_continuous) {
                include __DIR__ . '/index-charts.php';
            }
            ?>

        <?php } ?>

        <?php include NEWSLETTER_ADMIN_FOOTER; ?>

    </div>
</div>


<script type="text/javascript">
    jQuery(function ($) {

        var opensSentChartData = {
            labels: ["Sent", "Opens"],
            datasets: [
                {
                    data: [<?php echo (int) ($report->total - $report->open_count); ?>, <?php echo (int) $report->open_count ?>],
                    backgroundColor: ["#49a0e9", "#27AE60"]
                }
            ]
        };
        var opensSentChartConfig = {
            type: "doughnut",
            data: opensSentChartData,
            options: {
                responsive: true,
                legend: {display: false},
                elements: {
                    arc: {borderWidth: 0}
                }
            }
        };

        if (!!document.getElementById("tnp-opens-sent-chart")) {
            new Chart('tnp-opens-sent-chart', opensSentChartConfig);
        }

        var clicksOpensChartData = {
            labels: ["Opens", "Clicks"],
            datasets: [
                {
                    data: [<?php echo (int) ($report->open_count - $report->click_count); ?>, <?php echo (int) $report->click_count ?>],
                    backgroundColor: ["#49a0e9", "#27AE60"]
                }
            ]
        };
        var clicksOpensChartConfig = {
            type: "doughnut",
            data: clicksOpensChartData,
            options: {
                responsive: true,
                legend: {display: false},
                elements: {
                    arc: {borderWidth: 0}
                }
            }
        };
        new Chart('tnp-clicks-opens-chart', clicksOpensChartConfig);
    });
</script>
