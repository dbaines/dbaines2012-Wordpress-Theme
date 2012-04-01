					<tr id="sortable_linkedin">
						<th scope="row">LinkedIn</th>
						<td>
							<span style="color:#666666;margin-left:2px;">Show:</span>
							<input name="db_options[si_linkedin]" type="checkbox" value="1" <?php if (isset($options['si_linkedin'])) { checked('1', $options['si_linkedin']); } ?> />

							<span style="color:#666666;margin-left:2px;">URL:</span>
							<input type="text" size="57" name="db_options[si_linkedin_url]" value="<?php echo $options['si_linkedin_url']; ?>" />
						</td>
					</tr>