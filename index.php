<?php
/*
Plugin Name: Email to MailPoet
Plugin URI: https://github.com/excion/Email-to-MailPoet
Description: Adds an email specified via GET to a MailPoet list(s).
Version: 1.0
Author: Aubrey Portwood of Excion
Author URI: http://excion.co/aubreypwd
License: GPL2
*/

/*  Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : PLUGIN AUTHOR EMAIL)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Resource:
// http://support.mailpoet.com/knowledgebase/plugin-form-integrate/

/**
 * Catch POST / GET data from a form and add the user to the MailPoet list.
 */
function rmftmpls_init() {

	// Do not continue if MailPoet is not installed.
	if( ! class_exists('WYSIJA') ){
		return;
	}

	// If the special action is being sent and all the requirements
	// are there.
	if(
		isset( $_REQUEST['form_to_mailpoet'] ) 
			&& $_REQUEST['form_to_mailpoet'] != ''

		&& isset( $_REQUEST['email'] ) 
			&& $_REQUEST['email'] != ''

		&& isset( $_REQUEST['list_id'] ) 
			&& $_REQUEST['list_id'] != '' 

		&& isset( $_REQUEST['admin_email'] ) 
			&& $_REQUEST['admin_email'] != ''
	) {

		// The admin email without the @ sign (compatible with Gravity Forms)
		$admin_email = str_replace(
			'@',
			'',
			get_option( 'admin_email' )
		);

		// The verify email without the @ for the same reason.
		$verify_admin_email = str_replace(
			'@',
			'',
			$_REQUEST['admin_email']
		);

		// Check if the admin email matches
		if( $admin_email != $verify_admin_email ) {
			wp_die( __( 'Something is wrong, 
							please double-check your information.' ) );
		}

		// Get the Data.
		$list_id = 	$_REQUEST['list_id'];
		$email = 	$_REQUEST['email'];

		// Get the lists
		$lists = explode( ',', $list_id );

		// If there are many lists, compile them into an array.
		if( is_array($lists) ){

			// If we just have one list, add a fake
			// second one so it will actually add it. (HACK)
			if( sizeof($lists) == 1){
				$lists[] = 9999999;
			}

			// Make sure all the lists are numerical.
			foreach( $lists as $list_id ) {
				if( ! is_numeric( $list_id ) ){
					wp_die( __('All of the list_id\'s need to be numerical.') );
				}
			}

		}else{
			// We should never have a
			wp_die( __('Something went wrong, check your GET data.') );
		}

		// Setup the MailPoet Data.
		$mp_data = array(
			
			// The Email.
			'user' => array(
				'email' => $email
			),

			// List ID.
			'user_list' => array(
				'list_ids' => $lists
			)
		);

		// Add the mp_data (new email) to the list.
		$mailpoet = WYSIJA::get( 'user', 'helper' );
		$mailpoet->addSubscriber( $mp_data );

		// Go back.
		if( isset( $_REQUEST['redirect_to'] ) ){
			wp_redirect( $_REQUEST['redirect_to'] );
		}else{
			// Do nothing.
		}

		var_dump($lists); exit;

	// If we don't have all the requirements.
	}elseif( isset( $_REQUEST['form_to_mailpoet'] ) ){
		wp_die(
			__( 'Sorry, but the <strong>email</strong> and <strong>list_id
				</strong> are required.' ) 
		);
	}else{
		// Do nothing.
	}
}

add_action( 'init', 'rmftmpls_init' );

?>