<?php 
$general_css = '';


/* Primary Font */
$default_primary_font = json_decode( muzze_default_primary_font() );
$primary_font = json_decode( get_theme_mod( 'primary_font' ) ) ? json_decode( get_theme_mod( 'primary_font' ) ) : $default_primary_font;
$primary_font_family = $primary_font->font;


/* General Typo */
$general_font_size = get_theme_mod( 'general_font_size', '16px' );
$general_line_height = get_theme_mod( 'general_line_height', '28px' );
$general_letter_space = get_theme_mod( 'general_letter_space', '0.2px' );
$general_color = get_theme_mod( 'general_color', '#555555' );



/* Primary Color */
$primary_color = get_theme_mod( 'primary_color', '#c1b696' );



/* Second Font */
$default_second_font = json_decode( muzze_default_second_font() );
$second_font = json_decode( get_theme_mod( 'second_font' ) ) ? json_decode( get_theme_mod( 'second_font' ) ) : $default_second_font;
$second_font_family = $second_font->font;


$general_css .= <<<CSS

body{
	font-family: {$primary_font_family};
	font-weight: 400;
	font-size: {$general_font_size};
	line-height: {$general_line_height};
	letter-spacing: {$general_letter_space};
	color: {$general_color};
}
p{
	color: {$general_color};
	line-height: {$general_line_height};
}

h1,h2,h3,h4,h5,h6, .second_font {
	font-family: {$second_font_family};
	letter-spacing: 0px;
}



.search_archive_event form .ovaev_submit:hover,
.archive_event .content .desc .event_post .button_event .book:hover,
.archive_event .content .desc .event_post .button_event .book.btn-free:hover, 
.single_exhibition .exhibition_content .line .wrapper_order .order_ticket .member:hover, 
.single_exhibition .exhibition_content .line .wrapper_order .order_ticket .button_order:hover,
.archive_collection .search_archive_coll #search_collection .ovacoll_submit:hover
{
	background-color: $primary_color;
	border-color: $primary_color;
}
.archive_event.type1 .content .date-event .date-month, 
.single_exhibition .title_top .back_event:hover, 
.single_event .title_top .back_event:hover,
.single_event .wrapper_order .order_ticket .share_social .share-social-icons li:hover a,
.single_exhibition .exhibition_content .line .wrapper_order .order_ticket .share_social .share-social-icons li:hover a,
.archive_collection .content_archive_coll.type1 .items_archive_coll .desc .title a:hover, 
.archive_collection .content_archive_coll.type2 .items_archive_coll .desc .title a:hover,
.archive_collection .content_archive_coll.type1 .items_archive_coll .desc .artists a:hover,
.archive_collection .content_archive_coll.type2 .items_archive_coll .desc .artists a:hover,
.single_collection .collection_intro .back_collections a:hover,
.archive_artist .content .items .name:hover,
.archive_artist .content .items .contact .phone:hover,
.archive_artist .content .items .contact .email:hover,
.single_artist .intro .desc .phone:hover,
.single_artist .intro .desc .email:hover,
.single_artist .work .wrap_archive_masonry .wrap_items .items .wrapper-content div:hover,
.sidebar .widget.widget_categories ul li a:hover, 
.sidebar .widget.widget_archive ul li a:hover, 
.sidebar .widget.widget_meta ul li a:hover, 
.sidebar .widget.widget_pages ul li a:hover, 
.sidebar .widget.widget_nav_menu ul li a:hover,
.sidebar .widget .ova-recent-post-slide .list-recent-post .item-recent-post .content h2.title a:hover,
.sidebar .widget.widget_tag_cloud .tagcloud a:hover,
.blog_header .link-all-blog:hover,
.blog_header .post-meta-content .post-author a:hover,
.blog_header .post-meta-content .categories a:hover,
.detail-blog-muzze .socials .socials-inner .share-social .share-social-icons li a:hover,
.content_comments .comments ul.commentlists li.comment .comment-body .ova_reply .comment-reply-link:hover,
.content_comments .comments ul.commentlists li.comment .comment-body .ova_reply .comment-edit-link:hover,
article.post-wrap .post-content .post-meta .post-meta-content .post-author a:hover, 
article.post-wrap .post-content .post-meta .post-meta-content .categories a:hover
{
	color: $primary_color;
}
.archive_event .content .desc .event_post .button_event .view_detail:hover
{
	border-color: $primary_color;
	color: $primary_color;
}
.archive_event.type2 .content .date-event .date,
.archive_event.type3 .content .date-event .date,
.single_event .wrapper_order .order_ticket .button_order:hover,
.single_event .event_content .tab-Location ul.nav li.nav-item a.active:after,
.single_event .event_content .tab-Location ul.nav li.nav-item a:hover:after,
.single_event .wrapper_order .order_ticket .share_social:hover i,
.single_exhibition .exhibition_content .line .wrapper_order .order_ticket .share_social:hover i,
.archive_artist .content .items .contact .email:hover:after,
.single_artist .intro .desc .email:hover:after,
.muzze_404_page .pnf-content .go_back:hover,
.content_comments .comments .comment-respond .comment-form p.form-submit #submit:hover
{
	background-color: $primary_color;
}






CSS;



return $general_css;


