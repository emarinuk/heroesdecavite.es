<?php

class NewsletterElementorAction extends \ElementorPro\Modules\Forms\Classes\Integration_Base {

    /**
     * @var NewsletterElementor
     */
    var $module;

    public function __construct() {
        $this->module = NewsletterElementor::$instance;
    }

    public function get_label() {
        return 'Newsletter';
    }

    public function get_name() {
        return 'tnp';
    }

    public function on_export($element) {
        return $element;
    }

    /**
     *
     * @param ElementorPro\Modules\Forms\Widgets\Form $form
     */
    public function register_settings_section($form) {

        $logger = $this->module->get_logger();

        $form->start_controls_section(
                'section_tnp',
                [
                    'label' => $this->get_label(),
                    'condition' => [
                        'submit_actions' => $this->get_name(),
                    ],
                ]
        );

        $this->register_fields_map_control($form);

        // Selector for preset subscriber lists
        $lists = Newsletter::instance()->get_lists();
        $options = [];

        foreach ($lists as $list) {
            $options['' . $list->id] = '(' . $list->id . ') ' . esc_html($list->name);
        }

        $form->add_control(
                'tnp_lists',
                [
                    'label' => 'Lists to add',
                    'type' => \Elementor\Controls_Manager::SELECT2,
                    'placeholder' => '',
                    'label_block' => true,
                    'separator' => 'before',
                    'multiple' => true,
                    'description' => '',
                    'options' => $options
                ]
        );

        // Selector for the welcome email (how to add a default value???)
        $options = ['0' => 'Send', '-1' => 'Do not send'];

        $form->add_control(
                'tnp_welcome_email',
                [
                    'label' => 'Welcome email',
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'placeholder' => '',
                    'label_block' => true,
                    //'separator' => 'before',
                    'multiple' => false,
                    'description' => '',
                    'options' => $options
                ]
        );

        $form->end_controls_section();
    }

    /**
     * NOTE: when this code is changed is does not affect OLD forms, we don't know why...
     *
     * @return array
     */
    protected function get_fields_map_control_options() {
        $options = [
            'default' => [
                [
                    'remote_id' => 'consent',
                    'remote_label' => 'Consent checkbox',
                    'remote_type' => 'text'
                ],
                [
                    'remote_id' => 'email',
                    'remote_label' => 'Email',
                    'remote_type' => 'email',
                    'remote_required' => true,
                ],
                [
                    'remote_id' => 'name',
                    'remote_label' => 'First Name',
                    'remote_type' => 'text',
                ],
                [
                    'remote_id' => 'surname',
                    'remote_label' => 'Last Name',
                    'remote_type' => 'text',
                ],
                [
                    'remote_id' => 'listset',
                    'remote_label' => 'Set of lists',
                    'remote_type' => 'text',
                ]
            ]
        ];

        // Public lists
        $lists = Newsletter::instance()->get_lists_public();
        foreach ($lists as $list) {
            $tmp = ['remote_id' => 'list_' . $list->id,
                'remote_label' => 'List: ' . $list->name,
                'remote_type' => 'text'];
            $options['default'][] = $tmp;
        }

        // Extra fields
        $fields = Newsletter::instance()->get_profiles_public();
        foreach ($fields as $field) {
            $tmp = ['remote_id' => 'profile_' . $field->id,
                'remote_label' => $field->name,
                'remote_type' => 'text'];
            $options['default'][] = $tmp;
        }

        return $options;
    }

    public function run($record, $ajax_handler) {
        $logger = $this->module->get_logger();
        //$logger->debug($record);

        $settings = $record->get('form_settings');
        //$logger->debug($settings);

        $fields = $record->get('fields');
        $sent_data = $record->get('sent_data');
        //$logger->debug($sent_data);

        $subscription = NewsletterSubscription::instance()->get_default_subscription();
        $newsletter = Newsletter::instance();

        foreach ($settings['tnp_fields_map'] as $map_item) {
            $name = $map_item['remote_id'];
            //$logger->debug('Subscriber field name: ' . $name);

            $form_field_name = $map_item['local_id'] ?? '';
            //$logger->debug('Form field name: ' . $form_field_name);
            // No mapping
            if (empty($form_field_name)) {
                $logger->debug('Field not mapped');
                continue;
            }

            if ($name === 'consent' && !isset($sent_data[$form_field_name])) {
                //$logger->debug('Consent not provided');
                return;
            }

            // Checkboxes, for example
            if (!isset($sent_data[$form_field_name])) {
                continue;
            }

            $value = $sent_data[$form_field_name]; // Could be an array
            //$logger->debug($value);

            switch ($name) {

                case 'email':
                    $subscription->data->email = $value;
                    continue 2;

                case 'name':
                    $subscription->data->name = $value;
                    continue 2;

                case 'surname':
                    $subscription->data->surname = $value;
                    continue 2;

                case 'listset':
                    if (is_array($value)) {
                        foreach ($value as $v) {
                            $list = Newsletter::instance()->get_list($v);
                            if ($list && $list->is_public()) {
                                $subscription->data->add_lists([$list->id]);
                            } else {

                            }
                        }
                    }
                    continue 2;
            }


            if (strpos($name, 'list_') === 0) {
                if (isset($sent_data[$form_field_name])) {

                    $logger->info('List ' . $name);
                    $id = (int) substr($name, 5);
                    $logger->info('ID: ' . $id);
                    $list = $newsletter->get_list($id);
                    if ($list && !$list->is_private()) {
                        $subscription->data->lists[$id] = 1;
                    } else {
                        $logger->info('Not found or private');
                    }
                }
                continue;
            }



            if (strpos($name, 'profile_') === 0) {
                $logger->debug('Profile field ' . $name);
                $id = (int) substr($name, 8);
                $logger->debug('ID: ' . $id);
                $profile = $newsletter->get_profile($id);
                if ($profile && !$profile->is_private()) {
                    $subscription->data->profiles[(string)$id] = $value;
                } else {
                    $logger->info('Not found or private');
                }
                continue;
            }
        }

        // Enforced lists
        $logger->debug($settings['tnp_lists']);
        if (!empty($settings['tnp_lists'])) {
            foreach ($settings['tnp_lists'] as $list_id) {
                $subscription->data->lists[(string)$list_id] = 1;
            }
        }

        // Welcome email
        if (!empty($settings['tnp_welcome_email'])) {
            $subscription->welcome_email_id = '-1'; // Do not send, a welcome email canno be selected with Elementor
        }

        $form_id = $record->get_form_settings('form_name');
        $subscription->data->referrer = 'elementor-' . $form_id;

        //$logger->debug($subscription);

        NewsletterSubscription::instance()->subscribe2($subscription);
    }
}
