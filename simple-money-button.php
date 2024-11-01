<?php

/**
Plugin Name: Simple Money Button
Plugin URI:  https://kuopassa.net/simmonbut
Description: Create simple Money Button shortcodes.
Version:     0.3
Author:      kuopassa
Author URI:  https://kuopassa.net/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: simmonbut
Domain Path: 
 
{Plugin Name} is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
{Plugin Name} is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with {Plugin Name}. If not, see {License URI}.
*/

if (!defined('ABSPATH')) {

	die;
}

function simmonbut_shortcodes_init() {

	if (!function_exists('simmonbut_boolval')) {
		
		function simmonbut_boolval($candidate) {
			
			settype(
				$candidate,
				'string'
			);
			
			if (in_array(
				$candidate,
				array(
					'true',
					'1',
					'yes',
					'on',
					'enabled')
				)
			) {
			
				return true;
			}
			else {
			
				return false;
			}
		}
	}

	if (!function_exists('simmonbut_simple_money_button')) {
		
		function simmonbut_simple_money_button($attributes) {
			
			static $uid = 0;
			
			$uid++;
			
			$id = 'simmonbut_'.$uid;

			$attributes = shortcode_atts(
				array(
					'to'=>'',
					'amount'=>'1',
					'currency'=>'USD',
					'label'=>'',
					'successmessage'=>'Thank you!',
					'hideamount'=>false,
					'buttonid'=>'',
					'type'=>'tip',
					'editable'=>false,
					'disabled'=>false,
					'devmode'=>false,
					'clientIdentifier'=>'5342c3c2d05726efb6ecd1ea090d9468',
				),
				$attributes
			);
			
			$attributes['hideamount'] = simmonbut_boolval($attributes['hideamount']);
			$attributes['editable'] = simmonbut_boolval($attributes['editable']);
			$attributes['disabled'] = simmonbut_boolval($attributes['disabled']);
			$attributes['devmode'] = simmonbut_boolval($attributes['devmode']);
			
			settype(
				$attributes['to'],
				'string'
			);
			
			settype(
				$attributes['amount'],
				'string'
			);
			
			settype(
				$attributes['currency'],
				'string'
			);
			
			settype(
				$attributes['label'],
				'string'
			);
			
			settype(
				$attributes['successmessage'],
				'string'
			);
			
			settype(
				$attributes['hideamount'],
				'bool'
			);
			
			settype(
				$attributes['buttonid'],
				'string'
			);
			
			settype(
				$attributes['type'],
				'string'
			);
			
			settype(
				$attributes['editable'],
				'bool'
			);
			
			settype(
				$attributes['disabled'],
				'bool'
			);
			
			settype(
				$attributes['devmode'],
				'bool'
			);
			
			if (strcmp($attributes['type'],'buy') != 0) {
			
				$attributes['type'] = 'tip';
			}
			
			if ($uid == 1) {
				
				wp_enqueue_script(
					'simmonbut',
					'https://www.moneybutton.com/moneybutton.js',
					array(),
					null,
					'false'
				);
			}
			
			if (strlen($attributes['label']) == 0) {
			
				unset($attributes['label']);
			}
			elseif ((strlen($attributes['amount'])+strlen($attributes['label'])) > 20) {
				
				$attributes['label'] = substr(
					$attributes['label'],
					0,
					20-(strlen($attributes['amount'])+strlen($attributes['label']))
				);
			}
			
			$attributes['successMessage'] = $attributes['successmessage'];
			
			unset($attributes['successmessage']);
			
			if ($attributes['hideamount']) {
			
				$attributes['hideAmount'] = $attributes['hideamount'];
			}
			
			unset($attributes['hideamount']);
			
			if (strlen($attributes['buttonid']) > 0) {
			
				$attributes['buttonId'] = $attributes['buttonid'];
			}
			
			unset($attributes['buttonid']);
			
			if (!$attributes['disabled']) {
			
				unset($attributes['disabled']);
			}
			
			if ($attributes['devmode']) {
			
				$attributes['devMode'] = $attributes['devmode'];
			}
			
			unset($attributes['devmode']);
			
			$attributes = json_encode($attributes);
			
			wp_add_inline_script(
				'simmonbut',
				'moneyButton.render(document.getElementById("'.$id.'"),'.$attributes.');',
				'after'
			);
			
			return '<div id="'.$id.'"></div>';
		}
	}

	add_shortcode(
		'simple_money_button',
		'simmonbut_simple_money_button'
	);
}

add_action(
	'init',
	'simmonbut_shortcodes_init'
);