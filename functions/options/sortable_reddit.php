					<tr id="sortable_reddit">
						<th scope="row">Reddit</th>
						<td>
							<span style="color:#666666;margin-left:2px;">Show:</span>
							<input name="db_options[si_reddit]" type="checkbox" value="1" <?php if (isset($options['si_reddit'])) { checked('1', $options['si_reddit']); } ?> />

							<span style="color:#666666;margin-left:2px;">URL:</span>
							<input type="text" size="57" name="db_options[si_reddit_url]" value="<?php echo $options['si_reddit_url']; ?>" />
						</td>
					</tr>