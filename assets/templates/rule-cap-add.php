<div id="icon-options-general" class="icon32"></div> 

<div class="wrap">

	<h2 class="nav-tab-wrapper">
		<a href="<?php echo $urls['settings']; ?>" class="nav-tab"><?php _e( 'Settings', 'civi-wp-member-sync' ); ?></a>
		<a href="<?php echo $urls['list']; ?>" class="nav-tab nav-tab-active"><?php _e( 'Association Rules', 'civi-wp-member-sync' ); ?></a>
		<a href="<?php echo $urls['manual_sync']; ?>" class="nav-tab"><?php _e( 'Manual Synchronize', 'civi-wp-member-sync' ); ?></a>
	</h2>

	<h3><?php _e( 'Add Association Rule', 'civi-wp-member-sync' ); ?> <a class="add-new-h2" href="<?php echo $urls['list']; ?>"><?php _e( 'Cancel', 'civi-wp-member-sync' ); ?></a></h3>
	
	<?php
	
	// if we've updated, show message (note that this will only display if we have JS turned off)
	if ( isset( $this->errors ) AND is_array( $this->errors ) ) {
		
		// init messages
		$error_messages = array();
		
		// construct array of messages based on error code
		foreach( $this->errors AS $error_code ) {
			$error_messages[] = $this->error_strings[$error_code];
		}
		
		// show them
		echo '<div id="message" class="error"><p>' . implode( '<br>', $error_messages ) . '</p></div>';
		
	}
	
	?>

	<p><?php _e( 'Choose a CiviMember Membership Type and select the Current and Expired Statuses for it. Current Status adds a Membership Capability to the WordPress user, while Expired Status removes the Membership Capability from the WordPress user. If you would like the have the same Membership Type associated with more than one WordPress Capability, you will need to add a second association rule after you have completed this one.', 'civi-wp-member-sync' ); ?></p>
	
	<form method="post" id="civi_wp_member_sync_rules_form" action="<?php echo $this->admin_form_url_get(); ?>">
		
		<?php wp_nonce_field( 'civi_wp_member_sync_rule_action', 'civi_wp_member_sync_nonce' ); ?>
		
		<table class="form-table">

			<tr class="form-field form-required">
				<th scope="row"><label class="civi_member_type_id_label" for="civi_member_type_id"><?php _e( 'Select a CiviMember Membership Type', 'civi-wp-member-sync' ); ?> *</label></th>
				<td>
					<select name="civi_member_type_id" id="civi_member_type_id" class ="required required-type">
						<option value=""></option>
						<?php foreach( $membership_types AS $key => $value ) { ?>
							<option value="<?php echo $key;?>"><?php echo $value; ?></option>
						<?php } ?>
					</select>
				</td>
			</tr>
			
			<tr>
				<th scope="row"><label class="current_label" for="current"><?php _e( 'Current Status', 'civi-wp-member-sync' ); ?> *</label></th>
				<td>
				<?php foreach( $status_rules AS $key => $value ) { ?>
					<input type="checkbox" class="required-current" name="<?php echo 'current['.$key.']'; ?>" id="<?php echo 'current['.$key.']'; ?>" value="<?php echo $key; ?>" />
					<label for="<?php echo 'current['.$key.']'; ?>"><?php echo $value; ?></label><br />
				<?php } ?> 
				</td>
			</tr>
			
			<tr>
				<th scope="row"><label class="expire_label" for="expire"><?php _e( 'Expire Status', 'civi-wp-member-sync' ); ?> *</label></th>
				<td>
				<?php foreach( $status_rules AS $key => $value ) { ?>
					<input type="checkbox" class="required-expire" name="<?php echo 'expire['.$key.']'; ?>" id="<?php echo 'expire['.$key.']'; ?>" value="<?php echo $key; ?>" />
					<label for="<?php echo 'expire['.$key.']';?>"><?php echo $value; ?></label><br />
				<?php } ?>
				</td>
			</tr>
			
		</table>
		
		<input type="hidden" id="civi_wp_member_sync_rules_mode" name="civi_wp_member_sync_rules_mode" value="add" />
		
<p class="submit"><input class="button-primary" type="submit" id="civi_wp_member_sync_rules_submit" name="civi_wp_member_sync_rules_submit" value="<?php _e( 'Add Association Rule', 'civi-wp-member-sync' ); ?>" /></p>

	</form>

</div><!-- /.wrap -->


