<?php if (post_password_required()) return; ?>
        
    <div class="content_comments">
        <div id="comments" class="comments">

            <?php if(have_comments()){ ?>
                <div>
                    <h4 class="number-comments"> 
                        <?php comments_number( esc_html__('0 Comments', 'muzze'), esc_html__( '1 Comment', 'muzze' ), esc_html__( '% Comments', 'muzze' ) ); ?>
                    </h4>
                </div>

            <?php } ?>

            <?php if (have_comments()) { ?>
                <ul class="commentlists">
                    <?php wp_list_comments('callback=muzze_theme_comment'); ?>
                </ul>
                <?php
                // Are there comments to navigate through?

                if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
                    <footer class="navigation comment-navigation" role="navigation">
                        <div class="nav_comment_text"><?php esc_html_e( 'Comment navigation', 'muzze' ); ?></div>
                        <div class="previous"><?php previous_comments_link(__('&larr; Older Comments', 'muzze')); ?></div>
                        <div class="next right"><?php next_comments_link(__('Newer Comments &rarr;', 'muzze')); ?></div>
                    </footer><!-- .comment-navigation -->
                <?php endif; // Check for comment navigation ?>

                <?php if (!comments_open() && get_comments_number()) : ?>
                    <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'muzze' ); ?></p>
                <?php endif; ?>
                
            <?php } ?>

            <?php

            $comment_args = array(
                'title_reply' => wp_kses('<span class="title-comment second_font">' . esc_html__( 'Add Your Comment', 'muzze' ) . '</span>', true),
                'fields' => apply_filters('comment_form_default_fields', array(
                    'author' => '<div class="author"><label>'.esc_html__('Name', 'muzze').'</label><input type="text" name="author" value="' . esc_attr($commenter['comment_author']) . '"  class="form-control" /></div>',
                    'email' => '<div class="email"><label>'.esc_html__('Email', 'muzze').'</label><input type="text" name="email" value="' . esc_attr($commenter['comment_author_email']) . '"  class="form-control" /></div>',
                    
                )),
                'comment_field' => '<div class="text-comment"><label>'.esc_html__('Your comment', 'muzze').'</label><textarea class="form-control" rows="7" name="comment" ></textarea></div>',
                'label_submit' => esc_html__('Post Comment','muzze'),
                'comment_notes_before' => '',
                'comment_notes_after' => '',
            );
            ?>

            <?php global $post; ?>
            <?php if ('open' == $post->comment_status) { ?>
                <div class="wrap_comment_form">
                    <div class="row">
                        <div class="col-md-12">
                            <?php comment_form($comment_args); ?>        
                        </div>
                    </div>
                </div><!-- end commentform -->
            <?php } ?>


        </div><!-- end comments -->
    </div>