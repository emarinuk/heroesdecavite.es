<div class="detail-blog-muzze">
	
	<?php $sticky_class = is_sticky()?'sticky':''; ?>

	<?php if( has_post_format('link') ){ ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('post-wrap '. $sticky_class); ?>  >
			
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

		<article id="post-<?php the_ID(); ?>" <?php post_class('post-wrap '. $sticky_class); ?>  >
				<div class="post-body">
			           <?php the_content(''); /* Display content  */ ?>
			    </div>
		</article>

	<?php }else{ ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('post-wrap '. $sticky_class); ?>  >
				
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


			    <div class="post-body">
			    	<div class="post-excerpt">
			            <?php muzze_content_body(); /* Display content of post or intro in category page */ ?>
			        </div>
			    </div>

			    <?php if(!is_single()){ ?> 
			            <?php muzze_content_readmore(); /* Display read more button in category page */ ?>
			    <?php }?>

			    <?php if(is_single()){ ?>
			    <?php muzze_content_tag_clone(); /* Display tags, category */ ?>
			    <?php } ?>

			    <?php $author_id = get_the_author_meta( 'ID' ); ?>
			    	<?php if( get_the_author_meta( 'user_description' ) != '' ){ ?>
				    	<div class="author_meta">
				    		<h2 class="title-author second_font"><?php esc_html_e('About Author', 'muzze') ?></h2>
				    		<div class="content-author">
				    			<div class="img">
				    			<?php echo get_avatar($author_id, $size='150', $default = 'mysteryman' ); ?>	
					    		</div>
					    		<div class="info">
					    			<a class="author_link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?> ">
					    				<?php echo get_the_author_meta( 'display_name' ); ?>
					    			</a>
					    			<div class="desc"><?php echo get_the_author_meta( 'user_description' ); ?> </div>
					    		</div>
				    		</div>
				    	</div>
			    	<?php } ?>
			    	<!-- end get_the_author_meta -->
		</article>

	<?php } ?>
</div>
