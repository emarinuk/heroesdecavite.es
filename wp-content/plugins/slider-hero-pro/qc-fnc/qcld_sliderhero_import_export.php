<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly
/**
 * Import / Export
 */
function qcld_sliderhero_sliders_import_export(){
	global $wpdb;
?>
<div class="wrap">

            <div id="poststuff">

                <div id="post-body" class="metabox-holder columns-3">

                    <div id="post-body-content" style="padding: 50px;
    box-sizing: border-box;
    box-shadow: 0 8px 25px 3px rgba(0,0,0,.2);
    background: #fff;">

                        <u>
                            <h1>Bulk Export/Import</h1>
                        </u>

                        <div>
                            
                            <p style="color: red; padding: 15px;">
								<strong>Please Note:</strong> The Export Import Feature is still in Beta. We have been testing the feature extensively and it works great. If you faced any issue or encountered any bug please let us know.
							</p>

                        </div>
						<hr>
						<div style="padding: 15px; margin: 20px 0;" id="sld-export-container">

							<h3><u>Export to a CSV File</u></h3>

	                        <p>
	                        	<strong><u>Option Details:</u></strong>
	                        </p>
	                        <p>
	                        	Export button will create a downloadable CSV file for your selected slider.
	                        </p>

							<form action="<?php echo admin_url( 'admin-post.php'); ?>" method="post">
							  <input type="hidden" name="action" value="hero_export">
							  <select name="slider" required>
								<option value="">None</option>
								<?php 
									$table   = QCLD_TABLE_SLIDERS;
									$s       = 1;
									$rows     = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table WHERE %d order by `title` ASC", $s ) );
									foreach($rows as $row){
										echo '<option value="'.$row->id.'">'.$row->title.'</option>';
									}
									
								?>
							  </select>
							  <input class="button-primary" type="submit" value="Export Slider Data">
							</form>
							
							

                        </div>
						<hr>

                        <div style="padding: 15px; margin: 10px 0;">

                        <h3><u>Import from a CSV File</u></h3>

                        <p><strong><u>Importing in Another Website:</u></strong> Please note that uploaded images for Slides will not be copied if you import the CSV file to another WordPress installation.</p>

                        <p>
                        	<strong><u>Option Details:</u></strong>
                        </p>
                        <p>
                        	CSV file must be as per the exported format.
                        </p>
                        
                        

                        <!-- Handle CSV Upload -->

                        <?php

                        //Generate a 5 digit random number based on microtime
                        $randomNum = substr(sha1(mt_rand() . microtime()), mt_rand(0,35), 5);


                        /*******************************
                         * If Add New or Delete then Add New button was pressed
                         * then proceed for further processing
                         *******************************/
                        if( !empty($_POST) && isset($_POST['upload_csv']) || !empty($_POST) && isset($_POST['delete_upload_csv']) ) 
                        {

                        	//First check if the uploaded file is valid
                        	$valid = true;
                        	
                        	$allowedTypes = array(
                        			'application/vnd.ms-excel',
                        			'text/comma-separated-values', 
                        			'text/csv', 
                        			'application/csv', 
                        			'application/excel', 
                        			'application/vnd.msexcel', 
                        			'text/anytext',
                        			'application/octet-stream',
                        		);
							//echo $_FILES['csv_upload']['type'];exit;
                        	if( !in_array($_FILES['csv_upload']['type'], $allowedTypes) ){
                        		$valid = false;
                        	}

                        	if( ! $valid ){
                        		echo "Status: Invalid file type.";
                        	}
                            
                            

                            //If the file is valid and client is logged in
                            if ( $valid && function_exists('is_user_logged_in') && is_user_logged_in() ) 
							{

                                $tmpName = $_FILES['csv_upload']['tmp_name'];
								
								if( $tmpName != "" )
								{
								
									$file = fopen($tmpName, "r");
                                    $flag = true;
									
									//Reading file and building our array
									
									$baseData = array();

									$count = 0;

									$laps = 1;
									
									//Read fields from CSV file and dump in $baseData
									while(($data = fgetcsv($file)) !== FALSE) 
									{
										array_push($baseData, $data);
										
									}
									
									fclose($file);
									
									//Inserting Data from our built array
									$sliderCnt = 0;
									$sliderId = 0;
									$table   = QCLD_TABLE_SLIDERS;
									$table1   = QCLD_TABLE_SLIDES;
									foreach($baseData as $row){
										$sliderCnt++;
										
										if($sliderCnt==1){
											
											$wpdb->insert(
												$table,
												array(
													'title'  => $row[1],
													'type'   => $row[2],
													'params' => $row[3],
													'time'   => $row[4],
													'slide'  => $row[5],
													'style'  => $row[6],
													'custom' => $row[7],
													'bg_image_url' => $row[8],
													'bg_audio_url' => $row[9],
													'bg_gradient' => $row[10]
												)
											);
											$sliderId      = $wpdb->insert_id;
											
										}else{
											
											$wpdb->insert(
												$table1,
												array(
													'title'					=> $row[1],
													'sliderid'				=> $sliderId,
													'published'				=> $row[3],
													'slide'					=> $row[4],
													'description'			=> $row[5],
													'image_link'			=> $row[6],
													'image_link_new_tab'	=> $row[7],
													'thumbnail'				=> $row[8],
													'custom'				=> $row[9],
													'ordering'				=> $row[10],
													'type'					=> $row[11],
													'btn'					=> $row[12],
													'btn2'					=> $row[13],
													't_font'				=> $row[14],
													'd_font'				=> $row[15],
													'tl_space'				=> $row[16],
													'dl_space'				=> $row[17],
													'stomp'					=> $row[18],
													'draft'					=> $row[19]
												)
											);
											
										}
										
									}
									


									//Display iteration result
									
									echo  '<div style="background: #dfe2df;padding: 10px;"><span style="color: red; font-weight: bold;">RESULT:</span> <strong>1</strong> Slider with <strong>'.(count($baseData)-1).'</strong> slide(s) was made successfully.</div>';
									
								
							    }
								else
								{
								   echo "Status: Please upload a valid CSV file.";
								}

                            }

                        } 
                        else 
                        {
							//echo "Attached file is invalid!";
                        }

                        ?>
                            
                            <p>
                                <strong>
                                    <?php echo __('Upload a CSV file here to Import: '); ?>
                                </strong>
                            </p>

                            <form name="uploadfile" id="uploadfile_form" method="POST" enctype="multipart/form-data" action="" accept-charset="utf-8">
                                
                                <?php wp_nonce_field('qchero_import_nonce', 'qc-opd'); ?>

                                <p>
                                    <?php echo __('Select file to upload') ?>
                                    <input type="file" name="csv_upload" id="csv_upload" size="35" class="uploadfiles"/>
                                </p>
								<p style="color:red;">**CSV File & Characters must be saved with UTF-8 encoding**</p>
                                <p>
                                    <input class="button-primary sld-add-as-new" type="submit" name="upload_csv" id="" value="<?php echo __('Import') ?>"/>

                                   
                                </p>
								

                            </form>

                        </div>

                        <div style="padding: 15px 10px; border: 1px solid #ccc; text-align: center; margin-top: 20px;">
                            Crafted By: <a href="http://www.quantumcloud.com" target="_blank">Web Design Company</a> -
                            QuantumCloud
                        </div>

                    </div>
                    <!-- /post-body-content -->

                </div>
                <!-- /post-body-->

            </div>
            <!-- /poststuff -->


        </div>
        <!-- /wrap -->

<?php
}
function hero_text_clean($string) {
   $string = str_replace(' ', '_', $string);
   return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
}
add_action( 'admin_post_hero_export', 'hero_export_print_csv' );
function hero_export_print_csv(){
	global $wpdb;

    if ( ! current_user_can( 'manage_options' ) )
        return;
	
	$id = Sanitize_text_field($_POST['slider']);
	
	$mainArray = array();
	
	$table   = QCLD_TABLE_SLIDERS;
	$table1   = QCLD_TABLE_SLIDES;
	
	$s       = 1;
	$rows     = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table WHERE 1 and id=%d", $id ) );
	$csvTitle = 'slider_hero';
	foreach($rows as $row){
		$csvTitle = hero_text_clean($row->title);
		$sliderArray = array(
			'id'			=> $row->id,
			'title'			=> $row->title,
			'type'			=> $row->type,
			'params'		=> $row->params,
			'time'			=> $row->time,
			'slide'			=> $row->slide,
			'style'			=> $row->style,
			'custom'		=> $row->custom,
			'bg_image_url'	=> $row->bg_image_url,
			'bg_audio_url'	=> $row->bg_audio_url,
			'bg_gradient'	=> $row->bg_gradient
			
		);
		array_push($mainArray, $sliderArray);
		
		$slides     = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table1 WHERE 1 and sliderid=%d", $id ) );
		foreach($slides as $slide){
			$slideArray = array(
				'id'					=> $slide->id,
				'title'					=> $slide->title,
				'sliderid'				=> $slide->sliderid,
				'published'				=> $slide->published,
				'slide'					=> $slide->slide,
				'description'			=> $slide->description,
				'image_link'			=> $slide->image_link,
				'image_link_new_tab'	=> $slide->image_link_new_tab,
				'thumbnail'				=> $slide->thumbnail,
				'custom'				=> $slide->custom,
				'ordering'				=> $slide->ordering,
				'type'					=> $slide->type,
				'btn'					=> $slide->btn,
				'btn2'					=> $slide->btn2,
				't_font'				=> $slide->t_font,
				'd_font'				=> $slide->d_font,
				'tl_space'				=> $slide->tl_space,
				'dl_space'				=> $slide->dl_space,
				'stomp'					=> $slide->stomp,
				'draft'					=> $slide->draft
			);
			array_push($mainArray, $slideArray);
		}

	}

	hero_download_send_headers($csvTitle .'_'. date("Y-m-d") . ".csv");
	$result = hero_array2csv($mainArray);
	print $result;
	
	
}
function hero_array2csv(array &$array)
{
   if (count($array) == 0) {
     return null;
   }

   ob_start();

   $df = fopen("php://output", 'w');


   foreach ($array as $row) {
      fputcsv($df, $row);
   }

   fclose($df);

   return ob_get_clean();
}

function hero_download_send_headers($filename) {
    // disable caching
    $now = gmdate("D, d M Y H:i:s");
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header("Last-Modified: {$now} GMT");

    // force download  
    header("Content-Type: application/force-download");
    /*header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");*/

    // disposition / encoding on response body
    header("Content-Disposition: attachment;filename={$filename}");
    header("Content-Transfer-Encoding: binary");
}
