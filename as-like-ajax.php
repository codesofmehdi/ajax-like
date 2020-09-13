<?php
/*
Plugin Name: as-like-ajax
*/
add_action('wp_enqueue_scripts', 'enqueue_script_func');
function enqueue_script_func(){
	wp_enqueue_script( 'like-ajax', plugins_url('/asax-love.js',__FILE__), array('jquery'), false, true );
	wp_localize_script( 'like-ajax', 'ajaxtut', array('ajax_url'=>admin_url('admin-ajax.php')));
}

add_filter( 'the_content','add_btn_ajax_like_func' ,99,1 );
function add_btn_ajax_like_func($content){
	if(is_single()){
		$count_like=get_post_meta(get_the_ID(),'_love_count',true);
		$count_like = (empty($count_like))? '0': $count_like;
		$like_btn_ajax='<div class="love-send"><a href="#" data-id="'.get_the_ID().'"> I like the post'.$count_like.'</a></div>';
		return $content.$like_btn_ajax;
	}
	else
	{
		return $content;
	}
}
add_action( 'wp_ajax_testfunc', 'testfunc' );
add_action( 'wp_ajax_noprive_testfunc', 'testfunc' );

function testfunc()
{
	$count_like=get_post_meta($_GET['post_id'],'_love_count',true);
	$count_like++;
	update_post_meta( $_GET['post_id'], '_love_count', $count_like);
	print_r($count_like);
    die();
}

