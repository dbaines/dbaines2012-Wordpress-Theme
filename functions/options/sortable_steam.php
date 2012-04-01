					<tr id="sortable_steam">
						<th scope="row">Steam Community</th>
						<td>
							<span style="color:#666666;margin-left:2px;">Show:</span>
							<input name="db_options[si_steam]" type="checkbox" value="1" <?php if (isset($options['si_steam'])) { checked('1', $options['si_steam']); } ?> />

							<span style="color:#666666;margin-left:2px;">URL:</span>
							<input type="text" size="57" name="db_options[si_steam_url]" value="<?php echo $options['si_steam_url']; ?>" />
						</td>
					</tr>