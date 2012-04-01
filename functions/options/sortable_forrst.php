					<tr id="sortable_forrst">
						<th scope="row">Forrst</th>
						<td>
							<span style="color:#666666;margin-left:2px;">Show:</span>
							<input name="db_options[si_forrst]" type="checkbox" value="1" <?php if (isset($options['si_forrst'])) { checked('1', $options['si_forrst']); } ?> />

							<span style="color:#666666;margin-left:2px;">URL:</span>
							<input type="text" size="57" name="db_options[si_forrst_url]" value="<?php echo $options['si_forrst_url']; ?>" />
						</td>
					</tr>