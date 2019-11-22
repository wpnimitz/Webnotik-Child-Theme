<?php
$logo = get_option('webnotik_business_logo_url', get_stylesheet_directory_uri() . '/assets/img/rei-toolbox.jpg');
$business_name = get_option('webnotik_business_name', 'REI ToolBox');
$comparison = '<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>
			</th>

			<th>Selling w/ An Agent</th>

			<th><img alt="'.$business_name.'" class="aligncenter" src="'.$logo.'" style="max-width: 200px; width: 100%;">
			</th>
		</tr>
	</thead>


	<tbody>
		<tr>
			<td><strong>Commissions / Fees:</strong>
			</td>

			<td><span style="text-decoration: underline"><em>6%</em></span> on average is paid by you, the seller</td>

			<td>NONE</td>
		</tr>


		<tr>
			<td><strong>Who Pays Closing Costs?:</strong>
			</td>

			<td><span style="text-decoration: underline"><em>2%</em></span> on average is paid by you, the seller</td>

			<td>NONE – We pay all costs</td>
		</tr>


		<tr>
			<td><strong>Inspection &amp; Financing Contingency*:</strong>
			</td>

			<td>
				<span style="text-decoration: underline"><em>Yes</em></span>, up to 15% of sales <a href="http://www.trulia.com/blog/5-reasons-home-sales-fall-prevent/" rel="noopener noreferrer" target="_blank">fall through</a>
			</td>

			<td>NONE</td>
		</tr>


		<tr>
			<td><strong>Appraisal Needed:</strong>
			</td>

			<td><em><span style="text-decoration: underline">Yes</span></em>, sale is often subject to appraisal</td>

			<td>NONE – We make <span style="text-decoration: underline"><em>cash offers</em></span></td>
		</tr>


		<tr>
			<td><strong>Average Days Until Sold:</strong>
			</td>

			<td>+/- 91 Days</td>

			<td>IMMEDIATE CASH OFFER</td>
		</tr>


		<tr>
			<td><strong>Number of Showings:</strong>
			</td>

			<td>It Depends</td>

			<td>1 (Just Us)</td>
		</tr>


		<tr>
			<td><strong>Closing Date:</strong>
			</td>

			<td>30-60 +/- days after accepting buyers offer</td>

			<td>The Date Of YOUR CHOICE</td>
		</tr>


		<tr>
			<td><strong>Who Pays For Repairs?:</strong>
			</td>

			<td>Negotiated During Inspection Period</td>

			<td>NONE – We pay for all repairs</td>
		</tr>
	</tbody>
</table>';