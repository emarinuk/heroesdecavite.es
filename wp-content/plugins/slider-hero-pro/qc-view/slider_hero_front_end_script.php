<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit
?>
<?php if((isset($params->video) && $params->video == 'vimeo') || ($_slider[0]->type=='vimeo_video')): ?>
	<script src="https://player.vimeo.com/api/player.js"></script>
<?php endif; ?>
<script type="text/javascript">
function heroCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
<?php if(isset($params->onlyonce) && $params->onlyonce==1){ ?>

	heroCookie('<?php echo 'hero_'.$_id; ?>', '1', 30);

<?php } ?>




function heroisMobile(){
	var isMobile = false; //initiate as false
		// device detection
		if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
		|| /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) isMobile = true;
	
	return isMobile;
}
<?php if(isset($params->disableinmobile) && $params->disableinmobile==1): ?>
if(heroisMobile()==true){
	jQuery('.hero_preloader').remove();   
	jQuery('#particles-js<?php echo intval($_id); ?>').remove();
}
<?php endif; ?>

function getOffset1( el ) {
    var _x = 0;
    var _y = 0;
    while( el && !isNaN( el.offsetLeft ) && !isNaN( el.offsetTop ) ) {
        _x += el.offsetLeft - el.scrollLeft;
        _y += el.offsetTop - el.scrollTop;
        el = el.offsetParent;
    }
	_x = parseInt(_x) + parseInt(jQuery('#particles-js<?php echo intval($_id); ?>').parent().css('padding-left'));
    return { top: _y, left: _x };
}
	<?php if((isset($params->video) && $params->video == 'vimeo') || ($_slider[0]->type=='vimeo_video')): ?>
	//code for video video
	<?php if(!isset($params->show_video_popup) || $params->show_video_popup!='1'): ?>
		var iframe = document.querySelector('iframe');
		var vplayer = new Vimeo.Player(iframe);
	<?php endif; ?>

	<?php endif; ?>
	
  jQuery(document).ready(function($){
		<?php if(isset($preloader['hero_enable_preloader']) && $preloader['hero_enable_preloader']=='on'): ?>
		   jQuery('.hero_preloader').remove();
	   <?php endif; ?>
	   jQuery('#particles-js<?php echo intval($_id); ?>').show();
	   jQuery('#particles-js<?php echo intval($_id); ?> canvas').width(jQuery('#particles-js<?php echo intval($_id); ?>').width());
	   
	   <?php if(isset($params->content) && $params->content!='' && $params->content=='center'): ?>
			jQuery('#particles-js<?php echo intval($_id); ?> .qcld_hero_content_area:visible').css('margin-top','-'+Math.round(jQuery('#particles-js<?php echo intval($_id); ?> .qcld_hero_content_area:visible').height()/2)+'px');
		<?php endif; ?>
	   
	   <?php if(isset($style->screenoption) and $style->screenoption=='1'){ ?>
	   
		   var fullwidth = jQuery("body").prop("clientWidth"); 
			var maindivcon = jQuery('#particles-js<?php echo intval($_id); ?>').parent()[0];
			var getleft = getOffset1(maindivcon);
			jQuery('#particles-js<?php echo intval($_id); ?>').css({

				'left':'-'+getleft.left+'px',
			});
			
			
	   <?php } ?>
	   
	   <?php 
		if(isset($style->screenoption) and $style->screenoption=='2'){
		?>
		
			var fullwidth = jQuery("body").prop("clientWidth"); 
			var fullheight = window.innerHeight;
			var maindivcon = jQuery('#particles-js<?php echo intval($_id); ?>').parent()[0];
			var getleft = getOffset1(maindivcon);
			jQuery('#particles-js<?php echo intval($_id); ?>').css({
				'width':fullwidth+'px',
				'height':fullheight+'px',
				'left':'-'+getleft.left+'px',
			});
			
			
			
			
			
		<?php
		}
		?>
		
		<?php if((isset($params->video)&& $params->video=='vimeo') or ($_slider[0]->type=='vimeo_video') and @$params->show_video_popup!='1'): ?>
			
			
			<?php if(isset($params->show_cover_image) && $params->show_cover_image!=1): ?>
				
				jQuery('.hero_play_video_button').fadeOut();
				jQuery(".sh_video_preload").fadeOut();
				
				vplayer.play().then(function(fromResolve){
					jQuery('.hero_play_video_button').fadeOut();
					jQuery(".sh_video_preload").fadeOut();
					setTimeout(function(){
						controlHeight_custom();
					},200)
				}).catch(function(fromReject){
					jQuery('.hero_play_video_button').show();
					jQuery(".sh_video_preload").show();
				})
			<?php else: ?>
				jQuery("#hero_ge_pause_button<?php echo intval($_id); ?>").click();	
			<?php endif; ?>
			
			jQuery('.hero_play_video_button').on('click', function(){
				var iframe = document.querySelector('iframe');
				var vplayer = new Vimeo.Player(iframe);
				vplayer.play().then(function(fromResolve){
					jQuery('.hero_play_video_button').fadeOut();
					jQuery(".sh_video_preload").fadeOut();
					jQuery("#hero_ge_play_button<?php echo intval($_id); ?>").click();
					setTimeout(function(){
						controlHeight_custom();
					},200)
				}).catch(function(e){
					console.log(e);
				})

			})
		
		<?php endif; ?>
		
		<?php if((isset($params->video)&& $params->video=='custom') or ($_slider[0]->type=='video')): ?>
		
			<?php if(isset($params->show_cover_image) && $params->show_cover_image!=1): ?>
			if(jQuery("#hero_vid<?php echo intval($_id); ?>").length > 0){
				jQuery("#hero_vid<?php echo intval($_id); ?>").get(0).play().then(function(fromResolve){
					
					jQuery(".hero_play_video_button").fadeOut();
					jQuery(".sh_video_preload").fadeOut();
					
				}).catch(function(fromReject){
					
					jQuery(".hero_play_video_button").show();
					jQuery(".sh_video_preload").show();
					jQuery("#hero_ge_pause_button<?php echo intval($_id); ?>").click();				
					console.log('video paused!!!!');
					
				})
			}
			<?php else: ?>
				jQuery("#hero_ge_pause_button<?php echo intval($_id); ?>").click();	
			<?php endif; ?>

			jQuery(document).on('visibilitychange', function(){
				setTimeout(function(){
					if(jQuery(".hero_play_video_button").is(":visible") && jQuery("#hero_vid<?php echo intval($_id); ?>").get(0).paused!==true){
						jQuery(".hero_play_video_button").hide();
					}
				},500)
			})
			
			jQuery('.hero_play_video_button').on('click', function(){
				jQuery(this).hide();
				jQuery(".sh_video_preload").fadeOut();
				jQuery("#hero_vid<?php echo intval($_id); ?>").get(0).play();
				jQuery("#hero_ge_play_button<?php echo intval($_id); ?>").click();
				setTimeout(function(){
					controlHeight_custom();
				},200)
				
			})
		<?php endif; ?>
		//youtube video
		<?php if((isset($params->video)&& $params->video=='youtube') or ($_slider[0]->type=='youtube_video')): ?>
			var myYouInterval = setInterval(function(){
				<?php if(isset($params->show_cover_image) && $params->show_cover_image!=1): ?>
				if(typeof(player)!='undefined'){
					if(player.getPlayerState() > 0){
            jQuery(".hero_play_video_button").fadeOut();
						jQuery(".sh_video_preload").fadeOut();
            clearInterval(myYouInterval);
					}
				}
				<?php else: ?>
				jQuery("#hero_ge_pause_button<?php echo intval($_id); ?>").click();
        clearInterval(myYouInterval);
				<?php endif; ?>

			},1000);

			jQuery('.hero_play_video_button').on('click', function(){
				jQuery(this).hide();
				jQuery(".sh_video_preload").fadeOut();
				jQuery("#hero_ge_play_button<?php echo intval($_id); ?>").click();
			})
		
		<?php endif; ?>
		
		<?php 
		if(isset($params->video)&& $params->video=='youtube'): 
			if(isset($params->bg_video_youtube)&& $params->bg_video_youtube!=''):
		?>
		

    var myYInterval = setInterval(function(){
      if(jQuery('#hero_youtube_video').parent().attr('class')=='fluid-width-video-wrapper'){
        jQuery('#hero_youtube_video').unwrap();
        clearInterval(myYInterval);
      }
    }, 500);

		<?php endif;endif; ?>
		<?php if($_slider[0]->type=='youtube_video'): ?>
		
    var myYInterval = setInterval(function(){
      if(jQuery('#hero_youtube_video').parent().attr('class')=='fluid-width-video-wrapper'){
        jQuery('#hero_youtube_video').unwrap();
        clearInterval(myYInterval);
      }
    }, 500);
		<?php endif; ?>
		
		var maindivcontainer = jQuery('#particles-js<?php echo intval($_id); ?>');
		if(jQuery(window).width() < 767){
			maindivcontainer.find('.qcld_hero_content_area:visible').css('margin-top','-'+Math.round(maindivcontainer.find('.qcld_hero_content_area:visible').height()/2)+'px');
			
		}
		
<?php if($_slider[0]->type=='stripe-cube' && isset($preloader['hero_enable_preloader']) && $preloader['hero_enable_preloader']=='on') : ?>
var _slicedToArray = function () { function sliceIterator(arr, i) { var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"]) _i["return"](); } finally { if (_d) throw _e; } } return _arr; } return function (arr, i) { if (Array.isArray(arr)) { return arr; } else if (Symbol.iterator in Object(arr)) { return sliceIterator(arr, i); } else { throw new TypeError("Invalid attempt to destructure non-iterable instance"); } }; }();

function qcherorandom(min, max) {
    var rnum = Math.random() * (max - min) + min;
	if(rnum>max){
		qcherorandom(min, max);
	}
	return rnum;
}

var Strut = {
  random: function random(e, t) {
    return Math.random() * (t - e) + e;
  },
  arrayRandom: function arrayRandom(e) {
    return e[Math.floor(Math.random() * e.length)];
  },
  interpolate: function interpolate(e, t, n) {
    return e * (1 - n) + t * n;
  },
  rangePosition: function rangePosition(e, t, n) {
    return (n - e) / (t - e);
  },
  clamp: function clamp(e, t, n) {
    return Math.max(Math.min(e, n), t);
  },
  queryArray: function queryArray(e, t) {
    return t || (t = document.body), Array.prototype.slice.call(t.querySelectorAll(e));
  },
  ready: function ready(e) {
    document.readyState == 'complete' ? e() : document.addEventListener('DOMContentLoaded', e);
  }
};

var reduceMotion = matchMedia("(prefers-reduced-motion)").matches;

{
  // =======
  // helpers
  // =======

  var setState = function setState(state, speed) {
    return directions.forEach(function (axis) {
      state[axis] += speed[axis];
      if (Math.abs(state[axis]) < 360) return;
      var max = Math.max(state[axis], 360);
      var min = max == 360 ? Math.abs(state[axis]) : 360;
      state[axis] = max - min;
    });
  };

  var cubeIsHidden = function cubeIsHidden(left) {
    return left > parentWidth + 30;
  };

  // =================
  // shared references
  // =================

  var headerIsHidden = false;

  var template = document.getElementById("qc-cube-template");

  var parent = document.getElementById("qc-header-hero");
  var getParentWidth = function getParentWidth() {
    return parent.getBoundingClientRect().width;
  };

  var parentWidth = getParentWidth();
  window.addEventListener("resize", function () {
    return parentWidth = getParentWidth();
  });

  
  
  var directions = ["x", "y"];

  var palette = {
    white: {
      color: [255, 255, 255],
      shading: [160, 190, 218]
    },
    orange: {
      color: [255, 250, 230],
      shading: [255, 120, 50]
    },
    green: {
      color: [205, 255, 204],
      shading: [0, 211, 136]
    }
  };

  // ==============
  // cube instances
  // ==============

  var setqc_cubestyles = function setqc_cubestyles(_ref) {
    var cube = _ref.cube,
        size = _ref.size,
        left = _ref.left,
        top = _ref.top;

    Object.assign(cube.style, {
      width: size + 'px',
      height: size + 'px',
      left: left + '%',
      top: top + '%'
    });

    Object.assign(cube.querySelector(".qc_shadow").style, {
      filter: 'blur(' + Math.round(size * .6) + 'px)',
      opacity: Math.min(size / 120, .4)
    });
  };

  var createCube = function createCube(size) {
    var fragment = document.importNode(template.content, true);
    var cube = fragment.querySelector(".qc_cube");

    var state = {
      x: 0,
      y: 0
    };

    var speed = directions.reduce(function (object, axis) {
      var max = size > sizes.m ? .3 : .6;
      object[axis] = Strut.random(-max, max);
      return object;
    }, {});

    var qc_sides = Strut.queryArray(".qc_sides div", cube).reduce(function (object, side) {
      object[side.className] = {
        side: side,
        hidden: false,
        rotate: {
          x: 0,
          y: 0
        }
      };
      return object;
    }, {});

    qc_sides.qc_top.rotate.x = 90;
    qc_sides.qc_bottom.rotate.x = -90;
    qc_sides.qc_left.rotate.y = -90;
    qc_sides.qc_right.rotate.y = 90;
    qc_sides.qc_back.rotate.y = -180;

    return { fragment: fragment, cube: cube, state: state, speed: speed, qc_sides: Object.values(qc_sides) };
  };

  var sizes = {
    xs: 15,
    s: 25,
    m: 40,
    l: 100,
    xl: 120
  };

  var qc_cubes = [{
    tint: palette.green,
    size: sizes.xs,
    left: qcherorandom(50,100),
    top: qcherorandom(10,80)
  }, {
    tint: palette.white,
    size: sizes.s,
    left: qcherorandom(50,100),
    top: qcherorandom(10,80)
  }, {
    tint: palette.white,
    size: sizes.xl,
    left: qcherorandom(50,100),
    top: qcherorandom(10,80)
  }, {
    tint: palette.white,
    size: sizes.m,
    left: qcherorandom(50,100),
    top: qcherorandom(10,80)
  }, {
    tint: palette.green,
    size: sizes.xs,
    left: qcherorandom(50,100),
    top: qcherorandom(10,80)
  }, {
    tint: palette.orange,
    size: sizes.s,
    left: qcherorandom(50,100),
    top: qcherorandom(10,80)
  }, {
    tint: palette.white,
    size: sizes.l,
    left: qcherorandom(50,100),
    top: qcherorandom(10,80)
  }, {
    tint: palette.green,
    size: sizes.s,
    left: qcherorandom(50,100),
    top: qcherorandom(10,80)
  }, {
    tint: palette.white,
    size: sizes.xl,
    left: qcherorandom(50,100),
    top: qcherorandom(10,80)
  }, {
    tint: palette.orange,
    size: sizes.l,
    left: qcherorandom(50,100),
    top: qcherorandom(10,80)
  }, {
    tint: palette.green,
    size: sizes.m,
    left: qcherorandom(50,100),
    top: qcherorandom(10,80)
  }].map(function (object) {
    return Object.assign(createCube(object.size), object);
  });

  qc_cubes.forEach(setqc_cubestyles);

  // =======================
  // cube rotating animation
  // =======================

  var getDistance = function getDistance(state, rotate) {
    return directions.reduce(function (object, axis) {
      object[axis] = Math.abs(state[axis] + rotate[axis]);
      return object;
    }, {});
  };

  var getRotation = function getRotation(state, size, rotate) {
    var axis = rotate.x ? "Z" : "Y";
    var direction = rotate.x > 0 ? -1 : 1;

    return '\n      rotateX(' + (state.x + rotate.x) + 'deg)\n      rotate' + axis + '(' + direction * (state.y + rotate.y) + 'deg)\n      translateZ(' + size / 2 + 'px)\n    ';
  };

  var getShading = function getShading(tint, rotate, distance) {
    var darken = directions.reduce(function (object, axis) {
      var delta = distance[axis];
      var ratio = delta / 180;
      object[axis] = delta > 180 ? Math.abs(2 - ratio) : ratio;
      return object;
    }, {});

    if (rotate.x) darken.y = 0;else {
      var x = distance.x;

      if (x > 90 && x < 270) directions.forEach(function (axis) {
        return darken[axis] = 1 - darken[axis];
      });
    }

    var alpha = (darken.x + darken.y) / 2;
    var blend = function blend(value, index) {
      return Math.round(Strut.interpolate(value, tint.shading[index], alpha));
    };

    var _tint$color$map = tint.color.map(blend),
        _tint$color$map2 = _slicedToArray(_tint$color$map, 3),
        r = _tint$color$map2[0],
        g = _tint$color$map2[1],
        b = _tint$color$map2[2];

    return 'rgb(' + r + ', ' + g + ', ' + b + ')';
  };

  var shouldHide = function shouldHide(rotateX, x, y) {
    if (rotateX) return x > 90 && x < 270;
    if (x < 90) return y > 90 && y < 270;
    if (x < 270) return y < 90;
    return y > 90 && y < 270;
  };

  var updateqc_sides = function updateqc_sides(_ref2) {
    var state = _ref2.state,
        speed = _ref2.speed,
        size = _ref2.size,
        tint = _ref2.tint,
        qc_sides = _ref2.qc_sides,
        left = _ref2.left;

    if (headerIsHidden || cubeIsHidden(left)) return;

    var animate = function animate(object) {
      var side = object.side,
          rotate = object.rotate,
          hidden = object.hidden;

      var distance = getDistance(state, rotate);

      // don't animate hidden qc_sides
      if (shouldHide(rotate.x, distance.x, distance.y)) {
        if (!hidden) {
          side.hidden = true;
          object.hidden = true;
        }
        return;
      }

      if (hidden) {
        side.hidden = false;
        object.hidden = false;
      }

      side.style.transform = getRotation(state, size, rotate);
      side.style.backgroundColor = getShading(tint, rotate, distance);
    };

    setState(state, speed);
    qc_sides.forEach(animate);
  };

  var tick = function tick() {
    qc_cubes.forEach(updateqc_sides);
    if (reduceMotion) return;
    requestAnimationFrame(tick);
  };

  // ===============
  // parallax scroll
  // ===============

  // give it some extra space to account for the parallax and the qc_shadows of the qc_cubes
  var parallaxLimit = document.querySelector(".qc_main > .qc_header").getBoundingClientRect().height + 80;


  // ==========
  // initialize
  // ==========

  var container = document.createElement("div");
  container.className = "qc_cubes";
  qc_cubes.forEach(function (_ref4) {
    var fragment = _ref4.fragment;
    return container.appendChild(fragment);
  });

  var start = function start() {
    tick();
    parent.appendChild(container);
  };

  'requestIdleCallback' in window ? requestIdleCallback(start) : start();
}
<?php endif; ?>
<?php if($_slider[0]->type=='blade') : ?>

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Growth = function Growth() {
  _classCallCheck(this, Growth);
};
var mainArea = document.getElementById("particles-js<?php echo intval($_id); ?>");
var Blade = function () {
  function Blade(c) {
    _classCallCheck(this, Blade);

    this.c = c;
    this.init();
  }

  Blade.prototype.init = function init() {
    this.r = Math.random() * 200 + 100;
    this.x = Math.random() * window.innerWidth;
    this.y = window.innerHeight * Math.random();
    this.vy = Math.random() * 2 - 1;
    this.ax = this.x - this.r;
    this.bx = this.x + this.r;
    this.dx = Math.random() * 150 + 80;
    this.g = Math.round(Math.random() * 255);
    this.b = this.g; // Math.round(Math.random() * 10 + 155);
  };

  Blade.prototype.run = function run() {
    this.ax += (this.x - this.ax) / this.dx;
    this.bx += (this.x - this.bx) / this.dx;
    this.y += this.vy;

    if (this.bx - this.ax < 0.5) this.init();

    this.c.strokeStyle = 'rgba(0, ' + this.g + ', ' + this.b + ', 0.1)';
    this.c.beginPath();

    this.c.moveTo(this.ax, this.y);
    this.c.lineTo(this.bx, this.y);
    this.c.stroke();
  };

  return Blade;
}();

var Scene = function () {
  function Scene() {
    _classCallCheck(this, Scene);

    this.canvas = mainArea.appendChild(document.createElement('canvas'));
    this.c = this.canvas.getContext('2d');
    this.resize();
    window.addEventListener('resize', this.resize.bind(this));
    this.clear();
    this.initBlades();
    this.loop = this.loop.bind(this);
    this.loop();
  }

  Scene.prototype.loop = function loop() {
    for (var i = 0; i < 3; i++) {
      this.blades.forEach(function (blade) {
        return blade.run();
      });
    }
    requestAnimationFrame(this.loop);
  };

  Scene.prototype.initBlades = function initBlades() {
    this.blades = [];
    this.bladeNum = 1000;
    for (var i = 0; i < this.bladeNum; i++) {
      this.blades[i] = new Blade(this.c);
    }
  };

  Scene.prototype.clear = function clear() {
    this.c.fillStyle = 'black';
    this.c.fillRect(0, 0, this.canvas.width, this.canvas.height);
  };

  Scene.prototype.resize = function resize() {
    this.canvas.width = mainArea.offsetWidth;
    this.canvas.height = mainArea.offsetHeight;
    this.clear();
  };

  return Scene;
}();

new Scene();
<?php endif; ?>

<?php if($_slider[0]->type=='blur') : ?>

var mainArea = document.getElementById("particles-js<?php echo intval($_id); ?>");
<?php 
	if(isset($params->blur->canvas_bg)&&$params->blur->canvas_bg!=''){
?>
jQuery(("#particles-js<?php echo intval($_id); ?>")).css({
	'background-color':'<?php echo $params->blur->canvas_bg; ?>'
})
<?php
	}
?>

var createCanvas = mainArea.appendChild(document.createElement('canvas'));
createCanvas.setAttribute("id", "space");
createCanvas.style.width = "100%";
createCanvas.style.height = "100%";
jQuery('canvas').css({
	'-webkit-filter': "blur(15px)",
	"filter":"url('#blur')",
	"filter":"blur(15px)"
})

window.requestAnimFrame = (function(){
  return  window.requestAnimationFrame || 
    window.webkitRequestAnimationFrame || 
    window.mozRequestAnimationFrame    || 
    window.oRequestAnimationFrame      || 
    window.msRequestAnimationFrame     ||  
    function( callback ){
    window.setTimeout(callback, 1000 / 60);
  };
})();
var canvas = document.getElementsByTagName("canvas")[0];
var ctx = canvas.getContext("2d");
var w = mainArea.offsetWidth, h = mainArea.offsetHeight;
canvas.width = w;
canvas.height = h;

var bg_particle_no = 180;

var particles = [];

function init(){
   reset_scene();
  for(var i=0;i<bg_particle_no;i++){
     var p = new bg_particle();
     particles.push(p);
  }
}

function reset_scene(){
  ctx.fillStyle = "<?php echo ((isset($params->blur->canvas_bg)&&$params->blur->canvas_bg!='')?$params->blur->canvas_bg:'#03244B');?>";
  ctx.fillRect(0,0,w,h);
}

function drawscene(){
  reset_scene();
  for(var i=0;i<particles.length;i++){
    var p = particles[i];
    p.x += p.sx;
    if(p.x > w || p.x < 0){
      p.sx = -p.sx;
    }
    p.y += p.sy;
    if(p.y > h || p.y < 0){
      p.sy = -p.sy;
    }
    p.draw();
  }
}

function bg_particle(){
  this.x = Math.random()*w;
  this.y = Math.random()*h;
  this.sx = Math.random()*2;
  this.sy = Math.random()*2;
  var min = 10;
  var max = 40;
  this.r = Math.random()*(max - min);
  
  
  this.draw = function(){
    ctx.fillStyle="<?php echo ((isset($params->blur->particle_color)&&$params->blur->particle_color!='')?$params->blur->particle_color:'#52CA70');?>";
    ctx.beginPath();
    ctx.arc(this.x,this.y,this.r, 0, Math.PI*2, false);
    ctx.fill();
  }
}

function animloop() {
  drawscene();
  requestAnimFrame(animloop); 
}
init();
animloop();

<?php endif ?>
		<?php if($_slider[0]->type=='particle') : ?>
particlesJS("particles-js<?php echo intval($_id); ?>", {
  "particles": {
    "number": {
      "value": 80,
      "density": {
        "enable": true,
        "value_area": 800
      }
    },
    "color": {
      "value": "<?php echo (isset($params->particle_color)&&$params->particle_color!=''?$params->particle_color:'#ffffff'); ?>"
    },
    "shape": {
      "type": "<?php echo (isset($params->particle_type)&&$params->particle_type!=''?$params->particle_type:'circle'); ?>",
      "stroke": {
        "width": 0,
        "color": "#000000"
      },
      "polygon": {
        "nb_sides": 5
      },
      "image": {
        "src": "img/github.svg",
        "width": 100,
        "height": 100
      }
    },
    "opacity": {
      "value": 0.5,
      "random": false,
      "anim": {
        "enable": false,
        "speed": 1,
        "opacity_min": 0.1,
        "sync": false
      }
    },
    "size": {
      "value": 3,
      "random": true,
      "anim": {
        "enable": false,
        "speed": 40,
        "size_min": 0.1,
        "sync": false
      }
    },
    "line_linked": {
      "enable": true,
      "distance": 150,
      "color": "<?php echo (isset($params->linelink_color)&&$params->linelink_color!=''?esc_attr($params->linelink_color):'#ffffff'); ?>",
      "opacity": 0.4,
      "width": 1
    },
    "move": {
      "enable": true,
      "speed": 6,
      "direction": "none",
      "random": false,
      "straight": false,
      "out_mode": "out",
      "bounce": false,
      "attract": {
        "enable": false,
        "rotateX": 600,
        "rotateY": 1200
      }
    }
  },
  "interactivity": {
    "detect_on": "canvas",
    "events": {
      "onhover": {
        "enable": true,
        "mode": "<?php echo (isset($params->interactivity)&&$params->interactivity!=''?$params->interactivity:'repulse'); ?>"
      },
      "onclick": {
        "enable": true,
        "mode": "push"
      },
      "resize": true
    },
    "modes": {
      "grab": {
        "distance": 400,
        "line_linked": {
          "opacity": 1
        }
      },
      "bubble": {
        "distance": 400,
        "size": 40,
        "duration": 2,
        "opacity": 8,
        "speed": 3
      },
      "repulse": {
        "distance": 200,
        "duration": 0.4
      },
      "push": {
        "particles_nb": 4
      },
      "remove": {
        "particles_nb": 2
      }
    }
  },
  "retina_detect": true
});
<?php elseif($_slider[0]->type=='particle_snow' or (isset($params->introbgeffect) && $params->introbgeffect=='particle_snow')) : ?>
particlesJS("particles-js<?php echo intval($_id); ?>", {
  "particles": {
    "number": {
      "value": 400,
      "density": {
        "enable": true,
        "value_area": 800
      }
    },
    "color": {
      "value": "<?php echo (isset($params->particle_snow->color)&&$params->particle_snow->color!=''?$params->particle_snow->color:'#ffffff'); ?>"
    },
    "shape": {
      "type": "<?php echo (isset($params->particle_snow->type)&&$params->particle_snow->type!=''?$params->particle_snow->type:'circle'); ?>",
      "stroke": {
        "width": 0,
        "color": "#000000"
      },
      "polygon": {
        "nb_sides": 5
      },
      "image": {
        "src": "img/github.svg",
        "width": 100,
        "height": 100
      }
    },
    "opacity": {
      "value": 0.5,
      "random": true,
      "anim": {
        "enable": false,
        "speed": 1,
        "opacity_min": 0.1,
        "sync": false
      }
    },
    "size": {
      "value": 10,
      "random": true,
      "anim": {
        "enable": false,
        "speed": 40,
        "size_min": 0.1,
        "sync": false
      }
    },
    "line_linked": {
      "enable": false,
      "distance": 500,
      "color": "#ffffff",
      "opacity": 0.4,
      "width": 2
    },
    "move": {
      "enable": true,
      "speed": 6,
      "direction": "bottom",
      "random": false,
      "straight": false,
      "out_mode": "out",
      "bounce": false,
      "attract": {
        "enable": false,
        "rotateX": 600,
        "rotateY": 1200
      }
    }
  },
  "interactivity": {
    "detect_on": "canvas",
    "events": {
      "onhover": {
        "enable": true,
        "mode": "bubble"
      },
      "onclick": {
        "enable": true,
        "mode": "repulse"
      },
      "resize": true
    },
    "modes": {
      "grab": {
        "distance": 400,
        "line_linked": {
          "opacity": 0.5
        }
      },
      "bubble": {
        "distance": 400,
        "size": 4,
        "duration": 0.3,
        "opacity": 1,
        "speed": 3
      },
      "repulse": {
        "distance": 200,
        "duration": 0.4
      },
      "push": {
        "particles_nb": 4
      },
      "remove": {
        "particles_nb": 2
      }
    }
  },
  "retina_detect": true
});
<?php elseif($_slider[0]->type=='particle_nasa' or (isset($params->introbgeffect) && $params->introbgeffect=='particle_nasa')) : ?>
particlesJS("particles-js<?php echo intval($_id); ?>", {
  "particles": {
    "number": {
      "value": 160,
      "density": {
        "enable": true,
        "value_area": 800
      }
    },
    "color": {
      "value": "#ffffff"
    },
    "shape": {
      "type": "circle",
      "stroke": {
        "width": 0,
        "color": "#000000"
      },
      "polygon": {
        "nb_sides": 5
      },
      "image": {
        "src": "img/github.svg",
        "width": 100,
        "height": 100
      }
    },
    "opacity": {
      "value": 1,
      "random": true,
      "anim": {
        "enable": true,
        "speed": 1,
        "opacity_min": 0,
        "sync": false
      }
    },
    "size": {
      "value": 3,
      "random": true,
      "anim": {
        "enable": false,
        "speed": 4,
        "size_min": 0.3,
        "sync": false
      }
    },
    "line_linked": {
      "enable": false,
      "distance": 150,
      "color": "#ffffff",
      "opacity": 0.4,
      "width": 1
    },
    "move": {
      "enable": true,
      "speed": 3,
      "direction": "none",
      "random": true,
      "straight": false,
      "out_mode": "out",
      "bounce": false,
      "attract": {
        "enable": false,
        "rotateX": 600,
        "rotateY": 600
      }
    }
  },
  "interactivity": {
    "detect_on": "canvas",
    "events": {
      "onhover": {
        "enable": true,
        "mode": "bubble"
      },
      "onclick": {
        "enable": true,
        "mode": "repulse"
      },
      "resize": true
    },
    "modes": {
      "grab": {
        "distance": 400,
        "line_linked": {
          "opacity": 1
        }
      },
      "bubble": {
        "distance": 250,
        "size": 0,
        "duration": 2,
        "opacity": 0,
        "speed": 3
      },
      "repulse": {
        "distance": 400,
        "duration": 0.4
      },
      "push": {
        "particles_nb": 4
      },
      "remove": {
        "particles_nb": 2
      }
    }
  },
  "retina_detect": true
});
<?php elseif($_slider[0]->type=='particle_bubble' or (isset($params->introbgeffect) && $params->introbgeffect=='particle_bubble')) : ?>
particlesJS("particles-js<?php echo intval($_id); ?>", {
  "particles": {
    "number": {
      "value": 6,
      "density": {
        "enable": true,
        "value_area": 800
      }
    },
    "color": {
      "value": "#1b1e34"
    },
    "shape": {
      "type": "polygon",
      "stroke": {
        "width": 0,
        "color": "#000"
      },
      "polygon": {
        "nb_sides": 6
      },
      "image": {
        "src": "img/github.svg",
        "width": 100,
        "height": 100
      }
    },
    "opacity": {
      "value": 0.3,
      "random": true,
      "anim": {
        "enable": false,
        "speed": 1,
        "opacity_min": 0.1,
        "sync": false
      }
    },
    "size": {
      "value": 160,
      "random": false,
      "anim": {
        "enable": true,
        "speed": 10,
        "size_min": 40,
        "sync": false
      }
    },
    "line_linked": {
      "enable": false,
      "distance": 200,
      "color": "#ffffff",
      "opacity": 1,
      "width": 2
    },
    "move": {
      "enable": true,
      "speed": 8,
      "direction": "none",
      "random": false,
      "straight": false,
      "out_mode": "out",
      "bounce": false,
      "attract": {
        "enable": false,
        "rotateX": 600,
        "rotateY": 1200
      }
    }
  },
  "interactivity": {
    "detect_on": "canvas",
    "events": {
      "onhover": {
        "enable": false,
        "mode": "grab"
      },
      "onclick": {
        "enable": false,
        "mode": "push"
      },
      "resize": true
    },
    "modes": {
      "grab": {
        "distance": 400,
        "line_linked": {
          "opacity": 1
        }
      },
      "bubble": {
        "distance": 400,
        "size": 40,
        "duration": 2,
        "opacity": 8,
        "speed": 3
      },
      "repulse": {
        "distance": 200,
        "duration": 0.4
      },
      "push": {
        "particles_nb": 4
      },
      "remove": {
        "particles_nb": 2
      }
    }
  },
  "retina_detect": true
});
<?php elseif($_slider[0]->type=='nyan_cat' or (isset($params->introbgeffect) && $params->introbgeffect=='nyan_cat')) : ?>
particlesJS("particles-js<?php echo intval($_id); ?>", {
  "particles": {
    "number": {
      "value": 100,
      "density": {
        "enable": false,
        "value_area": 800
      }
    },
    "color": {
      "value": "#ffffff"
    },
    "shape": {
      "type": "star",
      "stroke": {
        "width": 0,
        "color": "#000000"
      },
      "polygon": {
        "nb_sides": 5
      },
      "image": {
        "src": "http://wiki.lexisnexis.com/academic/images/f/fb/Itunes_podcast_icon_300.jpg",
        "width": 100,
        "height": 100
      }
    },
    "opacity": {
      "value": 0.5,
      "random": false,
      "anim": {
        "enable": false,
        "speed": 1,
        "opacity_min": 0.1,
        "sync": false
      }
    },
    "size": {
      "value": 4,
      "random": true,
      "anim": {
        "enable": false,
        "speed": 40,
        "size_min": 0.1,
        "sync": false
      }
    },
    "line_linked": {
      "enable": false,
      "distance": 150,
      "color": "#ffffff",
      "opacity": 0.4,
      "width": 1
    },
    "move": {
      "enable": true,
      "speed": 14,
      "direction": "left",
      "random": false,
      "straight": true,
      "out_mode": "out",
      "bounce": false,
      "attract": {
        "enable": false,
        "rotateX": 600,
        "rotateY": 1200
      }
    }
  },
  "interactivity": {
    "detect_on": "canvas",
    "events": {
      "onhover": {
        "enable": false,
        "mode": "grab"
      },
      "onclick": {
        "enable": true,
        "mode": "repulse"
      },
      "resize": true
    },
    "modes": {
      "grab": {
        "distance": 200,
        "line_linked": {
          "opacity": 1
        }
      },
      "bubble": {
        "distance": 400,
        "size": 40,
        "duration": 2,
        "opacity": 8,
        "speed": 3
      },
      "repulse": {
        "distance": 200,
        "duration": 0.4
      },
      "push": {
        "particles_nb": 4
      },
      "remove": {
        "particles_nb": 2
      }
    }
  },
  "retina_detect": true
});
<?php endif; ?>

});
function firesliderx<?php echo intval($_id); ?>(){
  jQuery('#particles-js<?php echo intval($_id); ?>').sliderX();
}

jQuery(document).ready(function($){

	<?php if($_slider[0]->type!='intro') : ?>
    $.fn.sliderX.defaults = {
		
		sliderWidth:<?php echo esc_attr($style->width); ?>,
		sliderHeight:<?php echo esc_attr($style->height); ?>,
		
		//sliderBackground:'<?php echo $params->background != ''? esc_attr($params->background):'#eb484d' ?>',
		
        pauseTime: <?php echo ($params->effect->interval!=''?$params->effect->interval:0); ?>,
		paddingTime: <?php echo (isset($params->paddingtime)&&$params->paddingtime!=''?$params->paddingtime:'0'); ?>,
        startSlide: 0,
		
		titlePositionTop:'0%',
		
		titlePositionLeft:'0%',
		
		descPositionTop:'0%',
		
		descPositionLeft:'0%',
		
		//titleTextAnimation:'pulse',
		titleTextColor:'<?php echo $params->titlecolor != ''? esc_attr($params->titlecolor):'#000' ?>',
		
		descriptionTextColor:'<?php echo $params->descriptioncolor != ''? esc_attr($params->descriptioncolor):'#000' ?>',
		
		titleFontSize:'<?php echo $params->titlefontsize != ''? esc_attr($params->titlefontsize):'20' ?>',
		arrowClass: '<?php echo $params->arrow != ''? esc_attr($params->arrow):'qc-sliderX' ?>',
		descriptionFontSize:'<?php echo $params->descfontsize != ''? esc_attr($params->descfontsize):'30' ?>',
		<?php 
		if(isset($style->screenoption) and $style->screenoption=='1'){
		?>
		fullWidth:true,
		<?php
		}else{
		?>
		fullWidth:false,
		<?php
		}
		?>
		<?php 
		if(isset($style->screenoption) and $style->screenoption=='2'){
		?>
		fullScreen:true,
		<?php
		}else{
		?>
		fullScreen:false,
		<?php
		}
		?>
		<?php 
		if(isset($style->screenoption) and $style->screenoption=='3'){
		?>
		Screenauto:true,
		<?php
		}else{
		?>
		Screenauto:false,
		<?php
		}
		?>
		
		<?php 
			if($totalSlide > 0){
		?>
		
		<?php if(isset($params->stopslide) && $params->stopslide==1): ?>
			slideStart: false,
		<?php else: ?>
			slideStart: true,
		<?php endif; ?>
		
		<?php if(isset($params->hidearrow) && $params->hidearrow==1): ?>
			directionCon:false,
		<?php else: ?>
			directionCon:true,
		<?php endif; ?>
		
		<?php if(isset($params->hidenavigation) && $params->hidenavigation==1): ?>
			bottomCon:false,
		<?php else: ?>
			bottomCon:true,
		<?php endif; ?>
		
		<?php
			}else{
		?>
		directionCon:false,
		bottomCon:false,
		slideStart: false,
		<?php
			}
		?>
		<?php 
			if(isset($params->arrow_style) and $params->arrow_style=='floating'){
			?>
			arrow_style: 'floating',
			<?php
			}else{
			?>
			arrow_style: 'default',
			<?php
			}
		?>
		<?php 
			if(isset($params->randomslide) and $params->randomslide=='0'){
			?>
			randomslide: false,
			<?php
			}else{
			?>
			randomslide: true,
			<?php
			}
		?>
		

		prevSlideText:'Previous',
		nextSlideText:'Next',
		titleAnimation: '<?php echo (isset($params->titleffect) && $params->titleffect!=''?esc_attr($params->titleffect):'normal') ?>',
		titleoutAnimation: '<?php echo (isset($params->titleouteffect) && $params->titleouteffect!=''?esc_attr($params->titleouteffect):'') ?>',
		desAnimation: '<?php echo (isset($params->deseffect) && $params->deseffect!=''?esc_attr($params->deseffect):'normal') ?>',
		desoutAnimation: '<?php echo (isset($params->descouteffect) && $params->descouteffect!=''?esc_attr($params->descouteffect):'') ?>',
		
		lfxtitlein:'<?php echo (isset($params->lfxtitlein) && $params->lfxtitlein!=''?esc_attr($params->lfxtitlein):'') ?>',
		lfxtitleout:'<?php echo (isset($params->lfxtitleout) && $params->lfxtitleout!=''?esc_attr($params->lfxtitleout):'') ?>',
		lfxdesin:'<?php echo (isset($params->lfxdesin) && $params->lfxdesin!=''?esc_attr($params->lfxdesin):'') ?>',
		lfxdesout:'<?php echo (isset($params->lfxdesout) && $params->lfxdesout!=''?esc_attr($params->lfxdesout):'') ?>',
		
		
		buttonAnimation: '<?php echo (isset($params->btneffect) && $params->btneffect!=''?esc_attr($params->btneffect):'normal') ?>',
		buttonoutAnimation: '<?php echo (isset($params->btnouteffect)&& $params->btnouteffect!=''?esc_attr($params->btnouteffect):'') ?>',
		
		redirecturl: '<?php echo (isset($params->slidendredirect) && $params->slidendredirect!=''?esc_attr($params->slidendredirect):'') ?>',
		redirectdelay: '<?php echo (isset($params->slideredirectdelay) && $params->slideredirectdelay!=''?esc_attr($params->slideredirectdelay):'') ?>',
		contentposition: '<?php echo (isset($params->content) && $params->content!=''?$params->content:'center') ?>',
		bgtransition: '<?php echo (isset($params->slideimageeffect) && $params->slideimageeffect!=''?$params->slideimageeffect:'fade'); ?>',
		first_slide_delay: '<?php echo (isset($params->first_slide_delay) && $params->first_slide_delay!=''?$params->first_slide_delay:"0"); ?>',
		
		
		<?php 
				if(isset($params->repeat) and $params->repeat=='0'){
				?>
				repeat: false,
				<?php
				}else{
				?>
				repeat: true,
				<?php
				}
		?>
		
		<?php 
				if(isset($params->herorestart) and $params->herorestart==0){
				?>
				sliderestart: true,
				<?php
				}else{
				?>
				sliderestart: false,
				<?php
				}
		?>
		<?php 
				if(isset($params->heropause) and $params->heropause==0){
				?>
				sliderpause: true,
				<?php
				}else{
				?>
				sliderpause: false,
				<?php
				}
		?>
		
		
		
		mainId: 'particles-js<?php echo intval($_id); ?>',
		sid: '<?php echo intval($_id); ?>',
		slidertype: '<?php echo $_slider[0]->type; ?>',
		videopopup: '<?php echo (isset($params->show_video_popup)?$params->show_video_popup:0) ?>',
		contentbottom: '<?php echo (isset($params->content_display_bottom)?$params->content_display_bottom:0) ?>',
    audioautoplay: '<?php echo ( isset($params->audioautoplay) && $params->audioautoplay==1 ? 1 : 0); ?>',
        beforeChange: function(){
			//alert("i am changing..");
		}
    };   

	<?php if(!isset($params->newsliderafterend) ): ?>
		if(jQuery('.second_div_hero').length<1){
      firesliderx<?php echo intval($_id); ?>();
    }
	<?php endif; ?>
	
	<?php else: ?>
		$('#particles-js<?php echo intval($_id); ?>').changeWords({
			time: 800,
			animate: "zoomIn",
			selector: ".eachAnim",
			mainId: 'particles-js<?php echo intval($_id); ?>',
			sid: '<?php echo intval($_id); ?>',
			sliderWidth:<?php echo esc_attr($style->width); ?>,
			sliderHeight:<?php echo esc_attr($style->height); ?>,
			<?php 
			if(isset($style->screenoption) and $style->screenoption=='1'){
			?>
			fullWidth:true,
			<?php
			}else{
			?>
			fullWidth:false,
			<?php
			}
			?>
			<?php 
			if(isset($style->screenoption) and $style->screenoption=='2'){
			?>
			fullScreen:true,
			<?php
			}else{
			?>
			fullScreen:false,
			<?php
			}
			?>
			<?php 
			if(isset($style->screenoption) and $style->screenoption=='3'){
			?>
			Screenauto:true,
			<?php
			}else{
			?>
			Screenauto:false,
			<?php
			}
			?>
			<?php 
				if(isset($params->repeat) and $params->repeat=='0'){
				?>
				repeat: false,
				<?php
				}else{
				?>
				repeat: true,
				<?php
				}
			?>
			redirecturl: '<?php echo (isset($params->slidendredirect) && $params->slidendredirect!=''?esc_attr($params->slidendredirect):'') ?>',
			
			redirectdelay: '<?php echo (isset($params->slideredirectdelay) && $params->slideredirectdelay!=''?esc_attr($params->slideredirectdelay):'') ?>',
			
			loadnewslider: '<?php echo (isset($params->newsliderafterend) && $params->newsliderafterend!=''?$params->newsliderafterend:0); ?>'
			
		  });
	<?php endif; ?>

<?php 
if(isset($style->screenoption) and $style->screenoption=='1'){
?>

$(window).resize(function() {
	setTimeout(function(){
		var fullwidth = jQuery(window).width(); 
		var maindivcon = $('#particles-js<?php echo intval($_id); ?>').parent()[0];
		var getleft = getOffset1(maindivcon);
		jQuery('#particles-js<?php echo intval($_id); ?>').css({
			'left':'-'+getleft.left+'px',
    });
    jQuery('#hero-mobilecontent<?php echo intval($_id); ?>').css({
			'left':'-'+getleft.left+'px',
			'width':fullwidth+'px',
		});
	}, 500);
});

	var fullwidth = jQuery(window).width();
	<?php if(isset($params->newsliderafterend) && $params->newsliderafterend!=''): ?>
		var maindivcon = $('.second_div_hero > #particles-js<?php echo intval($_id); ?>').parent()[0];
	<?php else: ?>
		var maindivcon = $('#particles-js<?php echo intval($_id); ?>').parent()[0];
	<?php endif; ?>
	var getleft = getOffset1(maindivcon);
	jQuery('#particles-js<?php echo intval($_id); ?>').css({
		'left':'-'+getleft.left+'px',
	});

<?php
}
?>		

<?php 
if(isset($style->screenoption) and $style->screenoption=='2'){
?>
$(window).resize(function() {
	setTimeout(function(){
		var fullwidth = jQuery(window).width(); 
		var fullheight = window.innerHeight;
		var maindivcon = $('#particles-js<?php echo intval($_id); ?>').parent()[0];
		var getleft = getOffset1(maindivcon);
		jQuery('#particles-js<?php echo intval($_id); ?>').css({
			'width':fullwidth+'px',
			'height':fullheight+'px',
			'left':'-'+getleft.left+'px',
    });

    jQuery('#hero-mobilecontent<?php echo intval($_id); ?>').css({
			'width':fullwidth+'px',
			'height':fullheight+'px',
			'left':'-'+getleft.left+'px',
		});
		
		
	}, 500);
});
<?php
}
?>

$(window).resize(function() {
	setTimeout(function(){
		if(jQuery(window).width()<767){
			var maindivcontainer = $('#particles-js<?php echo intval($_id); ?>');
			var present_slide = maindivcontainer.find('.qcld_hero_content_area:visible');
			//present_slide.css('height',maindivcontainer.height()+'px');
		}
	}, 500);
});
$('body').css({
	'overflow-x':'hidden',
});


<?php if($_slider[0]->type=='ripples') : ?>
	try {
		$('#particles-js<?php echo intval($_id); ?>').ripples({
			resolution: 512,
			dropRadius: 20, //px
			perturbance: 0.04,
		});
	}
	catch (e) {
		$('.error').show().text(e);
	}
	
	$(window).resize(function() {
		
		setTimeout(function(){
			$('#particles-js<?php echo intval($_id); ?>').ripples('destroy')
		}, 500);
		setTimeout(function(){
			$('#particles-js<?php echo intval($_id); ?>').ripples({
				resolution: 512,
				dropRadius: 15, //px
				perturbance: 0.04,
			});
		}, 1000);
		
	});
	
	
<?php endif; ?>

<?php if($_slider[0]->type=='intro' && isset($params->introbgeffect) && $params->introbgeffect=='ripples') : ?>
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
<?php endif; ?>




<?php if($_slider[0]->type=='stripe-cube' && $preloader['hero_enable_preloader']!='on') : ?>
var _slicedToArray = function () { function sliceIterator(arr, i) { var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"]) _i["return"](); } finally { if (_d) throw _e; } } return _arr; } return function (arr, i) { if (Array.isArray(arr)) { return arr; } else if (Symbol.iterator in Object(arr)) { return sliceIterator(arr, i); } else { throw new TypeError("Invalid attempt to destructure non-iterable instance"); } }; }();

function qcherorandom(min, max) {
    var rnum = Math.random() * (max - min) + min;
	if(rnum>max){
		qcherorandom(min, max);
	}
	return rnum;
}

var Strut = {
  random: function random(e, t) {
    return Math.random() * (t - e) + e;
  },
  arrayRandom: function arrayRandom(e) {
    return e[Math.floor(Math.random() * e.length)];
  },
  interpolate: function interpolate(e, t, n) {
    return e * (1 - n) + t * n;
  },
  rangePosition: function rangePosition(e, t, n) {
    return (n - e) / (t - e);
  },
  clamp: function clamp(e, t, n) {
    return Math.max(Math.min(e, n), t);
  },
  queryArray: function queryArray(e, t) {
    return t || (t = document.body), Array.prototype.slice.call(t.querySelectorAll(e));
  },
  ready: function ready(e) {
    document.readyState == 'complete' ? e() : document.addEventListener('DOMContentLoaded', e);
  }
};

var reduceMotion = matchMedia("(prefers-reduced-motion)").matches;

{
  // =======
  // helpers
  // =======

  var setState = function setState(state, speed) {
    return directions.forEach(function (axis) {
      state[axis] += speed[axis];
      if (Math.abs(state[axis]) < 360) return;
      var max = Math.max(state[axis], 360);
      var min = max == 360 ? Math.abs(state[axis]) : 360;
      state[axis] = max - min;
    });
  };

  var cubeIsHidden = function cubeIsHidden(left) {
    return left > parentWidth + 30;
  };

  // =================
  // shared references
  // =================

  var headerIsHidden = false;

  var template = document.getElementById("qc-cube-template");

  var parent = document.getElementById("qc-header-hero");
  var getParentWidth = function getParentWidth() {
    return parent.getBoundingClientRect().width;
  };

  var parentWidth = getParentWidth();
  window.addEventListener("resize", function () {
    return parentWidth = getParentWidth();
  });

  
  
  var directions = ["x", "y"];

  var palette = {
    white: {
      color: [255, 255, 255],
      shading: [160, 190, 218]
    },
    orange: {
      color: [255, 250, 230],
      shading: [255, 120, 50]
    },
    green: {
      color: [205, 255, 204],
      shading: [0, 211, 136]
    }
  };

  // ==============
  // cube instances
  // ==============

  var setqc_cubestyles = function setqc_cubestyles(_ref) {
    var cube = _ref.cube,
        size = _ref.size,
        left = _ref.left,
        top = _ref.top;

    Object.assign(cube.style, {
      width: size + 'px',
      height: size + 'px',
      left: left + '%',
      top: top + '%'
    });

    Object.assign(cube.querySelector(".qc_shadow").style, {
      filter: 'blur(' + Math.round(size * .6) + 'px)',
      opacity: Math.min(size / 120, .4)
    });
  };

  var createCube = function createCube(size) {
    var fragment = document.importNode(template.content, true);
    var cube = fragment.querySelector(".qc_cube");

    var state = {
      x: 0,
      y: 0
    };

    var speed = directions.reduce(function (object, axis) {
      var max = size > sizes.m ? .3 : .6;
      object[axis] = Strut.random(-max, max);
      return object;
    }, {});

    var qc_sides = Strut.queryArray(".qc_sides div", cube).reduce(function (object, side) {
      object[side.className] = {
        side: side,
        hidden: false,
        rotate: {
          x: 0,
          y: 0
        }
      };
      return object;
    }, {});

    qc_sides.qc_top.rotate.x = 90;
    qc_sides.qc_bottom.rotate.x = -90;
    qc_sides.qc_left.rotate.y = -90;
    qc_sides.qc_right.rotate.y = 90;
    qc_sides.qc_back.rotate.y = -180;

    return { fragment: fragment, cube: cube, state: state, speed: speed, qc_sides: Object.values(qc_sides) };
  };

  var sizes = {
    xs: 15,
    s: 25,
    m: 40,
    l: 100,
    xl: 120
  };

  var qc_cubes = [{
    tint: palette.green,
    size: sizes.xs,
    left: qcherorandom(50,100),
    top: qcherorandom(10,80)
  }, {
    tint: palette.white,
    size: sizes.s,
    left: qcherorandom(50,100),
    top: qcherorandom(10,80)
  }, {
    tint: palette.white,
    size: sizes.xl,
    left: qcherorandom(50,100),
    top: qcherorandom(10,80)
  }, {
    tint: palette.white,
    size: sizes.m,
    left: qcherorandom(50,100),
    top: qcherorandom(10,80)
  }, {
    tint: palette.green,
    size: sizes.xs,
    left: qcherorandom(50,100),
    top: qcherorandom(10,80)
  }, {
    tint: palette.orange,
    size: sizes.s,
    left: qcherorandom(50,100),
    top: qcherorandom(10,80)
  }, {
    tint: palette.white,
    size: sizes.l,
    left: qcherorandom(50,100),
    top: qcherorandom(10,80)
  }, {
    tint: palette.green,
    size: sizes.s,
    left: qcherorandom(50,100),
    top: qcherorandom(10,80)
  }, {
    tint: palette.white,
    size: sizes.xl,
    left: qcherorandom(50,100),
    top: qcherorandom(10,80)
  }, {
    tint: palette.orange,
    size: sizes.l,
    left: qcherorandom(50,100),
    top: qcherorandom(10,80)
  }, {
    tint: palette.green,
    size: sizes.m,
    left: qcherorandom(50,100),
    top: qcherorandom(10,80)
  }].map(function (object) {
    return Object.assign(createCube(object.size), object);
  });

  qc_cubes.forEach(setqc_cubestyles);

  // =======================
  // cube rotating animation
  // =======================

  var getDistance = function getDistance(state, rotate) {
    return directions.reduce(function (object, axis) {
      object[axis] = Math.abs(state[axis] + rotate[axis]);
      return object;
    }, {});
  };

  var getRotation = function getRotation(state, size, rotate) {
    var axis = rotate.x ? "Z" : "Y";
    var direction = rotate.x > 0 ? -1 : 1;

    return '\n      rotateX(' + (state.x + rotate.x) + 'deg)\n      rotate' + axis + '(' + direction * (state.y + rotate.y) + 'deg)\n      translateZ(' + size / 2 + 'px)\n    ';
  };

  var getShading = function getShading(tint, rotate, distance) {
    var darken = directions.reduce(function (object, axis) {
      var delta = distance[axis];
      var ratio = delta / 180;
      object[axis] = delta > 180 ? Math.abs(2 - ratio) : ratio;
      return object;
    }, {});

    if (rotate.x) darken.y = 0;else {
      var x = distance.x;

      if (x > 90 && x < 270) directions.forEach(function (axis) {
        return darken[axis] = 1 - darken[axis];
      });
    }

    var alpha = (darken.x + darken.y) / 2;
    var blend = function blend(value, index) {
      return Math.round(Strut.interpolate(value, tint.shading[index], alpha));
    };

    var _tint$color$map = tint.color.map(blend),
        _tint$color$map2 = _slicedToArray(_tint$color$map, 3),
        r = _tint$color$map2[0],
        g = _tint$color$map2[1],
        b = _tint$color$map2[2];

    return 'rgb(' + r + ', ' + g + ', ' + b + ')';
  };

  var shouldHide = function shouldHide(rotateX, x, y) {
    if (rotateX) return x > 90 && x < 270;
    if (x < 90) return y > 90 && y < 270;
    if (x < 270) return y < 90;
    return y > 90 && y < 270;
  };

  var updateqc_sides = function updateqc_sides(_ref2) {
    var state = _ref2.state,
        speed = _ref2.speed,
        size = _ref2.size,
        tint = _ref2.tint,
        qc_sides = _ref2.qc_sides,
        left = _ref2.left;

    if (headerIsHidden || cubeIsHidden(left)) return;

    var animate = function animate(object) {
      var side = object.side,
          rotate = object.rotate,
          hidden = object.hidden;

      var distance = getDistance(state, rotate);

      // don't animate hidden qc_sides
      if (shouldHide(rotate.x, distance.x, distance.y)) {
        if (!hidden) {
          side.hidden = true;
          object.hidden = true;
        }
        return;
      }

      if (hidden) {
        side.hidden = false;
        object.hidden = false;
      }

      side.style.transform = getRotation(state, size, rotate);
      side.style.backgroundColor = getShading(tint, rotate, distance);
    };

    setState(state, speed);
    qc_sides.forEach(animate);
  };

  var tick = function tick() {
    qc_cubes.forEach(updateqc_sides);
    if (reduceMotion) return;
    requestAnimationFrame(tick);
  };

  // ===============
  // parallax scroll
  // ===============

  // give it some extra space to account for the parallax and the qc_shadows of the qc_cubes
  var parallaxLimit = document.querySelector(".qc_main > .qc_header").getBoundingClientRect().height + 80;


  // ==========
  // initialize
  // ==========

  var container = document.createElement("div");
  container.className = "qc_cubes";
  qc_cubes.forEach(function (_ref4) {
    var fragment = _ref4.fragment;
    return container.appendChild(fragment);
  });

  var start = function start() {
    tick();
    parent.appendChild(container);
  };

  'requestIdleCallback' in window ? requestIdleCallback(start) : start();
}

<?php endif; ?>

<?php if($_slider[0]->type=='blade') : ?>
if(document.getElementsByClassName('hero_preloader').length<1){
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Growth = function Growth() {
  _classCallCheck(this, Growth);
};
var mainArea = document.getElementById("particles-js<?php echo intval($_id); ?>");
var Blade = function () {
  function Blade(c) {
    _classCallCheck(this, Blade);

    this.c = c;
    this.init();
  }

  Blade.prototype.init = function init() {
    this.r = Math.random() * 200 + 100;
    this.x = Math.random() * window.innerWidth;
    this.y = window.innerHeight * Math.random();
    this.vy = Math.random() * 2 - 1;
    this.ax = this.x - this.r;
    this.bx = this.x + this.r;
    this.dx = Math.random() * 150 + 80;
    this.g = Math.round(Math.random() * 255);
    this.b = this.g; // Math.round(Math.random() * 10 + 155);
  };

  Blade.prototype.run = function run() {
    this.ax += (this.x - this.ax) / this.dx;
    this.bx += (this.x - this.bx) / this.dx;
    this.y += this.vy;

    if (this.bx - this.ax < 0.5) this.init();

    this.c.strokeStyle = 'rgba(0, ' + this.g + ', ' + this.b + ', 0.1)';
    this.c.beginPath();

    this.c.moveTo(this.ax, this.y);
    this.c.lineTo(this.bx, this.y);
    this.c.stroke();
  };

  return Blade;
}();

var Scene = function () {
  function Scene() {
    _classCallCheck(this, Scene);

    this.canvas = mainArea.appendChild(document.createElement('canvas'));
    this.c = this.canvas.getContext('2d');
    this.resize();
    window.addEventListener('resize', this.resize.bind(this));
    this.clear();
    this.initBlades();
    this.loop = this.loop.bind(this);
    this.loop();
  }

  Scene.prototype.loop = function loop() {
    for (var i = 0; i < 3; i++) {
      this.blades.forEach(function (blade) {
        return blade.run();
      });
    }
    requestAnimationFrame(this.loop);
  };

  Scene.prototype.initBlades = function initBlades() {
    this.blades = [];
    this.bladeNum = 1000;
    for (var i = 0; i < this.bladeNum; i++) {
      this.blades[i] = new Blade(this.c);
    }
  };

  Scene.prototype.clear = function clear() {
    this.c.fillStyle = 'black';
    this.c.fillRect(0, 0, this.canvas.width, this.canvas.height);
  };

  Scene.prototype.resize = function resize() {
    this.canvas.width = mainArea.offsetWidth;
    this.canvas.height = mainArea.offsetHeight;
    this.clear();
  };

  return Scene;
}();
}
new Scene();
<?php endif; ?>

<?php if($_slider[0]->type=='particle') : ?>
particlesJS("particles-js<?php echo intval($_id); ?>", {
  "particles": {
    "number": {
      "value": 80,
      "density": {
        "enable": true,
        "value_area": 800
      }
    },
    "color": {
      "value": "<?php echo (isset($params->particle_color)&&$params->particle_color!=''?$params->particle_color:'#ffffff'); ?>"
    },
    "shape": {
      "type": "<?php echo (isset($params->particle_type)&&$params->particle_type!=''?$params->particle_type:'circle'); ?>",
      "stroke": {
        "width": 0,
        "color": "#000000"
      },
      "polygon": {
        "nb_sides": 5
      },
      "image": {
        "src": "img/github.svg",
        "width": 100,
        "height": 100
      }
    },
    "opacity": {
      "value": 0.5,
      "random": false,
      "anim": {
        "enable": false,
        "speed": 1,
        "opacity_min": 0.1,
        "sync": false
      }
    },
    "size": {
      "value": 3,
      "random": true,
      "anim": {
        "enable": false,
        "speed": 40,
        "size_min": 0.1,
        "sync": false
      }
    },
    "line_linked": {
      "enable": true,
      "distance": 150,
      "color": "<?php echo (isset($params->linelink_color)&&$params->linelink_color!=''?esc_attr($params->linelink_color):'#ffffff'); ?>",
      "opacity": 0.4,
      "width": 1
    },
    "move": {
      "enable": true,
      "speed": 6,
      "direction": "none",
      "random": false,
      "straight": false,
      "out_mode": "out",
      "bounce": false,
      "attract": {
        "enable": false,
        "rotateX": 600,
        "rotateY": 1200
      }
    }
  },
  "interactivity": {
    "detect_on": "canvas",
    "events": {
      "onhover": {
        "enable": true,
        "mode": "<?php echo (isset($params->interactivity)&&$params->interactivity!=''?$params->interactivity:'repulse'); ?>"
      },
      "onclick": {
        "enable": true,
        "mode": "push"
      },
      "resize": true
    },
    "modes": {
      "grab": {
        "distance": 400,
        "line_linked": {
          "opacity": 1
        }
      },
      "bubble": {
        "distance": 400,
        "size": 40,
        "duration": 2,
        "opacity": 8,
        "speed": 3
      },
      "repulse": {
        "distance": 200,
        "duration": 0.4
      },
      "push": {
        "particles_nb": 4
      },
      "remove": {
        "particles_nb": 2
      }
    }
  },
  "retina_detect": true
});
<?php elseif($_slider[0]->type=='particle_snow' or (isset($params->introbgeffect) && $params->introbgeffect=='particle_snow')) : ?>
particlesJS("particles-js<?php echo intval($_id); ?>", {
  "particles": {
    "number": {
      "value": 400,
      "density": {
        "enable": true,
        "value_area": 800
      }
    },
    "color": {
      "value": "<?php echo (isset($params->particle_snow->color)&&$params->particle_snow->color!=''?$params->particle_snow->color:'#ffffff'); ?>"
    },
    "shape": {
      "type": "<?php echo (isset($params->particle_snow->type)&&$params->particle_snow->type!=''?$params->particle_snow->type:'circle'); ?>",
      "stroke": {
        "width": 0,
        "color": "#000000"
      },
      "polygon": {
        "nb_sides": 5
      },
      "image": {
        "src": "img/github.svg",
        "width": 100,
        "height": 100
      }
    },
    "opacity": {
      "value": 0.5,
      "random": true,
      "anim": {
        "enable": false,
        "speed": 1,
        "opacity_min": 0.1,
        "sync": false
      }
    },
    "size": {
      "value": 10,
      "random": true,
      "anim": {
        "enable": false,
        "speed": 40,
        "size_min": 0.1,
        "sync": false
      }
    },
    "line_linked": {
      "enable": false,
      "distance": 500,
      "color": "#ffffff",
      "opacity": 0.4,
      "width": 2
    },
    "move": {
      "enable": true,
      "speed": 6,
      "direction": "bottom",
      "random": false,
      "straight": false,
      "out_mode": "out",
      "bounce": false,
      "attract": {
        "enable": false,
        "rotateX": 600,
        "rotateY": 1200
      }
    }
  },
  "interactivity": {
    "detect_on": "canvas",
    "events": {
      "onhover": {
        "enable": true,
        "mode": "bubble"
      },
      "onclick": {
        "enable": true,
        "mode": "repulse"
      },
      "resize": true
    },
    "modes": {
      "grab": {
        "distance": 400,
        "line_linked": {
          "opacity": 0.5
        }
      },
      "bubble": {
        "distance": 400,
        "size": 4,
        "duration": 0.3,
        "opacity": 1,
        "speed": 3
      },
      "repulse": {
        "distance": 200,
        "duration": 0.4
      },
      "push": {
        "particles_nb": 4
      },
      "remove": {
        "particles_nb": 2
      }
    }
  },
  "retina_detect": true
});
<?php elseif($_slider[0]->type=='particle_nasa' or (isset($params->introbgeffect) && $params->introbgeffect=='particle_nasa')) : ?>
particlesJS("particles-js<?php echo intval($_id); ?>", {
  "particles": {
    "number": {
      "value": 160,
      "density": {
        "enable": true,
        "value_area": 800
      }
    },
    "color": {
      "value": "#ffffff"
    },
    "shape": {
      "type": "circle",
      "stroke": {
        "width": 0,
        "color": "#000000"
      },
      "polygon": {
        "nb_sides": 5
      },
      "image": {
        "src": "img/github.svg",
        "width": 100,
        "height": 100
      }
    },
    "opacity": {
      "value": 1,
      "random": true,
      "anim": {
        "enable": true,
        "speed": 1,
        "opacity_min": 0,
        "sync": false
      }
    },
    "size": {
      "value": 3,
      "random": true,
      "anim": {
        "enable": false,
        "speed": 4,
        "size_min": 0.3,
        "sync": false
      }
    },
    "line_linked": {
      "enable": false,
      "distance": 150,
      "color": "#ffffff",
      "opacity": 0.4,
      "width": 1
    },
    "move": {
      "enable": true,
      "speed": 1,
      "direction": "none",
      "random": true,
      "straight": false,
      "out_mode": "out",
      "bounce": false,
      "attract": {
        "enable": false,
        "rotateX": 600,
        "rotateY": 600
      }
    }
  },
  "interactivity": {
    "detect_on": "canvas",
    "events": {
      "onhover": {
        "enable": true,
        "mode": "bubble"
      },
      "onclick": {
        "enable": true,
        "mode": "repulse"
      },
      "resize": true
    },
    "modes": {
      "grab": {
        "distance": 400,
        "line_linked": {
          "opacity": 1
        }
      },
      "bubble": {
        "distance": 250,
        "size": 0,
        "duration": 2,
        "opacity": 0,
        "speed": 3
      },
      "repulse": {
        "distance": 400,
        "duration": 0.4
      },
      "push": {
        "particles_nb": 4
      },
      "remove": {
        "particles_nb": 2
      }
    }
  },
  "retina_detect": true
});
<?php elseif($_slider[0]->type=='particle_bubble' or (isset($params->introbgeffect) && $params->introbgeffect=='particle_bubble')) : ?>
particlesJS("particles-js<?php echo intval($_id); ?>", {
  "particles": {
    "number": {
      "value": 6,
      "density": {
        "enable": true,
        "value_area": 800
      }
    },
    "color": {
      "value": "#1b1e34"
    },
    "shape": {
      "type": "polygon",
      "stroke": {
        "width": 0,
        "color": "#000"
      },
      "polygon": {
        "nb_sides": 6
      },
      "image": {
        "src": "img/github.svg",
        "width": 100,
        "height": 100
      }
    },
    "opacity": {
      "value": 0.3,
      "random": true,
      "anim": {
        "enable": false,
        "speed": 1,
        "opacity_min": 0.1,
        "sync": false
      }
    },
    "size": {
      "value": 160,
      "random": false,
      "anim": {
        "enable": true,
        "speed": 10,
        "size_min": 40,
        "sync": false
      }
    },
    "line_linked": {
      "enable": false,
      "distance": 200,
      "color": "#ffffff",
      "opacity": 1,
      "width": 2
    },
    "move": {
      "enable": true,
      "speed": 8,
      "direction": "none",
      "random": false,
      "straight": false,
      "out_mode": "out",
      "bounce": false,
      "attract": {
        "enable": false,
        "rotateX": 600,
        "rotateY": 1200
      }
    }
  },
  "interactivity": {
    "detect_on": "canvas",
    "events": {
      "onhover": {
        "enable": false,
        "mode": "grab"
      },
      "onclick": {
        "enable": false,
        "mode": "push"
      },
      "resize": true
    },
    "modes": {
      "grab": {
        "distance": 400,
        "line_linked": {
          "opacity": 1
        }
      },
      "bubble": {
        "distance": 400,
        "size": 40,
        "duration": 2,
        "opacity": 8,
        "speed": 3
      },
      "repulse": {
        "distance": 200,
        "duration": 0.4
      },
      "push": {
        "particles_nb": 4
      },
      "remove": {
        "particles_nb": 2
      }
    }
  },
  "retina_detect": true
});
<?php elseif($_slider[0]->type=='nyan_cat' or (isset($params->introbgeffect) && $params->introbgeffect=='nyan_cat')) : ?>
particlesJS("particles-js<?php echo intval($_id); ?>", {
  "particles": {
    "number": {
      "value": 100,
      "density": {
        "enable": false,
        "value_area": 800
      }
    },
    "color": {
      "value": "#ffffff"
    },
    "shape": {
      "type": "star",
      "stroke": {
        "width": 0,
        "color": "#000000"
      },
      "polygon": {
        "nb_sides": 5
      },
      "image": {
        "src": "http://wiki.lexisnexis.com/academic/images/f/fb/Itunes_podcast_icon_300.jpg",
        "width": 100,
        "height": 100
      }
    },
    "opacity": {
      "value": 0.5,
      "random": false,
      "anim": {
        "enable": false,
        "speed": 1,
        "opacity_min": 0.1,
        "sync": false
      }
    },
    "size": {
      "value": 4,
      "random": true,
      "anim": {
        "enable": false,
        "speed": 40,
        "size_min": 0.1,
        "sync": false
      }
    },
    "line_linked": {
      "enable": false,
      "distance": 150,
      "color": "#ffffff",
      "opacity": 0.4,
      "width": 1
    },
    "move": {
      "enable": true,
      "speed": 14,
      "direction": "left",
      "random": false,
      "straight": true,
      "out_mode": "out",
      "bounce": false,
      "attract": {
        "enable": false,
        "rotateX": 600,
        "rotateY": 1200
      }
    }
  },
  "interactivity": {
    "detect_on": "canvas",
    "events": {
      "onhover": {
        "enable": false,
        "mode": "grab"
      },
      "onclick": {
        "enable": true,
        "mode": "repulse"
      },
      "resize": true
    },
    "modes": {
      "grab": {
        "distance": 200,
        "line_linked": {
          "opacity": 1
        }
      },
      "bubble": {
        "distance": 400,
        "size": 40,
        "duration": 2,
        "opacity": 8,
        "speed": 3
      },
      "repulse": {
        "distance": 200,
        "duration": 0.4
      },
      "push": {
        "particles_nb": 4
      },
      "remove": {
        "particles_nb": 2
      }
    }
  },
  "retina_detect": true
});

<?php elseif($_slider[0]->type=='blade') : ?>

<?php elseif($_slider[0]->type=='stars' || ($_slider[0]->type=='intro' and isset($params->introbgeffect) and $params->introbgeffect=='stars')) : ?>

var mainArea = document.getElementById("particles-js<?php echo intval($_id); ?>");
var createCanvas = mainArea.appendChild(document.createElement('canvas'));
createCanvas.setAttribute("id", "space");
createCanvas.style.width = "100%";
createCanvas.style.height = "100%";

window.requestAnimFrame = (function(){   return  window.requestAnimationFrame})();
var canvas = document.getElementById("space");
var c = canvas.getContext("2d");

var numStars = 1900;
var radius = '0.'+Math.floor(Math.random() * 9) + 1  ;
var focalLength = canvas.width *2;
var warp = 0;
var centerX, centerY;

var stars = [], star;
var i;

var animate = true;

initializeStars();

function executeFrame(){
  
  if(animate)
    requestAnimFrame(executeFrame);
  moveStars();
  drawStars();
}

function initializeStars(){
  centerX = canvas.width / 2;
  centerY = canvas.height / 2;
  
  stars = [];
  for(i = 0; i < numStars; i++){
    star = {
      x: Math.random() * canvas.width,
      y: Math.random() * canvas.height,
      z: Math.random() * canvas.width,
      o: '0.'+Math.floor(Math.random() * 99) + 1
    };
    stars.push(star);
  }
}

function moveStars(){
  for(i = 0; i < numStars; i++){
    star = stars[i];
    star.z--;
    
    if(star.z <= 0){
      star.z = canvas.width;
    }
  }
}

function drawStars(){
  var pixelX, pixelY, pixelRadius;
  
  // Resize to the screen
  if(canvas.width != window.innerWidth || canvas.width != window.innerWidth){
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    initializeStars();
  }
  
  if(warp==0)
  {c.fillStyle = "rgba(0,10,20,1)";
  c.fillRect(0,0, canvas.width, canvas.height);}
  c.fillStyle = "rgba(209, 255, 255, "+radius+")";
  for(i = 0; i < numStars; i++){
    star = stars[i];
    
    pixelX = (star.x - centerX) * (focalLength / star.z);
    pixelX += centerX;
    pixelY = (star.y - centerY) * (focalLength / star.z);
    pixelY += centerY;
    pixelRadius = 1 * (focalLength / star.z);
    
    c.fillRect(pixelX, pixelY, pixelRadius, pixelRadius);
    c.fillStyle = "rgba(209, 255, 255, "+star.o+")";
    //c.fill();
  }
}
executeFrame();
<?php endif; ?>
});


var mainId = '<?php echo "particles-js".intval($_id); ?>';
var <?php echo str_replace('-','_',$_slider[0]->type); ?>_mainId = '<?php echo "particles-js".intval($_id); ?>';

<?php if($_slider[0]->type=='tagcanvas') : //code for tagcanvas ?>
	<?php if(isset($params->tagcanvas->textcolor) && $params->tagcanvas->textcolor!=''): ?>
	var tagcanvas_text_color = '<?php echo $params->tagcanvas->textcolor; ?>';
	<?php endif; ?>

	<?php if(isset($params->tagcanvas->outlinecolor) && $params->tagcanvas->outlinecolor!=''): ?>
	var tagcanvas_outline_color = '<?php echo $params->tagcanvas->outlinecolor; ?>';
	<?php endif; ?>
<?php endif ?>

<?php if($_slider[0]->type=='intro'): ?>
	var warp_speed_mainId = '<?php echo "particles-js".intval($_id); ?>';
	var rising_cubes_mainId = '<?php echo "particles-js".intval($_id); ?>';
	var rays_particles_mainId = '<?php echo "particles-js".intval($_id); ?>';
	var matrix_mainId = '<?php echo "particles-js".intval($_id); ?>';
<?php endif; ?>

<?php if($_slider[0]->type=='electric_clock'): ?>
	var electric_clock_mainId = '<?php echo "particles-js".intval($_id); ?>';

<?php endif; ?>

<?php if($_slider[0]->type=='line'): ?>
	var line_mainId = '<?php echo "particles-js".intval($_id); ?>';

<?php endif; ?>

<?php if($_slider[0]->type=='liquid_landscape'): ?>
	var liquid_landscape_mainId = '<?php echo "particles-js".intval($_id); ?>';
<?php endif; ?>

<?php if($_slider[0]->type=='chaos'): ?>
	var chaos_mainId = '<?php echo "particles-js".intval($_id); ?>';
<?php endif; ?>
<?php if($_slider[0]->type=='corruption'): ?>
	var corruption_mainId = '<?php echo "particles-js".intval($_id); ?>';
<?php endif; ?>

<?php if($_slider[0]->type=='helix_multiple'): ?>
	var helix_multiple_mainId = '<?php echo "particles-js".intval($_id); ?>';
<?php endif; ?>

<?php if($_slider[0]->type=='distance'): ?>
	var distance_mainId = '<?php echo "particles-js".intval($_id); ?>';
<?php endif; ?>



<?php if($_slider[0]->type=='daynight') : ?>
var imgurl = '<?php echo QCLD_SLIDERHERO_IMAGES; ?>';
function intit_cloud(){
	var mainId = '<?php echo "particles-js".intval($_id); ?>';
	var xheight = '<?php echo esc_attr($style->height); ?>';
	<?php 
		if(isset($style->screenoption) and $style->screenoption=='2'){
	?>
		xheight = window.innerHeight;
	<?php }?>

	
	onWindowResize(mainId,xheight);
	animate(mainId);
	window.addEventListener( 'mousemove', onDocumentMouseMove );
}
<?php endif; ?>

<?php if($_slider[0]->type=='tiny_galaxy') : 
	if(isset($params->tiny_galaxy->meterial_color)&&$params->tiny_galaxy->meterial_color!=''){
?>
	var herometerialcolor = '<?php echo $params->tiny_galaxy->meterial_color; ?>';
<?php 
	}else{
?>
	var herometerialcolor = 0xa7a100;
<?php
	}
?>
<?php endif; ?>

<?php if($_slider[0]->type=='matrix' or $_slider[0]->type=='intro') : 
	if(isset($params->matrix->meterial_color)&&$params->matrix->meterial_color!=''){
?>
	var heromatrixcolor = '<?php echo $params->matrix->meterial_color; ?>';
<?php
	}else{
?>
	var heromatrixcolor = '#0f0';
<?php
	}
?>
<?php endif; ?>

//helix
<?php if($_slider[0]->type=='helix') : 
	if(isset($params->background)&&$params->background!=''):
?>
	var helix_color = '<?php echo $params->background; ?>';
<?php else: ?>
	var helix_color = "#201624";
<?php endif; ?>
	var helixmaxdot = <?php echo (isset($params->helix->maxdot)&&$params->helix->maxdot>0?$params->helix->maxdot:'1000'); ?>;
	var helixspeed = <?php echo (isset($params->helix->speed)&&$params->helix->speed>0?$params->helix->speed:'2.5'); ?>;
<?php endif; ?>

<?php if($_slider[0]->type=='corruption') : 
	if(isset($params->background)&&$params->background!=''):
?>
	var helix_color = '<?php echo $params->background; ?>';
<?php else: ?>
	var helix_color = "#201624";
<?php endif; ?>
<?php endif; ?>

<?php if($_slider[0]->type=='chaos') : 
	if(isset($params->background)&&$params->background!=''):
?>
	var helix_color = '<?php echo $params->background; ?>';
<?php else: ?>
	var helix_color = "#201624";
<?php endif; ?>
<?php endif; ?>

//Microcosm effect
<?php if($_slider[0]->type=='microcosm') : ?>
	var microcosmbgcolor = '#000155';
	<?php if(isset($params->background)&&$params->background!=''): ?>
		var microcosmbgcolor = '<?php echo $params->background; ?>';
	<?php endif; ?>
<?php endif; ?>

<?php if($_slider[0]->type=='helix_multiple') : 
	if(isset($params->background)&&$params->background!=''):
?>
	var helix_color = '<?php echo $params->background; ?>';
<?php else: ?>
	var helix_color = "#201624";
<?php endif; ?>
<?php endif; ?>

<?php if($_slider[0]->type=='squidematics') : 
	if(isset($params->background)&&$params->background!=''):
?>
	var squidematics_color = '<?php echo $params->background; ?>';
<?php else: ?>
	var squidematics_color = 'rgba(0, 0, 0, 0.3)';
<?php endif; ?>
<?php endif; ?>


//code for water Swimming config//

<?php if($_slider[0]->type=='water_swimming') : 
	//min value
	if(isset($params->water_swimming->mini)&&$params->water_swimming->mini!=''):
?>
	var water_swimming_min = <?php echo $params->water_swimming->mini; ?>;
<?php else: ?>
	var water_swimming_min = 3;
<?php endif; ?>


<?php 
//max value
if(isset($params->water_swimming->maxi)&&$params->water_swimming->maxi!=''):
?>
	var water_swimming_max = <?php echo $params->water_swimming->maxi; ?>;
<?php else: ?>
	var water_swimming_max = 30;
<?php endif; ?>

<?php endif; ?>

//Warp Speed
<?php if($_slider[0]->type=='warp_speed' || $_slider[0]->type=='intro') : ?>
	var stars_count = <?php echo (isset($params->warp_speed->stars)&&$params->warp_speed->stars>0?$params->warp_speed->stars:'1000'); ?>;

<?php endif; ?>

//Line
<?php if($_slider[0]->type=='line') : ?>
	var total_line_number = <?php echo (isset($params->line->line)&&$params->line->line>0?$params->line->line:'16'); ?>;

<?php endif; ?>
//Circle
<?php if($_slider[0]->type=='circle') : ?>
	var total_circle = <?php echo (isset($params->circle->circle)&&$params->circle->circle>0?$params->circle->circle:'16'); ?>;

<?php endif; ?>
//waaave
<?php if($_slider[0]->type=='waaave') : ?>
	var density = <?php echo (isset($params->waaave->density)&&$params->waaave->density>0?$params->waaave->density:'50'); ?>;

<?php endif; ?>

//Ballsgravity
<?php if($_slider[0]->type=='ballsgravity') : ?>
	var total_balls = <?php echo (isset($params->ballsgravity->balls)&&$params->ballsgravity->balls>0?$params->ballsgravity->balls:'300'); ?>;

<?php endif; ?>

//iconsahedron
<?php if($_slider[0]->type=='iconsahedron') : ?>
	var icondensity = <?php echo (isset($params->iconsahedron->density)&&$params->iconsahedron->density>0?$params->iconsahedron->density:'50'); ?>;

<?php endif; ?>

//corruption
<?php if($_slider[0]->type=='corruption') : ?>
	var dotsize = <?php echo (isset($params->corruption->size)&&$params->corruption->size>0?$params->corruption->size:'56'); ?>;
	var dotspeed = <?php echo (isset($params->corruption->speed)&&$params->corruption->speed>0?$params->corruption->speed:'0.2'); ?>;

<?php endif; ?>
//chaos
<?php if($_slider[0]->type=='chaos') : ?>
	var dotsize = <?php echo (isset($params->chaos->size)&&$params->chaos->size>0?$params->chaos->size:'56'); ?>;
	var dotspeed = <?php echo (isset($params->chaos->speed)&&$params->chaos->speed>0?$params->chaos->speed:'0.2'); ?>;

<?php endif; ?>

//helix_multiple
<?php if($_slider[0]->type=='helix_multiple') : ?>
	var dotsize = <?php echo (isset($params->helix_multiple->size)&&$params->helix_multiple->size>0?$params->helix_multiple->size:'56'); ?>;
	var dotspeed = <?php echo (isset($params->helix_multiple->speed)&&$params->helix_multiple->speed>0?$params->helix_multiple->speed:'1'); ?>;

<?php endif; ?>

//neno_hexagon
<?php if($_slider[0]->type=='neno_hexagon') : ?>
	var hexalen = <?php echo (isset($params->neno_hexagon->len)&&$params->neno_hexagon->len>0?$params->neno_hexagon->len:'20'); ?>;
<?php endif; ?>

//cosmic_web
<?php if($_slider[0]->type=='cosmic_web') : ?>
var cosmicbgcolor = '#000';
	var cosmicdot = <?php echo (isset($params->cosmic_web->dot)&&$params->cosmic_web->dot>0?$params->cosmic_web->dot:'50'); ?>;
<?php if(isset($params->background)&&$params->background!=''): ?>
	var cosmicbgcolor = '<?php echo $params->background; ?>';
<?php endif; ?>
<?php if(isset($params->cosmic_web->bgcolor)&&$params->cosmic_web->bgcolor!=''): ?>
	var cosmicbgcolor = '<?php echo $params->cosmic_web->bgcolor; ?>';
<?php endif; ?>

<?php endif; ?>
//directional
<?php if($_slider[0]->type=='directional') : ?>
	var directionalparticles = <?php echo (isset($params->directional->particle)&&$params->directional->particle>0?$params->directional->particle:'1000'); ?>;
<?php endif; ?>

//distance
<?php if($_slider[0]->type=='distance') : ?>
	var distanceparticles = <?php echo (isset($params->distance->particle)&&$params->distance->particle>0?$params->distance->particle:'100'); ?>;
	var distancefrequency = <?php echo (isset($params->distance->frequency)&&$params->distance->frequency>0?$params->distance->frequency:'200'); ?>;
<?php if(isset($params->background)&&$params->background!=''): ?>
	var distancebgcolor = '<?php echo $params->background; ?>';
<?php else: ?>
var distancebgcolor = '#000';
<?php endif; ?>

<?php endif; ?>

//valentine
<?php if($_slider[0]->type=='valentine') : ?>
	var valentineparticle = <?php echo (isset($params->valentine->particle)&&$params->valentine->particle>0?$params->valentine->particle:'42'); ?>;
	
<?php endif; ?>


//WaterDropLet
<?php if($_slider[0]->type=='waterdroplet') : ?>
	var waterdropshine = '<?php echo QCLD_SLIDERHERO_IMAGES; ?>/shine.png';
	var waterdropalpha = '<?php echo QCLD_SLIDERHERO_IMAGES; ?>/alpha.png';
<?php if(@$bg_image_url!=''): ?>
	var waterdropbackground = '<?php echo $bg_image_url; ?>';
	var waterdropforeground = '<?php echo $bg_image_url; ?>?duplicate';
<?php else: ?>
	var waterdropbackground = '<?php echo QCLD_SLIDERHERO_IMAGES; ?>/background.jpg';
	var waterdropforeground = '<?php echo QCLD_SLIDERHERO_IMAGES; ?>/foreground.jpg';
<?php endif; ?>
	
<?php endif; ?>


<?php if($_slider[0]->type=='liquid_landscape') : 
	if(isset($params->background)&&$params->background!=''):
?>
	var liquid_landscape_bg = '<?php echo $params->background; ?>';
<?php else: ?>
	var liquid_landscape_bg = 0x8300b9;
<?php endif; ?>
<?php endif; ?>


<?php if($_slider[0]->type=='water') :  //water effect settings
	if(isset($params->watereffect->color)&&$params->watereffect->color!=''):
?>
	var watercolor = '<?php echo $params->watereffect->color; ?>';
<?php else: ?>
	var watercolor = '#000';
<?php endif; ?>
<?php endif; ?>

<?php if($_slider[0]->type=='rays_particles' or $_slider[0]->type=='intro') : 
	if(isset($params->background)&&$params->background!=''):
?>
	var rays_particles_bg = '<?php echo $params->background; ?>';
<?php else: ?>
	var rays_particles_bg = 'rgb(134, 101, 159)';
<?php endif; ?>

<?php if(isset($params->rays_particles->particles)&&$params->rays_particles->particles!=''): ?>
var ray_particles = <?php echo $params->rays_particles->particles; ?>;
<?php else:?>
var ray_particles = 100;
<?php endif; ?>
<?php endif; ?>

<?php 
$customjs = get_option( 'sh_plugin_options' );
echo html_entity_decode($customjs['sh_custom_js']);
?>

</script>

 <?php
if(isset($params->titleffect) and $params->titleffect=='hero_matrix'):
?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/hero_button_matrix.js"; ?>"></script>
<?php endif; ?>

 <?php
if(isset($params->titleffect) and $params->titleffect=='hero_shuffle'):
?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/hero_shuffle.js"; ?>"></script>
<?php endif; ?>

 <?php
if(isset($params->titleffect) and $params->titleffect=='hero_rearrange'):
?>
<script src="<?php echo QCLD_SLIDERHERO_JS . "/hero_rearrange.js"; ?>"></script>
<?php endif; ?>

<?php if(isset($params->bgimageeffect) && $params->bgimageeffect=='ken-burn' && $bg_image_url!=''): ?>

<script type="text/javascript">

jQuery(document).ready(function($) {

	/* 
	 * Maintain Ratio & position
	 */
	var maintainRatio = function(){
		// Get measurements
		var wrapperWidth = $("#particles-js<?php echo intval($_id); ?>").width();
		var wrapperHeight = $("#particles-js<?php echo intval($_id); ?>").height();
		var wrapperRatio = wrapperWidth/wrapperHeight;
		var imageWidth = $("#particles-js<?php echo intval($_id); ?> img").width();
		var imageHeight = $("#particles-js<?php echo intval($_id); ?> img").height();
		var imageRatio = imageWidth/imageHeight;

		// Set CSS to center image in wrapper
		$("#particles-js<?php echo intval($_id); ?> img").css({
			"top": "50%",
			"left": "50%"
		});

		// Set CSS properties of current image
		if(wrapperRatio < imageRatio){
			$("#particles-js<?php echo intval($_id); ?> img").css({
				"height": wrapperHeight,
				"width": wrapperHeight*imageRatio,
				"margin-top": -(wrapperHeight/2),
				"margin-left": -(wrapperHeight*imageRatio/2)
			});
		}
		else{
			$("#particles-js<?php echo intval($_id); ?> img").css({
				"height": wrapperWidth*(1/imageRatio),
				"width": wrapperWidth,
				"margin-top": -(wrapperWidth*(1/imageRatio)/2),
				"margin-left": -(wrapperWidth/2),
			});
		}		
	}

	/*
	 * Scale effect (CSS3)
	 */
	 var scale = function(factor,time){
	 	$("#particles-js<?php echo intval($_id); ?> img").css({
		  "-webkit-transform": "scale(" + factor + ")",  // Safari 3.1+, Chrome 
		     "-moz-transform": "scale(" + factor + ")",  // Firefox 3.5+ 
		      "-ms-transform": "scale(" + factor + ")",  // IE9+ 
		       "-o-transform": "scale(" + factor + ")",  // Opera 10.50+ 
		          "transform": "scale(" + factor + ")",
		 "-webkit-transition": "-webkit-transform " + time + "s ease-in-out",  // Safari 3.2+, Chrome 
		    "-moz-transition": "-webkit-transform " + time + "s ease-in-out",  // Firefox 4-15 
		      "-o-transition": "-webkit-transform " + time + "s ease-in-out",  // Opera 10.5–12.00 
		         "transition": "-webkit-transform " + time + "s ease-in-out"  // Firefox 16+, Opera 12.50+ 
	 	});
	 }


	/*
	 * After images are loaded
	 */
	$(window).on( 'load', function(){
		// maximize and center image while maintaining image ratio
		maintainRatio();
		// scale and animate
		scale(1.5,20);
	})


	/*
	 * While window is being resize
	 */
	$(window).resize(function() {
		// maximize and center image while maintaining image ratio
		maintainRatio();
	});

});

</script>
<?php endif; ?>

<?php //youtube video background
if(isset($params->video)&& $params->video=='youtube'): 
	if(isset($params->bg_video_youtube)&& $params->bg_video_youtube!=''):
?>
<script src="https://www.youtube.com/iframe_api"></script>
<script type="text/javascript">


var player;
function onYouTubeIframeAPIReady() {
    player = new YT.Player('hero_youtube_video', {
        width: 600,
        height: 400,
        videoId: '<?php echo $params->bg_video_youtube; ?>',
        playerVars: {
            color: 'white',
			autoplay: <?php echo (isset($params->show_cover_image) && $params->show_cover_image!=1?1:0); ?>,
			controls: 0,
			rel: 0,
			showinfo: 0,
			<?php if(isset($params->video_loop)&& $params->video_loop=='1'){ ?>
			loop: 1,
			playlist: '<?php echo $params->bg_video_youtube; ?>',
			<?php }else{ ?>
			loop: 0,
			<?php } ?>
			modestbranding: 1,
			<?php if(isset($params->video_mute)&& $params->video_mute=='1'){ ?>
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
	
	setTimeout(function(){
		console.log(player.getPlayerState());
		if(player.getPlayerState() > 0){
			jQuery(".hero_play_video_button").fadeOut();
			jQuery(".sh_video_preload").fadeOut();
		}else{
			//jQuery("#hero_ge_pause_button<?php echo intval($_id); ?>").click();
		}
	}, 1000)
	<?php endif; ?>
	
	
}
var herocounter<?php echo intval($_id);  ?> = 0;
function onPlayerStateChange(e) {

	if(herocounter<?php echo intval($_id);  ?> == 0){
		setTimeout(function(){
			herocounter<?php echo intval($_id);  ?>++;
			console.log(player.getPlayerState());
			if(player.getPlayerState() > 0){
				//jQuery(".hero_play_video_button").fadeOut();
				//jQuery(".sh_video_preload").fadeOut();
			}else{
				//jQuery("#hero_ge_pause_button<?php echo intval($_id); ?>").click();
			}
		}, 100)
	}
	
	if (e.data === YT.PlayerState.ENDED) {
		player.setPlaybackQuality('hd1080');
		player.playVideo(); 
		
	}
}

jQuery(window).on('load', function($){
	jQuery(document).on('click', '.qcld_hero_content_area', function(e){
		player.playVideo();
	})
	
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
<?php 
	endif;
endif;
?>
<?php if(isset($params->audioautoplay) && $params->audioautoplay==1): ?>
<script type="text/javascript">
jQuery(window).on('load', function($){

    setTimeout(function(){
      
      if(jQuery('#hero_audio').length>0){

        if( jQuery('#hero_audio')[0].paused ){

          setTimeout(function(){
            jQuery('#hero_audio')[0].play().then(function(e){
              console.log('audio playing smooth');
				      jQuery('#hero_control_play').hide();
				      jQuery('#hero_control_pause').show();
              
            }).catch(function(e){
              console.log('audio not playing');
            })
          },2000)

        }
        
      }
      
    }, 1000)
    
})
</script>
<?php endif; ?>

