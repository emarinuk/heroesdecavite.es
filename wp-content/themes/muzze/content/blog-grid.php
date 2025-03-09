<?php $sticky_class = is_sticky()?'sticky':''; ?>

<?php if( has_post_format('link') ){ ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post-wrap blog-default'. $sticky_class); ?>  >
		
			<?php
			        $link = get_post_meta( $post->ID, 'format_link_url', true );
			        $link_description = get_post_meta( $post->ID, 'format_link_description', true );
			        
			        if ( is_single() ) {
			                printf( '<h1 class="entry-title"><a href="%1$s" target="blank">%2$s</a></h1>',
			                        $link,
			                        get_the_title()
			                );
			        } else {
			                printf( '<h2 class="entry-title"><a href="%1$s" target="blank">%2$s</a></h2>',
			                        $link,
			                        get_the_title()
			                );
			        }
			?>
			<?php
			        printf( '<a href="%1$s" target="blank">%2$s</a>',
			                $link,
			                $link_description
			        );
			?>
	</article>

<?php }elseif ( has_post_format('aside') ){ ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post-wrap blog-default'. $sticky_class); ?>  >
			<div class="post-body">
		           <?php the_content(''); /* Display content  */ ?>
		    </div>
	</article>

<?php }else{ ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post-wrap blog-default grid-item'. $sticky_class); ?>  >
			
			<?php if( has_post_format('audio') ){ ?>

				 <div class="post-media">
		        	<?php muzze_postformat_audio(); /* Display video of post */ ?>
		        </div>

			<?php }elseif(has_post_format('gallery')){ ?>

				<?php muzze_content_gallery(); /* Display gallery of post */ ?>

			<?php }elseif(has_post_format('video')){ ?>

				 <div class="post-media">
		        	<?php muzze_postformat_video(); /* Display video of post */ ?>
		        </div>

			<?php }elseif(has_post_thumbnail()){ ?>

		        <div class="post-media">
		        	<?php muzze_content_thumbnail('full'); /* Display thumbnail of post */ ?>
		        </div>

	        <?php } ?>


		<div class="post-content">
			
			<div class="post-meta">
		        <?php muzze_content_meta_clone(); /* Display Date, Author, Comment */ ?>
		    </div>
		    
	        <div class="post-title">
	        	<h2 class="post-title">
			        <a class="second_font" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
			          <?php echo esc_html(muzze_custom_text(get_the_title(), 15)); ?>
			        </a>
		      	</h2>
		    </div>

		    <div class="post-body">
		    	<div class="post-excerpt">
		            <?php echo esc_html(muzze_custom_text(get_the_excerpt(), 20)); /* Display content of post or intro in category page */ ?>
		        </div>
		    </div>

		    <?php if(!is_single()){ ?> 
		            <?php muzze_content_readmore(); /* Display read more button in category page */ ?>
		    <?php }?>

		</div>
		<!-- end post-content -->
	</article>


<?php } ?>

