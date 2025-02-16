<?php 

if( !defined( 'ABSPATH' ) ) exit();


if( !class_exists( 'OVAEV_Admin_Settings' ) ){

	/**
	 * Make Admin Class
	 */
	class OVAEV_Admin_Settings{

		/**
		 * Construct Admin
		 */
		public function __construct(){
			add_action( 'admin_enqueue_scripts', array( $this, 'ovaev_load_media' ) );
			add_action( 'admin_init', array( $this, 'register_options' ) );
		}


		public function ovaev_load_media() {
			wp_enqueue_media();
		}


		public function print_options_section(){
			return true;
		}


		public function register_options(){

			register_setting(
				'ovaev_options_group', // Option group
				'ovaev_options', // Name Option
				array( $this, 'settings_callback' ) // Call Back
			);

			/**
			 * General Settings
			 */
			// Add Section: General Settings
			add_settings_section(
				'ovaev_general_section_id', // ID
				esc_html__('General Setting', 'ovaev'), // Title
				array( $this, 'print_options_section' ),
				'ovaev_general_settings' // Page
			);

			// Add Fields: General Section
			add_settings_field(
				'ovaev_event_post_type_rewrite_slug', // ID
				esc_html__('Rewrite Slug','ovaev'),
				array( $this, 'ovaev_event_post_type_rewrite_slug' ),
				'ovaev_general_settings', // Page
				'ovaev_general_section_id' // Section ID
			);

			

			

			add_settings_field(
				'archive_format_date_lang', // ID
				esc_html__('Calendar Language','ovaev'),
				array( $this, 'archive_format_date_lang' ),
				'ovaev_general_settings', // Page
				'ovaev_general_section_id' // Section ID
			);


			/**
			 * Basic Settings
			 */

			/** Add Section: Archive Event Settings **/
			add_settings_section(
				'ovaev_archive_event_section_id', // ID
				esc_html__('Archive Event Setting', 'ovaev'), // Title
				array( $this, 'print_options_section' ),
				'ovaev_archive_event_settings' // Page
			);

			add_settings_field(
				'ovaev_show_past', // ID
				esc_html__('Show Past in Archive','ovaev'),
				array( $this, 'ovaev_show_past' ),
				'ovaev_archive_event_settings', // Page
				'ovaev_archive_event_section_id' // Section ID
			);

			add_settings_field(
				'archive_event_order', // ID
				esc_html__('Order','ovaev'),
				array( $this, 'archive_event_order' ),
				'ovaev_archive_event_settings', // Page
				'ovaev_archive_event_section_id' // Section ID
			);

			add_settings_field(
				'archive_event_orderby', // ID
				esc_html__('Order By','ovaev'),
				array( $this, 'archive_event_orderby' ),
				'ovaev_archive_event_settings', // Page
				'ovaev_archive_event_section_id' // Section ID
			);

			add_settings_field(
				'archive_event_type', // ID
				esc_html__('Archive Type','ovaev'),
				array( $this, 'archive_event_type' ),
				'ovaev_archive_event_settings', // Page
				'ovaev_archive_event_section_id' // Section ID
			);

			add_settings_field(
				'archive_event_heading', // ID
				esc_html__('Heading','ovaev'),
				array( $this, 'archive_event_heading' ),
				'ovaev_archive_event_settings', // Page
				'ovaev_archive_event_section_id' // Section ID
			);

			add_settings_field(
				'archive_event_desc', // ID
				esc_html__('Description','ovaev'),
				array( $this, 'archive_event_desc' ),
				'ovaev_archive_event_settings', // Page
				'ovaev_archive_event_section_id' // Section ID
			);

			add_settings_field(
				'archive_event_header', // ID
				esc_html__('Header','ova-collection'),
				array( $this, 'archive_event_header' ),
				'ovaev_archive_event_settings', // Page
				'ovaev_archive_event_section_id' // Section ID
			);

			add_settings_field(
				'archive_event_footer', // ID
				esc_html__('Footer','ova-collection'),
				array( $this, 'archive_event_footer' ),
				'ovaev_archive_event_settings', // Page
				'ovaev_archive_event_section_id' // Section ID
			);




			/** Add Section: Single Event Settings **/
			add_settings_section(
				'ovaev_single_event_section_id', // ID
				esc_html__('Single Event Setting', 'ovaev'), // Title
				array( $this, 'print_options_section' ),
				'ovaev_single_event_settings' // Page
			);

			add_settings_field(
				'google_key_map', // ID
				esc_html__('Google Key Map','ovaev'),
				array( $this, 'google_key_map' ),
				'ovaev_single_event_settings', // Page
				'ovaev_single_event_section_id' // Section ID
			);

			add_settings_field(
				'event_map_zoom', // ID
				esc_html__('Google Map Zoom','ovaev'),
				array( $this, 'event_map_zoom' ),
				'ovaev_single_event_settings', // Page
				'ovaev_single_event_section_id' // Section ID
			);


			add_settings_field(
				'single_event_header', // ID
				esc_html__('Header','ova-collection'),
				array( $this, 'single_event_header' ),
				'ovaev_single_event_settings', // Page
				'ovaev_single_event_section_id' // Section ID
			);

			add_settings_field(
				'single_event_footer', // ID
				esc_html__('Footer','ova-collection'),
				array( $this, 'single_event_footer' ),
				'ovaev_single_event_settings', // Page
				'ovaev_single_event_section_id' // Section ID
			);


		}

		public function settings_callback( $input ){

			$new_input = array();

			if( isset( $input['ovaev_event_post_type_rewrite_slug'] ) )
				$new_input['ovaev_event_post_type_rewrite_slug'] = sanitize_text_field( $input['ovaev_event_post_type_rewrite_slug'] ) ? sanitize_text_field( $input['ovaev_event_post_type_rewrite_slug'] ) : 'event';

			if( isset( $input['google_key_map'] ) )
				$new_input['google_key_map'] = sanitize_text_field( $input['google_key_map'] ) ? sanitize_text_field( $input['google_key_map'] ) : '';

			if( isset( $input['event_map_zoom'] ) )
				$new_input['event_map_zoom'] = sanitize_text_field( $input['event_map_zoom'] ) ? sanitize_text_field( $input['event_map_zoom'] ) : '17';

			if( isset( $input['ovaev_show_past'] ) )
				$new_input['ovaev_show_past'] = sanitize_text_field( $input['ovaev_show_past'] ) ? sanitize_text_field( $input['ovaev_show_past'] ) : 'yes';

			if( isset( $input['archive_event_orderby'] ) )
				$new_input['archive_event_orderby'] = sanitize_text_field( $input['archive_event_orderby'] ) ? sanitize_text_field( $input['archive_event_orderby'] ) : 'title';

			if( isset( $input['archive_event_order'] ) )
				$new_input['archive_event_order'] = sanitize_text_field( $input['archive_event_order'] ) ? sanitize_text_field( $input['archive_event_order'] ) : 'ASC';

			if( isset( $input['archive_event_heading'] ) )
				$new_input['archive_event_heading'] = sanitize_text_field( $input['archive_event_heading'] ) ? sanitize_text_field( $input['archive_event_heading'] ) : '';

			if( isset( $input['archive_event_desc'] ) )
				$new_input['archive_event_desc'] = sanitize_text_field( $input['archive_event_desc'] ) ? sanitize_text_field( $input['archive_event_desc'] ) : '';

			if( isset( $input['archive_event_type'] ) )
				$new_input['archive_event_type'] = sanitize_text_field( $input['archive_event_type'] ) ? sanitize_text_field( $input['archive_event_type'] ) : 'type1';

			

			if( isset( $input['archive_format_date_lang'] ) )
				$new_input['archive_format_date_lang'] = sanitize_text_field( $input['archive_format_date_lang'] ) ? sanitize_text_field( $input['archive_format_date_lang'] ) : 'en';

			if( isset( $input['archive_event_header'] ) )
				$new_input['archive_event_header'] = sanitize_text_field( $input['archive_event_header'] ) ? sanitize_text_field( $input['archive_event_header'] ) : 'default';

			if( isset( $input['archive_event_footer'] ) )
				$new_input['archive_event_footer'] = sanitize_text_field( $input['archive_event_footer'] ) ? sanitize_text_field( $input['archive_event_footer'] ) : 'default';


			if( isset( $input['single_event_header'] ) )
				$new_input['single_event_header'] = sanitize_text_field( $input['single_event_header'] ) ? sanitize_text_field( $input['single_event_header'] ) : 'default';

			if( isset( $input['single_event_footer'] ) )
				$new_input['single_event_footer'] = sanitize_text_field( $input['single_event_footer'] ) ? sanitize_text_field( $input['single_event_footer'] ) : 'default';


			

			return $new_input;
		}


		public static function create_admin_setting_page() { ?>
			<div class="wrap">
				<h1><?php esc_html_e( "Event Settings", "ovaev" ); ?></h1>

				<form method="post" action="options.php">

					<div id="tabs">

						<?php settings_fields( 'ovaev_options_group' ); // Options group ?>

						<!-- Menu Tab -->
						<ul>
							<li><a href="#ovaev_general_settings"><?php esc_html_e( 'General Settings', 'ovaev' ); ?></a></li>
							<li><a href="#ovaev_event_settings"><?php esc_html_e( 'Event Settings', 'ovaev' ); ?></a></li>
						</ul>

						<!-- General Settings -->  
						<div id="ovaev_general_settings" class="ovaev_admin_settings">
							<?php do_settings_sections( 'ovaev_general_settings' ); // Page ?>
						</div>

						<!-- Event Settings -->  
						<div id="ovaev_event_settings" class="ovaev_admin_settings">
							<?php do_settings_sections( 'ovaev_archive_event_settings' ); // Page ?>
							<hr>
							<?php do_settings_sections( 'ovaev_single_event_settings' ); // Page ?>
						</div>

					</div>

					<?php submit_button(); ?>
				</form>
			</div>

		<?php }


		/***** General Settings *****/
		public function ovaev_event_post_type_rewrite_slug(){
			$ovaev_event_post_type_rewrite_slug = esc_attr( OVAEV_Settings::ovaev_event_post_type_rewrite_slug() );
			printf(
				'<input type="text"  id="ovaev_event_post_type_rewrite_slug" name="ovaev_options[ovaev_event_post_type_rewrite_slug]" value="%s" />',
				isset( $ovaev_event_post_type_rewrite_slug ) ? $ovaev_event_post_type_rewrite_slug : 'event'
			);
			echo '<span >'.esc_html__(' Name should only contain lowercase letters and the underscore character, and not be more than 32 characters long and  without any spaces', 'ovaev').'<span>';
		}


		/***** Archive Event Settings *****/
		public function ovaev_show_past(){
			$ovaev_show_past = OVAEV_Settings::ovaev_show_past();
			$ovaev_show_past = isset( $ovaev_show_past ) ? $ovaev_show_past : 'yes';

			$yes = ( 'yes' == $ovaev_show_past ) ? 'selected' : '';
			$no  = ( 'no' == $ovaev_show_past ) ? 'selected' : '';

			?>
			<select name="ovaev_options[ovaev_show_past]" id="ovaev_show_past">
				<option <?php echo esc_attr($yes) ?> value="yes"><?php echo esc_html__('Yes', 'ovaev') ?></option>
				<option <?php echo esc_attr($no) ?> value="no"><?php echo esc_html__('No', 'ovaev') ?></option>
			</select>
			<?php
		}

		public function archive_event_orderby(){
			$archive_event_orderby = OVAEV_Settings::archive_event_orderby();
			$archive_event_orderby = isset( $archive_event_orderby ) ? $archive_event_orderby : 'title';

			$title             = ( 'title' == $archive_event_orderby) ? 'selected' : '';
			$event_custom_sort = ( 'event_custom_sort' == $archive_event_orderby) ? 'selected' : '';
			$ovaev_start_date  = ( 'ovaev_start_date' == $archive_event_orderby) ? 'selected' : '';
			$id                = ( 'ID' == $archive_event_orderby) ? 'selected' : '';

			?>
			<select name="ovaev_options[archive_event_orderby]" id="archive_event_orderby">
				<option <?php echo esc_attr($title) ?> value="title"><?php echo esc_html__('Title', 'ovaev') ?></option>
				<option <?php echo esc_attr($event_custom_sort) ?> value="event_custom_sort"><?php echo esc_html__('Custom Sort', 'ovaev') ?></option>
				<option <?php echo esc_attr($ovaev_start_date) ?> value="ovaev_start_date"><?php echo esc_html__('Start Date', 'ovaev') ?></option>
				<option <?php echo esc_attr($id) ?> value="ID"><?php echo esc_html__('ID', 'ovaev') ?></option>
			</select>
			<?php
		}

		public function archive_event_order(){
			$archive_event_order = OVAEV_Settings::archive_event_order(); 	
			$archive_event_order = isset( $archive_event_order ) ? $archive_event_order : 'ASC';

			$asc_selected  = ('ASC' == $archive_event_order) ? 'selected' : '';
			$desc_selected = ('DESC' == $archive_event_order) ? 'selected' : '';

			?>
			<select name="ovaev_options[archive_event_order]" id="archive_event_order">
				<option <?php echo esc_attr($asc_selected) ?> value="ASC"><?php echo esc_html__('Ascending', 'ovaev') ?></option>
				<option <?php echo esc_attr($desc_selected) ?> value="DESC"><?php echo esc_html__('Descending', 'ovaev') ?></option>
			</select>
			<?php
		}

		public function archive_event_heading(){
			$archive_event_heading =  esc_attr( OVAEV_Settings::archive_event_heading() );
			printf(
				'<input type="text" id="archive_event_heading"  name="ovaev_options[archive_event_heading]" value="%s" />',
				isset( $archive_event_heading ) ? $archive_event_heading : ''
			);
		}

		public function archive_event_desc(){
			$archive_event_desc =  esc_attr( OVAEV_Settings::archive_event_desc() );
			printf(
				'<textarea id="archive_event_desc" rows="4" cols="50" name="ovaev_options[archive_event_desc]" value="%s">'.$archive_event_desc.'</textarea>',
				isset( $archive_event_desc ) ? $archive_event_desc : ''
			);
		}

		public function archive_event_type(){
			$archive_event_type = OVAEV_Settings::archive_event_type(); 	
			$archive_event_type = isset( $archive_event_type ) ? $archive_event_type : 'ASC';

			$type1 = ('type1' == $archive_event_type) ? 'selected' : '';
			$type2 = ('type2' == $archive_event_type) ? 'selected' : '';
			$type3 = ('type3' == $archive_event_type) ? 'selected' : '';
			$type4 = ('type4' == $archive_event_type) ? 'selected' : '';

			?>
			<select name="ovaev_options[archive_event_type]" id="archive_event_type">
				<option <?php echo esc_attr($type1) ?> value="type1"><?php echo esc_html__('Classic', 'ovaev') ?></option>
				<option <?php echo esc_attr($type2) ?> value="type2"><?php echo esc_html__('Grid', 'ovaev') ?></option>
				<option <?php echo esc_attr($type3) ?> value="type3"><?php echo esc_html__('Compact', 'ovaev') ?></option>
				<option <?php echo esc_attr($type4) ?> value="type4"><?php echo esc_html__('Default', 'ovaev') ?></option>
			</select>
			<?php
		}

		

		

		public function archive_format_date_lang(){
			$archive_format_date_lang = OVAEV_Settings::archive_format_date_lang() ? OVAEV_Settings::archive_format_date_lang() : 'en';
			?>
			<input type="text" name="ovaev_options[archive_format_date_lang]" value="<?php echo esc_attr($archive_format_date_lang) ?>" />
			<?php
			echo esc_html__('Example: en','ovaev');
			echo '<br/>'.esc_html__('You can check language here','ovaev').' <a href="https://xdsoft.net/jqplugins/datetimepicker/#lang" target="_blank">'.'Here'.'</a>';
		}


		/*****  Single Event Settings *****/
		public function google_key_map(){
			$google_key_map =  esc_attr( OVAEV_Settings::google_key_map() );
			printf(
				'<input type="text" id="google_key_map"  name="ovaev_options[google_key_map]" value="%s" />',
				isset( $google_key_map ) ? $google_key_map : ''
			);
			echo ' <span>'.esc_html__('You can get here: https://developers.google.com/maps/documentation/javascript/get-api-key ', 'ovaev').'</span>'; 
		}

		public function event_map_zoom(){
			$event_map_zoom = OVAEV_Settings::event_map_zoom();
			$event_map_zoom = isset( $event_map_zoom ) ? $event_map_zoom : '17';

			printf(
				'<input type="number" id="event_map_zoom" name="ovaev_options[event_map_zoom]" value="%s" />',
				isset( $event_map_zoom ) ? $event_map_zoom : '17'
			);
		}


		public function archive_event_header(){
			$archive_event_header = OVAEV_Settings::archive_event_header(); 	
			$archive_event_header = isset( $archive_event_header ) ? $archive_event_header : 'default';

			$list_header = apply_filters('muzze_list_header', '');

			?>
			<select name="ovaev_options[archive_event_header]" id="archive_event_header">
				<?php if( $list_header ){ ?>
					<?php foreach ($list_header as $key => $value) { ?>
						<option <?php if( $key == $archive_event_header ) echo 'selected'; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php } ?>
				<?php } ?>
				
			</select>
			<?php
		}

		public function archive_event_footer(){
			$archive_event_footer = OVAEV_Settings::archive_event_footer(); 	
			$archive_event_footer = isset( $archive_event_footer ) ? $archive_event_footer : 'default';

			$list_footer = apply_filters('muzze_list_footer', '');

			?>
			<select name="ovaev_options[archive_event_footer]" id="archive_event_footer">
				<?php if( $list_footer ){ ?>
					<?php foreach ($list_footer as $key => $value) { ?>
						<option <?php if( $key == $archive_event_footer ) echo 'selected'; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php } ?>
				<?php } ?>
				
			</select>
			<?php
		}

		public function single_event_header(){
			$single_event_header = OVAEV_Settings::single_event_header(); 	
			$single_event_header = isset( $single_event_header ) ? $single_event_header : 'default';

			$list_header = apply_filters('muzze_list_header', '');

			?>
			<select name="ovaev_options[single_event_header]" id="single_event_header">
				<?php if( $list_header ){ ?>
					<?php foreach ($list_header as $key => $value) { ?>
						<option <?php if( $key == $single_event_header ) echo 'selected'; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php } ?>
				<?php } ?>
				
			</select>
			<?php
		}

		public function single_event_footer(){
			$single_event_footer = OVAEV_Settings::single_event_footer(); 	
			$single_event_footer = isset( $single_event_footer ) ? $single_event_footer : 'default';

			$list_footer = apply_filters('muzze_list_footer', '');

			?>
			<select name="ovaev_options[single_event_footer]" id="single_event_footer">
				<?php if( $list_footer ){ ?>
					<?php foreach ($list_footer as $key => $value) { ?>
						<option <?php if( $key == $single_event_footer ) echo 'selected'; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php } ?>
				<?php } ?>
				
			</select>
			<?php
		}

	}
	new OVAEV_Admin_Settings();
}
