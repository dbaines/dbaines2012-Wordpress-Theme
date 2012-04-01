					<tr id="sortable_lastfm">
						<th scope="row">Last.fm (AudioScrobbler)</th>
						<td>
							<span style="color:#666666;margin-left:2px;">Show:</span>
							<input name="db_options[si_lastfm]" type="checkbox" value="1" <?php if (isset($options['si_lastfm'])) { checked('1', $options['si_lastfm']); } ?> />

							<span style="color:#666666;margin-left:2px;">URL:</span>
							<input type="text" size="57" name="db_options[si_lastfm_url]" value="<?php echo $options['si_lastfm_url']; ?>" />
						</td>
					</tr>