					<tr id="sortable_github">
						<th scope="row">Github</th>
						<td>
							<span style="color:#666666;margin-left:2px;">Show:</span>
							<input name="db_options[si_github]" type="checkbox" value="1" <?php if (isset($options['si_github'])) { checked('1', $options['si_github']); } ?> />

							<span style="color:#666666;margin-left:2px;">URL:</span>
							<input type="text" size="57" name="db_options[si_github_url]" value="<?php echo $options['si_github_url']; ?>" />
						</td>
					</tr>