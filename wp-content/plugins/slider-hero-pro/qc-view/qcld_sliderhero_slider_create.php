<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly


function qcld_sliderhero_sliders_type() { 
$effects = array(
'No Effect','Intro Builder','Aeronautics Effect','Antigravity Flow','Balls &amp; Gravity Effect','Bird Flying Effect','Blob Effect','Blade Effect','Blur Effect','Bubble','Campfire','Circle Circle Intersection','Cloudy Sky Effect','Confetti Effect','Cosmic Web','Colorful Particle','Cursor And Paint','Day Night Effect','Division Effect','Directional Force','Distance','Electric Clock','Firework','Fizzy Sparks','Float and Rain','Floating Leafs','Flowing Circle Effect','Flying Rocket Effect','Grid Effect','Helix Corruption','Helix Chaos','Helix Multiple','Glitch','Iconsahedron Effect','Intersecting Line Effect','Just Cloud','Link Particle','Liquid Landscape','Matrix Effect','Metaballs','Microcosm Effect','Moving Color Wave','NASA','Neno Hexagon','Noise Effect','Nyan Cat','Orbital Effect','Particle Effect','Particle Helix','Particle System','Hacker','Physics Bug','Racing Particles','Rain Effect','Rainy Season','Rays and Particles','Play or Work?','Rain Of Line','Rising and falling cubes','Shape Animation','Space Elevator','Snow Effect','Squidematics','Stars Effect','Stellar Cloud','Subvisual','Tag Canvas','The Great Attractor','Thibaut','Tiny Galaxy Effect','Torus of Cubes','Water Effect','Wave Effect','Wave Animation Effect','Waaave Canvas','Walking Background','Warp Speed','Water Swimming','Waving Cloth','Water Droplet','Wormhole Effect','Word Cloud','Valentine Effect','Ygekpg Effect',
);
?>

	<div class="qchero_sliders_list_wrapper">
		<div class="sliderhero_menu_title">
			<h2 style="font-size: 26px;">Slider-Hero</h2>
		</div>
		<p class="hero_create_slider_header">Choose an Effect to Start Creating a New Slider. Choose <strong>"No Effect"</strong> if You Want a Simple Image Slider or only Video Background.</p>
		
		<div class="form_wrapper_sliderhero">
			
			<div class="hero-intro-effect">
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=intro'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/intro_effect.jpg' ?>" alt="Intro Builder" />
					
				</a>
			</div>
			<div class="effect_selection_area" style="clear:both;float:none;display:table;height: 195px;
    margin: 0 auto;">
			
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=video'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/custom_video.png' ?>" alt="Video" />
					<p>Custom Video Slider</p>
				</a>
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=youtube_video'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/youtube_video.png' ?>" alt="Youtube Video" />
					<p>Youtube Video Slider</p>
				</a>
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=vimeo_video'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/vimeo_video.png' ?>" alt="Vimeo Video" />
					<p>Vimeo Video Slider</p>
				</a>
			
			</div>
			<div class="effect_selection_area">

				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=no_effect'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/no-effect.jpg' ?>" alt="No Effect" />
					<p>No Effect</p>
				</a>
				
				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=aeronautics'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/aeronautics.jpg' ?>" alt="Aeronautics Effect" />
					<p>Aeronautics Effect</p>
				</a>				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=antigravity'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/antigravity.jpg' ?>" alt="Antigravity Flow" />
					<p>Antigravity Flow</p>
				</a>
				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=animated_cloud'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/animated_cloud.jpg' ?>" alt="Animated Cloud" />
					<p>Animated Cloud</p>
				</a>
				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=atom'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/atom.jpg' ?>" alt="Atom Effect" />
					<p>Atom Effect</p>
				</a>
				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=ballsgravity'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/ballsgravity.jpg' ?>" alt="Balls & Gravity Effect" />
					<p>Balls & Gravity Effect</p>
				</a>
				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=bird'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/bird.png' ?>" alt="Bird Flying Effect" />
					<p>Bird Flying Effect</p>
				</a>
				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=blob'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/blob.jpg' ?>" alt="Blob Effect" />
					<p>Blob Effect</p>
				</a>
				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=blade'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/glitch.jpg' ?>" alt="Blade Effect" />
					<p>Blade Effect</p>
				</a>
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=blur'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/blur.jpg' ?>" alt="Blur Effect" />
					<p>Blur Effect</p>
				</a>
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=particle_bubble'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/bubble.jpg' ?>" alt="Bubble" />
					<p>Bubble</p>
				</a>
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=campfire'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/campfire.jpg' ?>" alt="Campfire" />
					<p>Campfire</p>
				</a>
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=circle'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/circle.jpg' ?>" alt="Circle Circle Intersection" />
					<p>Circle Circle Intersection</p>
				</a>
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=cloudysky'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/cloudysky.jpg' ?>" alt="Cloudy Sky Effect" />
					<p>Cloudy Sky Effect</p>
				</a>				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=confetti'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/confetti.jpg' ?>" alt="Confetti Effect" />
					<p>Confetti Effect</p>
				</a>
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=cosmic_web'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/cosmic_web.jpg' ?>" alt="Cosmic Web" />
					<p>Cosmic Web</p>
				</a>				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=colorful_particle'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/colorful_particle.jpg' ?>" alt="Colorful Particle" />
					<p>Colorful Particle</p>
				</a>
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=cube_animation'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/cubes_animation.jpg' ?>" alt="Cubes Animation" />
					<p>Cubes Animation</p>
				</a>
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=cursorandpaint'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/cursorandpaint.jpg' ?>" alt="Cursor And Paint" />
					<p>Cursor And Paint</p>
				</a>
				
				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=daynight'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/daynight.jpg' ?>" alt="Day Night Effect" />
					<p>Day Night Effect</p>
				</a>
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=division'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/division.jpg' ?>" alt="Division Effect" />
					<p>Division Effect</p>
				</a>
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=directional'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/directional.jpg' ?>" alt="Directional Force" />
					<p>Directional Force</p>
				</a>
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=distance'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/distance.jpg' ?>" alt="Distance" />
					<p>Distance</p>
				</a>
				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=electric_clock'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/electric_clock.jpg' ?>" alt="Electric Clock" />
					<p>Electric Clock</p>
				</a>

				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=firework'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/firework.jpg' ?>" alt="Firework" />
					<p>Firework</p>
				</a>
				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=fizzy_sparks'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/fizzy_sparks.jpg' ?>" alt="Fizzy Sparks" />
					<p>Fizzy Sparks</p>
				</a>
				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=floatrain'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/floatrain.jpg' ?>" alt="Float and Rain" />
					<p>Float and Rain</p>
				</a>
				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=floatingleafs'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/floatingleafs.png' ?>" alt="Floating Leafs" />
					<p>Floating Leafs</p>
				</a>
				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=flowingcircle'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/flowingcircle.jpg' ?>" alt="Flowing Circle Effect" />
					<p>Flowing Circle Effect</p>
				</a>
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=flyingrocket'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/flyingrocket.jpg' ?>" alt="Flying Rocket Effect" />
					<p>Flying Rocket Effect</p>
				</a>

				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=grid'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/grid.jpg' ?>" alt="Grid Effect" />
					<p>Grid Effect</p>
				</a>

				
				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=corruption'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/corruption.jpg' ?>" alt="Helix Corruption" />
					<p>Helix Corruption</p>
				</a>
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=chaos'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/chaos.jpg' ?>" alt="Helix Chaos" />
					<p>Helix Chaos</p>
				</a>
				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=helix_multiple'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/helix_multiple.jpg' ?>" alt="Helix Multiple" />
					<p>Helix Multiple</p>
				</a>
				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=hero_404'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/hero_404.jpg' ?>" alt="Glitch" />
					<p>Glitch</p>
				</a>

				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=iconsahedron'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/iconsahedron.jpg' ?>" alt="Iconsahedron Effect" />
					<p>Iconsahedron Effect</p>
				</a>
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=line'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/line.jpg' ?>" alt="Intersecting Line Effect" />
					<p>Intersecting Line Effect</p>
				</a>
				
				

				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=just_cloud'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/just_cloud.jpg' ?>" alt="Just Cloud" />
					<p>Just Cloud</p>
				</a>

				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=link_particle'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/link_particle.jpg' ?>" alt="Link Particle" />
					<p>Link Particle</p>
				</a>
				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=liquid_landscape'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/liquid_landscape.jpg' ?>" alt="Liquid Landscape" />
					<p>Liquid Landscape</p>
				</a>

				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=matrix'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/matrix.jpg' ?>" alt="Matrix Effect" />
					<p>Matrix Effect</p>
				</a>
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=metaballs'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/metaballs.jpg' ?>" alt="Metaballs" />
					<p>Metaballs</p>
				</a>
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=microcosm'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/microcosm.jpg' ?>" alt="Microcosm Effect" />
					<p>Microcosm Effect</p>
				</a>
				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=svg_animation'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/svg_animation.jpg' ?>" alt="Moving Color Wave" />
					<p>Moving Color Wave</p>
				</a>

				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=particle_nasa'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/nasa.jpg' ?>" alt="NASA" />
					<p>NASA</p>
				</a>				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=neno_hexagon'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/neno_hexagon.jpg' ?>" alt="Neno Hexagon" />
					<p>Neno Hexagon</p>
				</a>

				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=noise_effect'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/noise_particle.jpg' ?>" alt="Noise Effect" />
					<p>Noise Effect</p>
				</a>
				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=nyan_cat'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/nyan_cat.jpg' ?>" alt="Nyan Cat" />
					<p>Nyan Cat</p>
				</a>

				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=orbital'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/orbital.jpg' ?>" alt="Orbital Effect" />
					<p>Orbital Effect</p>
				</a>

				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=particle'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/default.jpg' ?>" alt="Particle Effect" />
					<p>Particle Effect</p>
				</a>
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=helix'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/helix.jpg' ?>" alt="Particle Helix" />
					<p>Particle Helix</p>
				</a>
				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=particle_system'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/particle_system.jpg' ?>" alt="Particle System" />
					<p>Particle System</p>
				</a>
				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=pretend_hacker'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/pretent_hacker.jpg' ?>" alt="Hacker" />
					<p>Hacker</p>
				</a>
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=physics_bug'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/physics_bug.jpg' ?>" alt="Physics Bug" />
					<p>Physics Bug</p>
				</a>
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=racing_particles'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/racing_particles.jpg' ?>" alt="Racing Particles" />
					<p>Racing Particles</p>
				</a>
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=rain'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/rain.jpg' ?>" alt="Rain Effect" />
					<p>Rain Effect</p>
				</a>
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=rainy_season'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/rainy_season.jpg' ?>" alt="rainy_season" />
					<p>Rainy Season</p>
				</a>
				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=rays_particles'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/rays_particles.jpg' ?>" alt="Rays and Particles" />
					<p>Rays and Particles</p>
				</a>
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=ripples'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/ripples.jpg' ?>" alt="Ripples" />
					<p>Ripples Effect</p>
				</a>
				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=play_or_work'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/hero_game.jpg' ?>" alt="Play or Work?" />
					<p>Play or Work?</p>
				</a>

				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=rainofline'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/rainofline.jpg' ?>" alt="Rain Of Line" />
					<p>Rain Of Line</p>
				</a>
				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=rising_cubes'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/rising_cubes.jpg' ?>" alt="Rising and falling cubes" />
					<p>Rising and falling cubes</p>
				</a>

				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=shapeanimation'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/shapanimation.jpg' ?>" alt="Shape Animation" />
					<p>Shape Animation</p>
				</a>
				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=space_elevator'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/space_elevator.jpg' ?>" alt="Space Elevator" />
					<p>Space Elevator</p>
				</a>
				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=particle_snow'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/snow.jpg' ?>" alt="Snow Effect" />
					<p>Snow Effect</p>
				</a>				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=squidematics'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/squidematics.jpg' ?>" alt="Squidematics" />
					<p>Squidematics</p>
				</a>	
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=stars'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/stars.jpg' ?>" alt="Stars Effect" />
					<p>Stars Effect</p>
				</a>				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=stellar'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/stellar.jpg' ?>" alt="Stellar Cloud" />
					<p>Stellar Cloud</p>
				</a>
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=stripe-cube'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/stripe-cube.jpg' ?>" alt="Stripe Cude Effect" />
					<p>Stripe Cube Effect</p>
				</a>
				
				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=subvisual'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/subvisual.png' ?>" alt="Subvisual" />
					<p>Subvisual</p>
				</a>
				

				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=tagcanvas'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/tagcanvas.jpg' ?>" alt="Tag Canvas" />
					<p>Tag Canvas</p>
				</a>
				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=the_great_attractor'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/the_great_attractor.jpg' ?>" alt="The Great Attractor" />
					<p>The Great Attractor</p>
				</a>
				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=thibaut'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/thibaut.jpg' ?>" alt="Thibaut" />
					<p>Thibaut</p>
				</a>
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=tiny_galaxy'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/tiny_galaxy.jpg' ?>" alt="Tiny Galaxy Effect" />
					<p>Tiny Galaxy Effect</p>
				</a>
				

				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=water'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/water.jpg' ?>" alt="Water Effect" />
					<p>Water Effect</p>
				</a>
				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=wave'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/wave.jpg' ?>" alt="Wave Effect" />
					<p>Wave Effect</p>
				</a>
				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=wave_animation'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/wave_animation.jpg' ?>" alt="Wave Animation Effect" />
					<p>Wave Animation Effect</p>
				</a>
				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=waaave'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/waaave.jpg' ?>" alt="Waaave Canvas" />
					<p>Waaave Canvas</p>
				</a>
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=walkingbackground'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/walkingbg.jpg' ?>" alt="Walking Background" />
					<p>Walking Background</p>
				</a>
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=warp_speed'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/wrap_speed.jpg' ?>" alt="Wrap Speed" />
					<p>Warp Speed</p>
				</a>
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=water_swimming'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/water_swimming.jpg' ?>" alt="Water Swimming" />
					<p>Water Swimming</p>
				</a>
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=waving_cloth'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/waving_cloth.jpg' ?>" alt="Waving Cloth" />
					<p>Waving Cloth</p>
				</a>
				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=waterdroplet'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/waterdroplet.jpg' ?>" alt="Water Droplet" />
					<p>Water Droplet</p>
				</a>
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=wormhole'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/wormhole.jpg' ?>" alt="Wormhole Effect" />
					<p>Wormhole Effect</p>
				</a>
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=wordcloud'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/wordcloud.jpg' ?>" alt="Word Cloud" />
					<p>Word Cloud</p>
				</a>

				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=valentine'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/valentine.jpg' ?>" alt="Valentine Effect" />
					<p>Valentine Effect</p>
				</a>
				
				<a href="<?php echo admin_url( 'admin.php?page=Slider-Hero&task=addslider&type=ygekpg'); ?>">
					<img src="<?php echo QCLD_SLIDERHERO_IMAGES.'/ygekpg.jpg' ?>" alt="Ygekpg Effect" />
					<p>Ygekpg Effect</p>
				</a>
				
								

			</div>			
		</div>

	</div>
	<?php
}

