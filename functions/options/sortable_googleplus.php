					<tr id="sortable_googleplus">
						<th scope="row">Google+</th>
						<td>
							<span style="color:#666666;margin-left:2px;">Show:</span>
							<input name="db_options[si_googleplus]" type="checkbox" value="1" <?php if (isset($options['si_googleplus'])) { checked('1', $options['si_googleplus']); } ?> />

							<span style="color:#666666;margin-left:2px;">URL:</span>
							<input type="text" size="57" name="db_options[si_googleplus_url]" value="<?php echo $options['si_googleplus_url']; ?>" />
							<br /><span style="color:#666666;margin-left:2px;">Tip: Add "?rel=author" to the end of your profile URL to make your website <a href="http://www.google.com/webmasters/tools/richsnippets" target="_blank">Rich-Snippet compatible</a>.
						</td>
					</tr>