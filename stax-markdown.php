<?php
/*
Plugin Name: Stax Markdown
Plugin URI: 
Description:
Author:
Version: 0.1
Author URI: 
=== Copyright ===
Parsedown by erusev
* PHP markdown Library
* MIT License
* https://github.com/erusev/parsedown
*/

new staxMarkdown();

class staxMarkdown {

	public function __construct() {

#		// Plugin Activation
#		if ( function_exists( 'register_activation_hook' ) ) {
#			register_activation_hook( __FILE__, array( $this, 'activationHook' ) );
#		}
#
#		// Plugin Uninstall
#		if ( function_exists( 'register_uninstall_hook' ) ) {
#			register_uninstall_hook( __FILE__, 'Obliterate::uninstallHook' );
		remove_filter( 'the_content', 'wpautop' );
		remove_filter( 'the_content', 'capital_P_dangit' );
		remove_filter( 'the_content', 'wptexturize' );
		remove_filter( 'the_content', 'convert_smilies' );

		add_filter( 'the_content', array( $this, 'markdown') );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_css' ) );
		add_filter( 'post_class', array( $this, 'add_post_class' ) );
	}

	public function add_post_class( $classes ) {
		if ( ! is_single() ) {
			$classes[] = '';
		} 
		$classes[] = 'markdown-body';
		return $classes;
	}

	public function enqueue_css() {
		wp_enqueue_style( 'github-markdown-css', plugin_dir_url( __FILE__ ) . 'github-markdown.css' );	
	}

	public function markdown( $content ) {
		require_once ( 'lib/parsedown/Parsedown.php' );
		$Parsedown = new Parsedown();
		echo $Parsedown->text( $content ); 
		# 本文を分割する
#		return( $content );

//		$content = explode( "\n", $content );
#		$content = "\n" . $content;
#		$content = preg_replace( '/#{6} (.+?)\n/s', "<h6>$1</h6>\n", $content );
#		$content = preg_replace( '/#{5} (.+?)\n/s', "<h5>$1</h5>\n", $content );
#		$content = preg_replace( '/#{4} (.+?)\n/s', "<h4>$1</h4>\n", $content );
#		$content = preg_replace( '/#{3} (.+?)\n/s', "<h3>$1</h3>\n", $content );
#		$content = preg_replace( '/#{2} (.+?)\n/s', "<h2>$1</h2>\n", $content );
#		$content = preg_replace( '/#{1} (.+?)\n/s', "<h1>$1</h1>\n", $content );
#		$content = preg_replace( '/(```)(.+?)(```)/s', '<pre><code>$2</code></pre>', $content );
#		$content = preg_replace( '/`(.+?)`/s', '<code>$1</code>', $content );
#
#		// <li>置換
#		$content = preg_replace( '/(\t{1}| {4})\* (.+)(\n|\r\n|\r)/s', "<li>$2</li>\n", $content );
#		$content = preg_replace( '/\* (.+?)(\n|\r\n|\r)/', "\t<li>$1</li>\n", $content );
#		// <li>置換のあとに<ul>を挿入
#		$content = preg_replace( '/(\n|\r\n|\r){2}(\t<li>)(.+)/', "\n\n<ul>\n\t<li>$3", $content );
#		$content = preg_replace( '/(.+)(<\/li>)(\n|\r\n|\r){2}/', "$1</li>\n</ul>\n", $content );
#		// <li>入れ子に<ul>を挿入
#//		$content = preg_replace( '/(\t{1}|\s{4})(?!<ul>)(<li>)(.+)/', '<ul><li>$3', $content );
#
#		$content = preg_replace( '/\*(.+?)\*/s', '<em>$1</em>', $content );
#		$content = preg_replace( '/\[(.+?)\]\((.+?)\)/', '<a href="$2">$1</a>', $content );
#		// 末尾に2文字以上のスペース+改行でBRタグ挿入
#		$content = preg_replace( '/([\s\S]*?)([ ]{2,})(\n|\r\n|\r){1}/', "$1<br />\n", $content );
#		$content = preg_replace( '/([\n|\r\n|\r]*)(?![\s\S]*<h|<pre)([\s\S]*?)(\n|\r\n|\r){2}/', "\n<p>\n$2\n</p>\n\n", $content );
	}	


}
