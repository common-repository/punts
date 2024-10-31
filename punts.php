<?php
/*
Plugin Name: punts
Plugin URI: http://www.companysoler.com
Description: Publish punctuation on a post.
Version: 0.1
Author: Carles Company Soler
Author URI: http://www.companysoler.com

	Copyright 2005  Carles Company Soler  (email : e3128927@est.fib.upc.es)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

load_plugin_textdomain('punts');

class punts{
	function punts_content($content){
		$punts = get_post_custom_values('score');
		if(!empty($punts)){
			$puntsstring="";
			if($punts[0] > 5){
				$punts[0]=5;
			}elseif($punts[0] < 0){
				$punts[0]=0;
			}
			
			for ($i = 0; $i < $punts[0]; $i++){
				//Posar URL de l'imatge encesa.
				$puntsstring=$puntsstring."<img src='".get_settings('siteurl')."/wp-content/plugins/punts/estrella.png' alt='punt' />";
			}
			for ($i = $punts[0]; $i < 5; $i++){
				//Posar URL de l'imatge apagada.
				$puntsstring=$puntsstring."<img src='".get_settings('siteurl')."/wp-content/plugins/punts/apagat.png' alt='nopunt' />";
			}
			$content="<div style='border:1px black solid;margin-top:3px;padding:3px;width:200px;'>"._("Score: ").$puntsstring."</div>".$content;
		}
		return $content;
	}
	
	function punts_admin_menus(){
		add_options_page('Punts', 'Punts', 8, __FILE__, array('punts','punts_options_page'));
	}
	
	function punts_options_page() {
    	echo "<div class='wrap'><h2>Punts Options</h2>"._("There are no options")."</div>";
	}
}

add_filter('the_content',array('punts','punts_content'));
add_action('admin_menu', array('punts','punts_admin_menus'));
?>