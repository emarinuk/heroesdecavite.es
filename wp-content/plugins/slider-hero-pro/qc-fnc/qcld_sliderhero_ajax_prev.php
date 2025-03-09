<?php
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}
function qcld_show_preview_items_fnc(){
$id = sanitize_text_field($_POST['sid']);

global $wpdb;
$query   = $wpdb->prepare( "SELECT * FROM " . QCLD_TABLE_SLIDERS . " WHERE id = '%d' ", $id );
$_slider = $wpdb->get_results( $query );
$query   = $wpdb->prepare( "SELECT * FROM " . QCLD_TABLE_SLIDES . " WHERE sliderid = '%d' ORDER BY ordering DESC", $id );
$_slide = $wpdb->get_results( $query );
$_id = 0;
	if(!function_exists('deleteSpacesNewlines')) {
		function deleteSpacesNewlines($str) {
			return preg_replace(array('/\r/', '/\n/'), '',$str);
		}
	}
	if(!$_slider) {
		echo '<h3 style="color: #FF0011;">qcld_slider '.$_id.' does not exist</h3>';
		return;
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
	if(!$sliderID) {
		echo '<h3 style="color: #FF0011;">qcld_slider '.$_id.' was removed</h3>';
		return;
	}

/*Ordering section*/
$odarr = array(
	'title'			=> str_replace('%','',$params->title->style->top),
	'description'	=> str_replace('%','',$params->description->style->top),
	'button'		=> str_replace('%','',$params->button1->style->top)
);

asort($odarr);
?>

	<div id="sm-modal" class="slider_hero_modal">

		<!-- Modal content -->
		<div class="modal-content" style="width: 95%;">
			<span class="close"><?php _e( "X", 'Slider Hero' ); ?></span>
			<h3><?php _e( "Preview", 'Slider Hero' ); ?></h3>
			<hr/>
<?php 
require(QCLD_SLIDERHERO_VIEW.'/slider_hero_front_end_style.php');
?>
<style type="text/css">
#particles-js<?php echo intval($_id); ?>{
	width: 100% !important;
	height: 87vh !important;
	left: 0px !important;
	max-width:100% !important;
}
#threeD canvas{
	width:100% !important;
	height:450px !important;
}
#hero_tags{
	display:none;
}
</style>


<div id="particles-js<?php echo intval($_id); ?>" <?php echo ($_slider[0]->type=='walkingbackground'?'class="slider_hero_walkingbackground"':''); ?>>

<?php
	require(QCLD_SLIDERHERO_VIEW.'/slider_hero_front_end_effect_config.php');
?>

<?php if($_slider[0]->type=='hero_404'){?>

	<h2 class="hero_not_found"><span> Not Found</span></h2>
	<?php if(isset($params->hero404->title) and $params->hero404->title!=''): ?>
	<h3 class="hero_not_found_title"><?php echo $params->hero404->title; ?></h3>
	<?php endif; ?>
<?php
}else{
?>
<?php $totalSlide = 0; ?>
<?php foreach($_slide as $slide) : 

if($slide->published=='1' and $slide->draft!='1') :
$totalSlide++;
?>

	<?php 
		if($_slider[0]->type=='play_or_work'):
	?>
		<div class="hg_welcomePop">
		  
			<?php
			require(QCLD_SLIDERHERO_VIEW.'/slider_hero_front_end_title_effect.php');
			?>
			
			<div class="slider-x-item-title slider-x-item-title<?php echo intval($_id); ?>">
				<?php echo apply_filters('the_content', wp_unslash(htmlspecialchars_decode($slide->description))); ?>
			</div>
			<?php require(QCLD_SLIDERHERO_VIEW.'/slider_hero_front_end_buttons.php');?>
		  
		</div>
		<div class="hg_restartGamePop">
		  <div class="hg_textWrap">
			<h2>Continue...</h2>
			<div class="hg_cta hg_ctaRestartGame">Play again</div>
		  </div>
		</div>

		<div id="hg_stage">
		  <div id="hg_credits"><span>0</span> <p>credits</p></div>
		  
		  <div id="hg_bird"><img src="<?php echo QCLD_SLIDERHERO_IMAGES; ?>/ufo.png" alt="" /></div>
		  
		</div>	
	<?php elseif($_slider[0]->type=='intro'):
				
				if($slide->stomp!=''){
					$config = json_decode(wp_unslash(htmlspecialchars_decode($slide->stomp)));
				}else{
					$config = '';
				}
		?>
			<div class="eachAnim" data-id="<?php echo $slide->ordering; ?>" data-animtype="<?php echo (isset($config->hero_stomp_animation) && $config->hero_stomp_animation!=''?$config->hero_stomp_animation:'zoomIn'); ?>" data-delay="<?php echo (isset($config->hero_stomp_delay) && $config->hero_stomp_delay!=''?$config->hero_stomp_delay:'500'); ?>" 
			data-fontsize="<?php echo (isset($config->hero_stomp_fontsize) && $config->hero_stomp_fontsize!=''?$config->hero_stomp_fontsize:''); ?>" data-fontweight="<?php echo (isset($config->hero_stomp_font_weight) && $config->hero_stomp_font_weight!=''?$config->hero_stomp_font_weight:''); ?>" data-letterspacing="<?php echo (isset($config->hero_stomp_letter_spacing) && $config->hero_stomp_letter_spacing!=''?$config->hero_stomp_letter_spacing:''); ?>" data-color="<?php echo (isset($config->hero_stomp_text_color) && $config->hero_stomp_text_color!=''?$config->hero_stomp_text_color:''); ?>" style="display:none;<?php echo (isset($slide->image_link) && $slide->image_link!=''?'background:url('.$slide->image_link.')no-repeat':''); ?>;<?php echo (isset($config->hero_stomp_background_color)&&$config->hero_stomp_background_color!=''?'background-color:'.$config->hero_stomp_background_color:''); ?>" data-fontfamily="<?php echo (isset($config->hero_intro_font_family)&&$config->hero_intro_font_family!=''?$config->hero_intro_font_family:''); ?>">
				<?php echo wp_unslash($slide->title); ?>
			</div>
			
		<?php elseif($_slider[0]->type=='hero_404'): ?>
		<div class="qcld_hero_content_area">
		<h2 class="hero_not_found"><span><?php echo wp_unslash( esc_js($slide->title)); ?></span></h2>
		
		<?php if(isset($params->hero404->title) and $params->hero404->title!=''): ?>
		<div class="hero_not_found_title"><?php echo apply_filters('the_content', wp_unslash(htmlspecialchars_decode($slide->description))); ?></div>
		<?php endif; ?>
		<?php require(QCLD_SLIDERHERO_VIEW.'/slider_hero_front_end_buttons.php');?>
		</div>
		<?php else: ?>
		<?php 
		
		if(isset($slide->image_link) && $slide->image_link!=''){
			$preimg[] = $slide->image_link;
		}
		?>
	<div class="qcld_hero_content_area" <?php echo (isset($slide->image_link)&&$slide->image_link!=''?'data-bg-image="'.$slide->image_link.'"':'data-bg-image=""') ?>>
	
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
	<?php 
		endif;
	?>
	
<?php 
endif;
endforeach;
require(QCLD_SLIDERHERO_VIEW.'/slider_hero_front_end_audio.php');
?>
<?php
}
 ?>
 
 
<?php if($_slider[0]->type=='video' && !empty($preimg)):?>

<div class="sh_bg_video">
	<div class="sh_bg_video_fluid" style="width: 100%;position: relative;padding: 0;padding-top: <?php echo ($style->screenoption=='2'?'56.5%':$style->height.'px'); ?>;">
		<video id="hero_vid<?php echo intval($_id); ?>" class="qc_hero_vid" autoplay preload="auto" <?php echo (isset($params->videoslide_loop)&& $params->videoslide_loop=='1'?'loop':''); ?> <?php echo (isset($params->videoslide_mute)&& $params->videoslide_mute=='1'?'muted':''); ?> style="margin: auto; position: absolute; z-index: -1; top: 50%; left: 50%; transform: translate(-50%, -50%); visibility: visible; opacity: 1; width: 100%; height: auto;">
			<source src="<?php echo $preimg[0]; ?>" >
		</video>
	</div>
</div>
<?php endif; ?>

<?php if($_slider[0]->type=='vimeo_video' && !empty($preimg)):?>

<div class="sh_vimeo_wrapper">
	
		<iframe src="https://player.vimeo.com/video/<?php echo $preimg[0]; ?>?<?php echo (isset($params->videoslide_mute)&& $params->videoslide_mute=='1'?'background=1&':''); ?>autoplay=1<?php echo (isset($params->videoslide_loop)&& $params->videoslide_loop=='1'?'&loop=1':'&loop=0'); ?>&byline=0&title=0" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
	
</div>

<?php endif; ?>

<?php if($_slider[0]->type=='youtube_video' && !empty($preimg)):?>
<script src="https://www.youtube.com/iframe_api"></script>
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
			autoplay: 1,
			controls: 0,
			rel: 0,
			showinfo: 0,
			<?php if(isset($params->videoslide_loop)&& $params->videoslide_loop=='1'){ ?>
			loop: 1,
			<?php echo $preimg[0]; ?>
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
	event.target.playVideo();
}

function onPlayerStateChange(event) {
	//console.log(player.getPlayerState())
}

jQuery(window).on( 'load', function($){
	
	iframeHeight = jQuery('#hero_youtube_video').height();
	containerHeight = jQuery('#particles-js<?php echo intval($_id); ?>').height();
	actualHeight = (iframeHeight - containerHeight)/2;
	jQuery('.sh_bg_video_fluid> iframe').css({'top': '-'+actualHeight+'px'});
	
})

</script>
<?php endif; ?>
 
<?php require(QCLD_SLIDERHERO_VIEW.'/slider_hero_front_end_script.php') ?>
</div>





<!--Scripting Area for Preview-->
<?php if($_slider[0]->type=='water_swimming') : //Water Swimming Script ?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/water_swimming.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>



<?php if($_slider[0]->type=='water') : //Water Script ?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/watereffect.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='particle_system') : //Particle System Script ?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/particle_system.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='space_elevator') : //Space Elevator Script ?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/qcmax.js?time=".time(); ?>" type="text/javascript"></script>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/space_elevator.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>


<?php if($_slider[0]->type=='noise_effect') : //Particle System Script ?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/three.min.js?time=".time(); ?>" type="text/javascript"></script>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/simplex-noise.min.js?time=".time(); ?>" type="text/javascript"></script>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/noise_effect.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='rainofline') : // Rain Of Line Script ?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/rainofline.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>


<?php if($_slider[0]->type=='floatingleafs') : //floatingleafs Script?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/floatingleafs_admin.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>


<?php if($_slider[0]->type=='subvisual') : //subvisual Script?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/tweenlite.js?time=".time(); ?>" type="text/javascript"></script>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/attrplugin.js?time=".time(); ?>" type="text/javascript"></script>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/cssplugin.js?time=".time(); ?>" type="text/javascript"></script>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/subvisual.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>


<?php if($_slider[0]->type=='cosmic_web') : //Cosmic Web Script?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/cosmic_web.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='bird') : //Cosmic Web Script?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/bird_custom.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='neno_hexagon') : //Neno Hexagon Script?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/neon_hexagon.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='thibaut') : //Thibaut Script?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/thibaut.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='cursorandpaint') : //Cursor And Paint Script?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/cursorandpaint.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='stellar') : //Stellar Script?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/stellar.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='squidematics') : //Squidematics Script?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/squidematics.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='helix_multiple') : //helix_multiple Script?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/easel.js?time=".time(); ?>" type="text/javascript"></script>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/helix_multiple.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='chaos') : //chaos Script?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/easel.js?time=".time(); ?>" type="text/javascript"></script>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/chaos.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='corruption') : //corruption Script?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/easel.js?time=".time(); ?>" type="text/javascript"></script>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/corruption.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='helix') : //helix Script?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/easel.js?time=".time(); ?>" type="text/javascript"></script>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/helix.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='wordcloud') : //wordcloud Script?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/wordcloud.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='tagcanvas') : //tagcanvas Script?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/tagcanvas.min.js?time=".time(); ?>" type="text/javascript"></script>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/tagcanvas.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='aeronautics') : //aeronautics Script problem?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/aeronautics.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='flyingrocket') : //flyingrocket Script?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/flyingrocket.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='matrix') : //matrix Script problem?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/matrix.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='orbital') : //orbital Script?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/orbital.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='valentine') : //valentine Script?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/valentine.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='ygekpg') : //ygekpg Script Problem?>
	<script src="<?php echo QCLD_SLIDERHERO_JS . "/ygekpg.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='division') : //division Script ?>

<script src="<?php echo QCLD_SLIDERHERO_JS . "/division.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='grid') : //grid Script ?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/grid_line.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='flowingcircle') : //flowingcircle Script ?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/perlin.js?time=".time(); ?>" type="text/javascript"></script>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/flowingcircle.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='line') : //line Script ?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/line.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='iconsahedron') : //iconsahedron Script ?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/pixi.js?time=".time(); ?>" type="text/javascript"></script>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/iconsahedron.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>


<?php if($_slider[0]->type=='rain') : //rain Script Problem?>

<script src="<?php echo QCLD_SLIDERHERO_JS . "/rain.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='shapeanimation') : //shapeanimation Script?>

<script src="<?php echo QCLD_SLIDERHERO_JS . "/shapeanimation.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='ballsgravity') : //ballsgravity Script?>

<script src="<?php echo QCLD_SLIDERHERO_JS . "/matter.js?time=".time(); ?>" type="text/javascript"></script>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/ballsgravity.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='microcosm') : //microcosm Script?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/pixi.js?time=".time(); ?>" type="text/javascript"></script>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/microcosm.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='circle') : //microcosm Script?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/circle.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='waaave') : //microcosm Script?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/pixi.js?time=".time(); ?>" type="text/javascript"></script>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/waaave.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='metaballs') : //metaballs Script ?>

<script src="<?php echo QCLD_SLIDERHERO_JS . "/metaballs.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='wave') : //Wave Script ?>

<script src="<?php echo QCLD_SLIDERHERO_JS . "/wave.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>


<?php if($_slider[0]->type=='cube_animation') : //torus Script ?>
	<script src="<?php echo QCLD_SLIDERHERO_JS . "/cubes_animation.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='antigravity') : //antigravity Script ?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/antigravity.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='directional') : //directional Script problem?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/directional.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='physics_bug') : //physics_bug Script?>

<script src="<?php echo QCLD_SLIDERHERO_JS . "/physics_bug.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='distance') : //distance Script?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/distance.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='daynight') : //daynight Script?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/cloudeffect.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='floatrain') : //floatrain Script?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/float_rain.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='rain') : //rain Script?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/rain.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='tiny_galaxy') : //tiny_galaxy Script?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/tiny_galaxy.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='warp_speed') : //wrap_speed Script?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/wrap_speed.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='play_or_work') : //Hero Game ?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/hero_game.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='colorful_particle') : //Colorful Particle ?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/colorful_particle.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='waving_cloth') : //waving Cloth ?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/waving_cloth.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='link_particle') : //Linked Particle ?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/underscore-min.js?time=".time(); ?>" type="text/javascript"></script>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/link_particle.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='just_cloud') : //Just Cloud ?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/qcmax.js?time=".time(); ?>" type="text/javascript"></script>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/just_cloud.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='rising_cubes') : //rising_cubes ?>

<script src="<?php echo QCLD_SLIDERHERO_JS . "/rising_cubes.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='waterdroplet') : //waterdroplet ?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/waterdroplet2.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='electric_clock') : //electric_clock ?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/electric_clock.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='liquid_landscape') : //liquid_landscape ?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/liquid_landscape.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='fizzy_sparks') : //fizzy_sparks ?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/qcmax.js?time=".time(); ?>" type="text/javascript"></script>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/imagesloaded.pkgd.min.js?time=".time(); ?>" type="text/javascript"></script>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/fizzy_sparks2.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='firework') : //firework ?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/firework.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='rays_particles') : //rays_particles ?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/perlin.js?time=".time(); ?>" type="text/javascript"></script>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/vector2.js?time=".time(); ?>" type="text/javascript"></script>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/rays_particles.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='racing_particles') : //racing_particles ?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/qcmax.js?time=".time(); ?>" type="text/javascript"></script>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/racing_particles.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='blob') : //blob ?>

<script src="<?php echo QCLD_SLIDERHERO_JS . "/blob_custom.js?time=".time(); ?>" type="text/javascript"></script>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/blob.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='hero_404') : //404 ?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/hero_404.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='pretend_hacker') : //404 ?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/pretent_hacker.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='rainy_season') : //Rainy Season ?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/rainy_season.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='ripples') : //ripples ?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/ripples.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='the_great_attractor') : //Header Banner ?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/the_great_attractor.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='intro') : ?>

	<?php if(isset($params->introbgeffect) && $params->introbgeffect=='matrix'){ ?>
		<script src="<?php echo QCLD_SLIDERHERO_JS . "/matrix.js?time=".time(); ?>" type="text/javascript"></script>
	<?php } ?>
	
	<?php if(isset($params->introbgeffect) && $params->introbgeffect=='warp_speed'){ ?>
		<script src="<?php echo QCLD_SLIDERHERO_JS . "/wrap_speed.js?time=".time(); ?>" type="text/javascript"></script>
	<?php } ?>
	
	<?php if(isset($params->introbgeffect) && $params->introbgeffect=='colorful_particle'){ ?>
		<script src="<?php echo QCLD_SLIDERHERO_JS . "/colorful_particle.js?time=".time(); ?>" type="text/javascript"></script>
	<?php } ?>
	
	<?php if(isset($params->introbgeffect) && $params->introbgeffect=='electric_clock'){ ?>
		<script src="<?php echo QCLD_SLIDERHERO_JS . "/electric_clock.js?time=".time(); ?>" type="text/javascript"></script>
	<?php } ?>
	
	<?php if(isset($params->introbgeffect) && $params->introbgeffect=='particle_system'){ ?>
		<script src="<?php echo QCLD_SLIDERHERO_JS . "/particle_system.js?time=".time(); ?>" type="text/javascript"></script>
	<?php } ?>
	
	<?php if(isset($params->introbgeffect) && $params->introbgeffect=='link_particle'){ ?>
		<script src="<?php echo QCLD_SLIDERHERO_JS . "/underscore-min.js?time=".time(); ?>" type="text/javascript"></script>
		<script src="<?php echo QCLD_SLIDERHERO_JS . "/link_particle.js?time=".time(); ?>" type="text/javascript"></script>
	<?php } ?>
	
<?php endif; ?>


<!-- there is some title Effect Js file -->

<?php if(isset($params->titleffect) and $params->titleffect=='hero_blur_effect'): //button_blur ?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/hero_button_blur.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if(isset($params->titleffect) and $params->titleffect=='hero_matrix'): //matrix ?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/hero_button_matrix.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if(isset($params->titleffect) and $params->titleffect=='hero_shuffle'): //hero_shuffle ?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/hero_shuffle.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if(isset($params->titleffect) and $params->titleffect=='hero_rearrange'): //hero_rearrange ?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/hero_rearrange.js?time=".time(); ?>" type="text/javascript"></script>
<?php endif; ?>

<?php if($_slider[0]->type=='ripples') : ?>
<script>
	try {
		$('#particles-js<?php echo intval($_id); ?>').ripples({
			resolution: 512,
			dropRadius: 15, //px
			perturbance: 0.04,
		});
	}
	catch (e) {
		$('.error').show().text(e);
	}
</script>
<?php endif; ?>



<!--End of Scripting Area for Preview-->
		</div>
	</div>
<?php
exit;
}
add_action( 'wp_ajax_qcld_show_preview_items', 'qcld_show_preview_items_fnc');
?>