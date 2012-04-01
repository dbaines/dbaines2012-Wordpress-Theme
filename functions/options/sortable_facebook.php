					<tr id="sortable_facebook">
						<th scope="row">Facebook</th>
						<td>
							<span style="color:#666666;margin-left:2px;">Show:</span>
							<input name="db_options[si_facebook]" type="checkbox" value="1" <?php if (isset($options['si_facebook'])) { checked('1', $options['si_facebook']); } ?> />

							<span style="color:#666666;margin-left:2px;">URL:</span>
							<input type="text" size="57" name="db_options[si_facebook_url]" value="<?php echo $options['si_facebook_url']; ?>" />
						</td>
					</tr>