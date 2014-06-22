<tr valign="top">
	<th scope="row"><label>Use FontAwesome Icons?</label></th>
	<td>
		<input type="checkbox" name="jai-enable" <?php checked( get_option( 'jai_enabled' ) ); ?>>
		<small><em>Use custom FontAwesome icons?</em></small>
		<?php wp_nonce_field( 'jai-enable', 'jai_enable_nonce' ); ?>
	</td>
</tr>