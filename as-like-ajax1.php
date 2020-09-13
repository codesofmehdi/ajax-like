<?php
/*
Plugin Name:as-like-post
Author:Rouhollah Asadi
Author URI:asadiui.ir
 */
/**
 * 
 */
add_action( 'wp_enqueue_scripts', 'ajax_like_script_func');
function ajax_like_script_func()
{
	wp_enqueue_script( 'ajax-love', plugins_url( '/love.js', __FILE__ ), array('jquery'), false, true);
	wp_localize_script( 'ajax-love', 'ajaxtut',array('ajax_url'=>admin_url('admin-ajax.php')));	
}
/**
 * 
 */
add_filter( 'the_content','add_ajax_btn_love_func', 99, 1 );
function add_ajax_btn_love_func($content){
	$love_counts="";
	if(is_single()){
		$love_counts=get_post_meta(get_the_ID(),'_love_count',true);
		$love_counts = (empty($love_counts) ? '0' : $love_counts);
		$love_counts_btn='<div class="love-send"><a href="#" data-id="'.get_the_ID().'"> I like this post '.$love_counts.'</a></div>';
		return $content.$love_counts_btn;
	}
	return $content;
}
/**
 * 
 */
add_action('wp_ajax_data_save_func','data_save_func');
add_action('wp_ajax_nopriv_data_save_func','data_save_func');
function data_save_func()
{
	$love_count = get_post_meta($_POST['post_id'],'_love_count',true);
	$love_count++;
	update_post_meta($_POST['post_id'],'_love_count',$love_count);
	print_r($love_count);
	die();
}