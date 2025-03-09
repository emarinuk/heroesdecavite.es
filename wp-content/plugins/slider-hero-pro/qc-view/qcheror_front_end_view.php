<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


function qcld_slider_front_end($_id,$_slider, $_slide, $atts) {


	
	ob_start();
	if(!function_exists('deleteSpacesNewlines')) {
		function deleteSpacesNewlines($str) {
			return preg_replace(array('/\r/', '/\n/'), '',$str);
		}
	}
	
	$sliderID = intval($_slider[0]->id);
	$style = json_decode($_slider[0]->style);
	$params = json_decode($_slider[0]->params);
	$customs = json_decode($_slider[0]->custom);
	$title = $_slider[0]->title;
	$bg_image_url = $_slider[0]->bg_image_url;
	
	$description = $params->description;
	$paramsJson = deleteSpacesNewlines($_slider[0]->params);
	$styleJson = deleteSpacesNewlines($_slider[0]->style);
	$customJson = deleteSpacesNewlines($_slider[0]->custom);
	
	if(isset($params->onlyonce) && $params->onlyonce==1){
		
		$cookie_name = 'hero_'.$_id;
		if(isset($_COOKIE[$cookie_name]) && $_COOKIE[$cookie_name]=='1'){
			return ob_get_clean();
		}

	}


	if(!$_slider) {
		return '<h3 style="color: #FF0011;">qcld_slider '.$_id.' does not exist</h3>';
		
	}
	if(!$sliderID) {
		return '<h3 style="color: #FF0011;">qcld_slider '.$_id.' was removed</h3>';
		
	}
	
require(QCLD_SLIDERHERO_VIEW.'/slider_hero_front_end_enque.php');
	

require(QCLD_SLIDERHERO_VIEW.'/slider_hero_front_end_google_font.php');

require(QCLD_SLIDERHERO_VIEW.'/slider_hero_front_end_style.php');

/*Ordering section*/
$odarr = array(
	'title'			=> str_replace('%','',$params->title->style->top),
	'description'	=> str_replace('%','',$params->description->style->top),
	'button'		=> str_replace('%','',$params->button1->style->top)
);

asort($odarr);

$preloader = get_option('sh_plugin_options');

if(isset($preloader['hero_enable_preloader_image']) and $preloader['hero_enable_preloader_image']!=''){
	$preloader_img = $preloader['hero_enable_preloader_image'];
}
if($atts['preloader']=='off'){
	$preloader['hero_enable_preloader'] = 'off';
}
if($atts['preloader']=='on'){
	$preloader['hero_enable_preloader'] = 'on';
}

?>

<?php if(isset($params->bgimageeffect) && $params->bgimageeffect=='parallax' && $bg_image_url!=''): ?>
<script src="<?php echo QCLD_SLIDERHERO_JS; ?>/parallax.js"></script>
<?php endif; ?>

<?php if(isset($preloader['hero_enable_preloader']) && $preloader['hero_enable_preloader']=='on' && $_slider[0]->type!='wormhole'): ?>

<div class="hero_preloader" style="background: #fff;width: 100%;height: 300px;z-index: 999;position: relative;display: flex;justify-content: center !important;align-items: center;">
<?php 
	if(!isset($preloader_img)){
	?>
		<div class="hero_loader"></div>
	<?php
	}else{
	?>
		<img style="width: 200px;height: auto;" src="<?php echo $preloader_img; ?>" alt="loading" />
	<?php
	}
?>


</div>

<?php endif; ?>


<div id="particles-js<?php echo intval($_id); ?>" <?php echo ($_slider[0]->type=='walkingbackground'?'class="slider_hero_walkingbackground qc_slider_hero_container"':'class="qc_slider_hero_container"'); ?> <?php echo (isset($preloader['hero_enable_preloader']) && $preloader['hero_enable_preloader']=='on' && $_slider[0]->type!='wormhole'?'style="display:none;"':''); ?> <?php if(isset($params->bgimageeffect) && $params->bgimageeffect=='parallax' && $bg_image_url!=''){ ?>data-parallax="scroll" data-position="top" data-bleed="10" data-image-src="<?php echo $bg_image_url; ?>" <?php } ?>>

<?php 
if(isset($params->video)&& $params->video=='youtube') {
	if(isset($params->bg_video_youtube)&& $params->bg_video_youtube!=''){
		echo '<div class="qcld_youtube_overlay"></div>';
	}
}
	
?>

<?php
	require(QCLD_SLIDERHERO_VIEW.'/slider_hero_front_end_top_decoration.php');
	require(QCLD_SLIDERHERO_VIEW.'/slider_hero_front_end_bottom_decoration.php');
	
	if(isset($params->bgimageeffect) && $params->bgimageeffect=='ken-burn' && $bg_image_url!=''){
		echo '<img src="'.$bg_image_url.'" alt="bg image ken burn effect" />';
	}
	
	
?>

<?php
	require(QCLD_SLIDERHERO_VIEW.'/slider_hero_front_end_effect_config.php');
?>

	<?php 
		$totalSlide = 0;
		$preimg = array();
		$coverimg = array();
	?>
	<?php foreach($_slide as $slide) : 

	if($slide->published=='1' and $slide->draft!='1') :
	$totalSlide++;
	$slide->title = hero_handle_variables( $slide->title );
	$slide->description = hero_handle_variables( $slide->description );

	?>
		<?php 
			if($_slider[0]->type=='play_or_work'):
		?>
			<div class="hg_welcomePop">
				<div class="qcld_hero_content_area">
				<?php
				require(QCLD_SLIDERHERO_VIEW.'/slider_hero_front_end_title_effect.php');
				?>
				
				<div class="slider-x-item-title slider-x-item-title<?php echo intval($_id); ?>"><?php echo apply_filters('the_content', wp_unslash(htmlspecialchars_decode($slide->description))); ?>
				</div>
				<?php require(QCLD_SLIDERHERO_VIEW.'/slider_hero_front_end_buttons.php');?>
			  
				</div>
			</div>
			<div class="hg_restartGamePop">
			  <div class="hg_textWrap">
				<h2>Continue...</h2>
				<div class="hg_cta hg_ctaRestartGame">Play again</div>
			  </div>
			</div>

			<div id="hg_stage">
			  <div id="hg_credits"><span>0</span> <p>credits</p></div>
			  <div id="hg_msg">Use your spacebar to keep me alive.</div>
			  <div id="hg_bird"><img src="<?php echo QCLD_SLIDERHERO_IMAGES; ?>/ufo.png" alt="" /></div>
			  
			</div>	
		<?php
			break;
			elseif($_slider[0]->type=='hero_404')://code for hero_404
		?>
		<div class="qcld_hero_content_area">
		<h2 class="hero_not_found"><span><?php echo wp_unslash( esc_js($slide->title)); ?></span></h2>
		
		<?php if(isset($params->hero404->title) and $params->hero404->title!=''): ?>
		<div class="hero_not_found_title"><?php echo apply_filters('the_content', wp_unslash(htmlspecialchars_decode($slide->description))); ?></div>
		<?php endif; ?>
		<?php require(QCLD_SLIDERHERO_VIEW.'/slider_hero_front_end_buttons.php');?>
		</div>
		
		<?php elseif($_slider[0]->type=='intro'): 
				
				if($slide->stomp!=''){
					$config = json_decode(wp_unslash(htmlspecialchars_decode($slide->stomp)));
				}else{
					$config = '';
				}
		?>
			<div class="eachAnim" data-id="<?php echo $slide->ordering; ?>" data-animtype="<?php echo (isset($config->hero_stomp_animation) && $config->hero_stomp_animation!=''?$config->hero_stomp_animation:'zoomIn'); ?>" data-animout="<?php echo (isset($config->hero_stomp_animation_out) && $config->hero_stomp_animation_out!=''?$config->hero_stomp_animation_out:'zoomOut'); ?>" data-delay="<?php echo (isset($config->hero_stomp_delay) && $config->hero_stomp_delay!=''?$config->hero_stomp_delay:'500'); ?>" 
			data-fontsize="<?php echo (isset($config->hero_stomp_fontsize) && $config->hero_stomp_fontsize!=''?$config->hero_stomp_fontsize:''); ?>" data-fontweight="<?php echo (isset($config->hero_stomp_font_weight) && $config->hero_stomp_font_weight!=''?$config->hero_stomp_font_weight:''); ?>" data-letterspacing="<?php echo (isset($config->hero_stomp_letter_spacing) && $config->hero_stomp_letter_spacing!=''?$config->hero_stomp_letter_spacing:''); ?>" data-color="<?php echo (isset($config->hero_stomp_text_color) && $config->hero_stomp_text_color!=''?$config->hero_stomp_text_color:''); ?>" style="display:none;<?php echo (isset($slide->image_link) && $slide->image_link!=''?'background:url('.$slide->image_link.')no-repeat':''); ?>;<?php echo (isset($config->hero_stomp_background_color)&&$config->hero_stomp_background_color!=''?'background-color:'.$config->hero_stomp_background_color:''); ?>" data-fontfamily="<?php echo (isset($config->hero_intro_font_family)&&$config->hero_intro_font_family!=''?$config->hero_intro_font_family:''); ?>">
				<?php echo wp_unslash(($slide->title)); ?>
			</div>
			
			
		<?php else: ?>
		<?php 
		
		if(isset($slide->image_link) && $slide->image_link!=''){
			$preimg[] = $slide->image_link;
		}
		if(isset($slide->cover) && $slide->cover!=''){
			$coverimg[] = $slide->cover;
		}
		?>
		<div class="qcld_hero_content_area" <?php echo (isset($slide->image_link)&&$slide->image_link!=''?'data-bg-image="'.$slide->image_link.'"':'data-bg-image=""') ?> <?php echo (isset($slide->cover)&&$slide->cover!=''?'data-cover-image="'.$slide->cover.'"':'data-cover-image=""') ?> style="display:none;">
		
			<?php if($_slider[0]->type=='no_effect' && isset($slide->slide_link) && $slide->slide_link!=''){ ?>
			
				<a href="<?php echo $slide->slide_link; ?>" class="qchero_slide_link_whole"></a> 
			
			<?php } ?>
			<?php 
			
			
			
				foreach($odarr as $key=>$val ){
					if($key=='title'){
						require(QCLD_SLIDERHERO_VIEW.'/slider_hero_front_end_title_effect.php');
					}elseif($key=='description'){
					?>
						<div class="slider-x-item-title slider-x-item-title<?php echo intval($_id); ?>">
							<?php echo wp_unslash(htmlspecialchars_decode($slide->description)); ?>
						</div>
					<?php
					}else{
						require(QCLD_SLIDERHERO_VIEW.'/slider_hero_front_end_buttons.php');
					}
				}
				
			?>
			
			
			
		</div> <!--End of hero Content Area-->
		<?php endif; ?>
	<?php 
	endif; // is slide published
	endforeach;
	
	require(QCLD_SLIDERHERO_VIEW.'/slider_hero_front_end_audio.php');
	
	if($_slider[0]->type=='intro'){
		?>
		<div class="hero_restart_button">
			<?php if(isset($params->herorestart) and $params->herorestart==0): ?>
			<span id="hero_restart_button"><i class="fa fa-repeat" aria-hidden="true"></i></span>
			<?php endif; ?>
			
			<?php if(isset($params->heropause) and $params->heropause==0): ?>
			<span id="hero_pause_button"><i class="fa fa-pause" aria-hidden="true"></i></span>
			<span id="hero_play_button" style="display:none;"><i class="fa fa-play" aria-hidden="true"></i></span>
			<?php endif; ?>
		</div>
		<?php 
	}

	?>
	
<?php if($_slider[0]->type=='video' && !empty($preimg) && @$params->show_video_popup!='1'):?>

<div class="sh_bg_video">
	<div class="sh_bg_video_fluid" style="width: 100%;position: relative;padding: 0;padding-top: <?php echo ($style->screenoption=='2'?'56.5%':$style->height.'px'); ?>;">
		<video id="hero_vid<?php echo intval($_id); ?>" class="qc_hero_vid" preload="auto" <?php echo (isset($params->videoslide_loop)&& $params->videoslide_loop=='1'?'loop':''); ?> <?php echo (isset($params->videoslide_mute)&& $params->videoslide_mute=='1'?'muted':''); ?> style="margin: auto; position: absolute; z-index: -1; top: 50%; left: 50%; transform: translate(-50%, -50%); visibility: visible; opacity: 1; width: 100%; height: auto;">
			<source src="<?php echo $preimg[0]; ?>" >
		</video>
	</div>
</div>
<?php endif; ?>

<?php if($_slider[0]->type=='vimeo_video' && !empty($preimg) && @$params->show_video_popup!='1'):?>

<?php if(isset($params->cover_image_url) && $params->cover_image_url!=''): ?>

	<?php if(isset($params->show_cover_image) && $params->show_cover_image==1): ?>

		<div class="sh_video_preload" style="position: absolute;width:100%;height:100%;background-image: url('<?php echo esc_url($params->cover_image_url); ?>');background-size: cover;background-position: 50% 50%;background-repeat: no-repeat;z-index: 9999;display:block"></div>

	<?php elseif((isset($params->videoslide_mute) && $params->videoslide_mute==0) || (isset($params->video_mute) && $params->video_mute==0) ): ?>

		<div class="sh_video_preload" style="position: absolute;width:100%;height:100%;background-image: url('<?php echo esc_url($params->cover_image_url); ?>');background-size: cover;background-position: 50% 50%;background-repeat: no-repeat;z-index: 9999;display:block"></div>
		
	<?php endif; ?>
	
<?php endif; ?>

<div class="sh_vimeo_wrapper">
	
		<iframe allow="autoplay" src="https://player.vimeo.com/video/<?php echo $preimg[0]; ?>?<?php echo (isset($params->videoslide_mute)&& $params->videoslide_mute=='1'?'background=1&':''); ?>autoplay=<?php echo (isset($params->show_cover_image) && $params->show_cover_image!=1?1:0); ?><?php echo (isset($params->videoslide_loop)&& $params->videoslide_loop=='1'?'&loop=1':'&loop=0'); ?>&byline=0&title=0&quality=1080p" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
	
</div>

<?php endif; ?>

<?php if($_slider[0]->type=='youtube_video' && !empty($preimg) && @$params->show_video_popup!='1' ):?>
<script src="https://www.youtube.com/iframe_api"></script>

<?php if(isset($params->cover_image_url) && $params->cover_image_url!=''): ?>

	<?php if(isset($params->show_cover_image) && $params->show_cover_image==1): ?>

		<div class="sh_video_preload" style="position: absolute;width:100%;height:100%;background-image: url('<?php echo esc_url($params->cover_image_url); ?>');background-size: cover;background-position: 50% 50%;background-repeat: no-repeat;z-index: 9999;display:block"></div>

	<?php elseif((isset($params->videoslide_mute) && $params->videoslide_mute==0) || (isset($params->video_mute) && $params->video_mute==0) ): ?>

		<div class="sh_video_preload" style="position: absolute;width:100%;height:100%;background-image: url('<?php echo esc_url($params->cover_image_url); ?>');background-size: cover;background-position: 50% 50%;background-repeat: no-repeat;z-index: 9999;display:block"></div>
		
	<?php endif; ?>
	
<?php endif; ?>
<?php echo '<div class="qcld_youtube_overlay"></div>'; ?>
<div class="sh_bg_video sh_bg_video_y">
	<div class="sh_bg_video_fluid sh_bg_video_fluid_y" style="width: 100%;position: relative;padding: 0;padding-top: 56.5%;">
		<div id="hero_youtube_video"></div>
	</div>
</div>
<script type="text/javascript">
var player;
function onYouTubeIframeAPIReady() {
    player = new YT.Player('hero_youtube_video', {
        width: 600,
        height: 400,
        videoId: '<?php echo $preimg[0]; ?>',
        playerVars: {
            color: 'white',
			autoplay: <?php echo (isset($params->show_cover_image) && $params->show_cover_image!=1?1:0); ?>,
			controls: 0,
			rel: 0,
			showinfo: 0,
			<?php if(isset($params->videoslide_loop)&& $params->videoslide_loop=='1'){ ?>
			loop: 1,
			playlist: '<?php echo $preimg[0]; ?>',
			<?php }else{ ?>
			loop: 0,
			<?php } ?>
			modestbranding: 1,
			<?php if(isset($params->videoslide_mute)&& $params->videoslide_mute=='1'){ ?>
			mute: 1
			<?php }else{ ?>
			mute: 0
			<?php } ?>
        },
		
        events: {
            onReady: initialize,
			onStateChange: onPlayerStateChange
        }
    });
}
function initialize(event){
	player.setPlaybackQuality('hd1080');
	<?php if(@$params->show_cover_image!=1): ?>
	event.target.playVideo();
	<?php endif; ?>
}

var herocounter<?php echo intval($_id);  ?> = 0;
function onPlayerStateChange(event) {

	if(herocounter<?php echo intval($_id);  ?> == 0){
		setTimeout(function(){
			herocounter<?php echo intval($_id);  ?>++;
			console.log(player.getPlayerState());
			if(player.getPlayerState() > 0){
				//jQuery(".hero_play_video_button").fadeOut();
				//jQuery(".sh_video_preload").fadeOut();
			}else{
				jQuery("#hero_ge_pause_button<?php echo intval($_id); ?>").click();
			}
		}, 100)
	}
	
}

jQuery(window).on( 'load', function($){
	
	iframeHeight = jQuery('#hero_youtube_video').height();
	containerHeight = jQuery('#particles-js<?php echo intval($_id); ?>').height();
	actualHeight = (iframeHeight - containerHeight)/2;
	jQuery('.sh_bg_video_fluid> iframe').css({'top': '-'+actualHeight+'px'});
	
	setInterval( function() {
		if ( jQuery( ".qcld_youtube_overlay" ).length > 0 ) {
			if ( player.getPlayerState() == 1 ) {
				jQuery( ".qcld_youtube_overlay" ).css( "background-color", "rgb(0, 0, 0, 0)" );
			} else {
				jQuery( ".qcld_youtube_overlay" ).css( "background-color", "rgb(25 69 112 / 98%)" );
			}
		}
	}, 10);

})

</script>
<?php endif; ?>

	<?php require(QCLD_SLIDERHERO_VIEW.'/slider_hero_front_end_script.php') ?>

</div>

<?php if( isset( $params->content_display_bottom ) && ( $params->content_display_bottom == 1 || $params->content_display_bottom == 2 ) ): ?>
<div id="hero-mobilecontent<?php echo intval($_id); ?>" class="hero-mobilecontent"></div>
<?php endif; ?>


<?php 

if(!empty($preimg) && $_slider[0]->type!='video' && !empty($preimg) && $_slider[0]->type!='youtube_video' && !empty($preimg) && $_slider[0]->type!='vimeo_video'){
	foreach($preimg as $preimageloaded){
		echo '<div style="background-image:url('.$preimageloaded.');position:absolute;left:-999px;width:2px;height:2px;z-index:-999"></div>';
	}
} 

if(!empty($coverimg)){
	foreach($coverimg as $cover){
		echo '<div style="background-image:url('.$cover.');position:absolute;left:-999px;width:2px;height:2px;z-index:-999"></div>';
	}
} 

if(isset($params->cover_image_url) && $params->cover_image_url!=''){
	echo '<div style="background-image:url('.$params->cover_image_url.');position:absolute;left:-999px;width:2px;height:2px;z-index:-999"></div>';
}

if($_slider[0]->type=='video' && !empty($preimg) ):?>
	<?php foreach($preimg as $preimageloaded){ ?>
	<div class="sh_video_preload" style="position:absolute;left:-999px;width:2px;height:2px;z-index:-999;display:block">
		<video preload="auto" muted style="position:absolute;left:-999px;width:2px;height:2px;z-index:-999;">
			<source src="<?php echo $preimageloaded; ?>" >
		</video>
	</div>
	<?php } ?>
<?php
endif;

?>



<?php 
if($_slider[0]->type=='intro' and isset($params->newsliderafterend) and $params->newsliderafterend!=''){
	echo '<div class="second_div_hero" style="visibility:hidden;position:absolute;z-index:-9999999;top:0px;left:0px;width:100%;height:100%;">'.do_shortcode("[qcld_hero id=".$params->newsliderafterend."]").'</div>'; 
}
?>

<?php
	$content = ob_get_clean();
	$content = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $content);
	return $content;
}
