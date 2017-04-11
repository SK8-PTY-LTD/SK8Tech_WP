<div class="postbox panel">
    <h3 class="hndle"><?php _e( 'Buffer Authentication', $this->base->plugin->name ); ?></h3>
    
	<?php
    $access_token = $this->get_setting( '', 'access_token' );
	if ( ! empty ( $access_token ) ) {
		// Already authenticated
		?>
		<div class="option">
            <div class="full">
				<?php _e('Thanks - you\'ve authenticated the plugin with your Buffer account.', $this->base->plugin->name); ?>
                <input type="hidden" name="access_token" value="<?php echo $this->get_setting( '', 'access_token' ); ?>" />
				<a href="admin.php?page=<?php echo $this->base->plugin->name; ?>-settings&amp;wp-to-buffer-pro-disconnect=1" class="button button-red">
					<?php _e( 'Disconnect Buffer Account', $this->base->plugin->name ); ?>
				</a>
			</div>
		</div>
		<?php
	} else {
		// Need to authenticate with Buffer
    	?>
    	<div class="option">
            <div class="left">
			    <strong><?php _e( 'Access Token', $this->base->plugin->name ); ?></strong>
            </div>
            <div class="right">
        	   <input type="text" name="access_token" class="widefat" />
            </div>
        </div>
        <div class="option">
            <p>
                <?php _e( 'You can obtain an access token to allow this Plugin to post updates to your Buffer account by', $this->base->plugin->name ); ?>
                <a href="http://bufferapp.com/developers/apps/create" target="_blank"><?php _e( 'Registering an Application', $this->base->plugin->name ); ?></a>
            </p>
            <p>
                Set the Callback URL to <i><?php bloginfo('url'); ?>/wp-admin/admin.php?page=<?php echo $this->base->plugin->name; ?>-settings</i>
            </p>
            <p>
                <?php _e( 'You can set the other settings to anything.', $this->base->plugin->name ); ?>
            </p>
        </div>
    	<?php
	}
	?>
</div>

<div class="postbox panel">
    <h3 class="hndle"><?php _e( 'Logging', $this->base->plugin->name ); ?></h3>

    <div class="option">
        <div class="left">
            <strong><?php _e( 'Enable Logging?', $this->base->plugin->name ); ?></strong>
        </div>
        <div class="right">
            <input type="checkbox" name="log" value="1" <?php checked( $this->get_setting( '', 'log' ), 1 ); ?> />
        </div>
        <div class="full">
            <p class="description">
                <?php _e( 'If enabled, each Post will display Log information detailing what information was sent to Buffer, and the response received. As this dataset can be quite large, we only recommend this be enabled when troubleshooting issues.', $this->base->plugin->name ); ?>
            </p>
        </div>
    </div>
</div>