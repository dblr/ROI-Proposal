<?

?>
<head>

<?php wp_head(); ?>
<link rel="stylesheet" href="http://lampinator.com/roi/wp-content/themes/ledpdf/pie.css" type="text/css" media="print">
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
</head>

<?php
//Baisc Variables
	$kWhc = get_field('kwhc'); //kWhc loaded from entry
	$productID = 1;
	$hourly = get_field('labor_rate');
	//echo '<h1>Existing Products</h1>';
//EXISTING FIXTURES (database items)
	while (has_sub_field('existing_products')) {
		//Existing Product Data
		$qty = get_sub_field('qty');
		$hours = get_sub_field('hours'); //Product Hours (yearly)
		$postobject = get_sub_field('newprod');
		$ac = get_sub_field('ac'); //AC Checkbox
		$exid = $postobject->ID;

		$bal_per_fixt = get_field('bal_per_fixt',$exid);
		$lamps_per_fixt = get_field('lamps_per_fixt',$exid);
		//$lamp_watts = get_field('lamp_watts',$exid);
		$fixit_watts = get_field('fixit_watts',$exid);
		$lamp_fail_rate = get_field('lamp_fail_rate',$exid);
		$bal_fail_rate = get_field('bal_fail_rate',$exid);
		$lamp_replace_time = get_field('lamp_replace_time',$exid);
		$bal_replace_time = get_field('bal_replace_time',$exid);
		$lamp_cost = get_field('lamp_cost',$exid);
		$lamp_rcy = get_field('lamp_rcy',$exid);
		$bal_cost = get_field('bal_cost',$exid);
		$bal_rcy = get_field('bal_rcy',$exid);
		//$rated_life = get_field('rated_life',$exid);

	//Per Product Power/Cost
		$current_watts = ($qty * $fixit_watts);
		$current_kwh = ($current_watts * .001);
		$total_kwh = ($current_kwh * $hours);
		$energy_cost = ($total_kwh * $kWhc);

	//Per Product Lamp Maintance
		$lamp_fail_rate = ($lamp_fail_rate/100);
		$lamps_per_year = ($qty*$lamps_per_fixt*$lamp_fail_rate);
		$lamp_year_cost = ($lamps_per_year * $lamp_cost);
		$lamp_labor = ($lamps_per_year * $hourly * (15/60));
		$lamp_recycle = ($lamps_per_year * $lamp_rcy);
		$lamps_per_year = round($lamps_per_year);

	//Per Product Ballast Maintance
		$bal_fail_rate = ($bal_fail_rate/100);
		$bals_per_year = ($qty*$bal_per_fixt*$bal_fail_rate);
		$bal_year_cost = ($bals_per_year * $bal_cost);
		$bal_labor = ($bals_per_year * $hourly * (60/60));
		$bal_recycle = ($bals_per_year * $bal_rcy);
		$bals_per_year = round($bals_per_year);

	//Per Product Maintance Total
		$product_maintance = ($lamp_labor + $lamp_recycle + $lamp_year_cost) + ($bal_labor + $bal_recycle + $bal_year_cost);

	//Per Product AC??
		if(get_sub_field('ac')) {
			$currentAC = ($currentAC + $energy_cost);
		}
	//Echos
		//echo "<h2>Product #" . $productID . " <span>Auto</span></h2>";
		//echo "<h4>" . get_the_title($exid) . '</h4>';
		//echo "<h6>Qty -" . $qty . "</h6>";
		//echo "<h6>Total Wts- " . $current_watts . "</h6>";
		//echo "<h6>KWH - " . $current_kwh . "</h6>";
		//echo "<h6>Existing kWh Use- " . $total_kwh . "</h6>";
		//echo "<h6>Existing Energy Cost - $" . $energy_cost . "</h6>";
		//echo "<h6>Yearly Product Maintance - $" . $product_maintance . "</h6>";
		//echo "<h6 class='subheader'>Lamps per year - " . $lamps_per_year . "</h6>";
		//echo "<h6 class='subheader'>Ballast per year - " . $bals_per_year . "</h6>";
		//echo "<h6 class='subheader'>Lamps per year cost- $" . $lamp_year_cost . "</h6>";
		//echo "<h6 class='subheader'>Lamps Labor cost- $" . $lamp_labor . "</h6>";
		//echo "<h6 class='subheader'>Lamps Recycle cost- $" . round($lamp_recycle) . "</h6>";
		//echo "<h6 class='subheader'>Ballast per year cost- $" . $bal_year_cost . "</h6>";
		//echo "<h6 class='subheader'>Ballast Labor cost- $" . $bal_labor . "</h6>";
		//echo "<h6 class='subheader'>Ballast Recycle cost- $" . round($bal_recycle) . "</h6>";
		if(get_sub_field('ac')) {
			//echo "<h6 class='subheader'>AC Related Product - YES</h6>";
		} else {
			//echo "<h6 class='subheader'>AC Related Product - NO</h6>";
		}
	//Totals
		$existing_tkWh = ($total_kwh+$existing_tkWh);
		$existing_energy_cost = ($existing_energy_cost + $energy_cost);
		$maintance = ($maintance + $product_maintance);
		$productID++;
	}

//Existing Products Manual Entry
	while (has_sub_field('current')) {
	//Existing Product Data
		$qty = get_sub_field('qty');
		$hours = get_sub_field('hours');
		$ac = get_sub_field('ac');

		$bal_per_fixt = get_sub_field('bal_per_fixt');
		$lamps_per_fixt = get_sub_field('lamps_per_fixt');
		//$lamp_watts = get_sub_field('lamp_watts');
		$fixit_watts = get_sub_field('fixit_watts');
		$lamp_fail_rate = get_sub_field('lamp_fail_rate');
		$bal_fail_rate = get_sub_field('bal_fail_rate');
		$lamp_replace_time = get_sub_field('lamp_replace_time');
		$bal_replace_time = get_sub_field('bal_replace_time');
		$lamp_cost = get_sub_field('lamp_cost');
		$lamp_rcy = get_sub_field('lamp_rcy');
		$bal_cost = get_sub_field('bal_cost');
		$bal_rcy = get_sub_field('bal_rcy');
		//$rated_life = get_sub_field('rated_life');

	//Per Product Power/Cost
		$current_watts = ($qty * $fixit_watts);
		$current_kwh = ($current_watts * .001);
		$total_kwh = ($current_kwh * $hours);
		$energy_cost = ($total_kwh * $kWhc);

	//Per Product Lamp Maintance
		$lamp_fail_rate = ($lamp_fail_rate/100);
		$lamps_per_year = ($qty*$lamps_per_fixt*$lamp_fail_rate);
		$lamp_year_cost = ($lamps_per_year * $lamp_cost);
		$lamp_labor = ($lamps_per_year * $hourly * (15/60));
		$lamp_recycle = ($lamps_per_year * $lamp_rcy);
		$lamps_per_year = round($lamps_per_year);

	//Per Product Ballast Maintance
		$bal_fail_rate = ($bal_fail_rate/100);
		$bals_per_year = ($qty*$bal_per_fixt*$bal_fail_rate);
		$bal_year_cost = ($bals_per_year * $bal_cost);
		$bal_labor = ($bals_per_year * $hourly * (60/60));
		$bal_recycle = ($bals_per_year * $bal_rcy);
		$bals_per_year = round($bals_per_year);

	//Per Product Maintance Total
		$product_maintance = ($lamp_labor + $lamp_recycle + $lamp_year_cost) + ($bal_labor + $bal_recycle + $bal_year_cost);

	//Per Product AC??
		if(get_sub_field('ac')) {
			$currentAC = ($currentAC + $energy_cost);
		}

	//Echos
		//echo "<h2>Product #" . $productID . " <span>Manual</span></h2>";
		//echo "<h4>Manual Entry</h4>";
		//echo "<h6>Qty -" . $qty . "</h6>";
		//echo "<h6>Total Wts- " . $current_watts . "</h6>";
		//echo "<h6>KWH - " . $current_kwh . "</h6>";
		//echo "<h6>Existing kWh Use- " . $total_kwh . "</h6>";
		//echo "<h6>Existing Energy Cost - $" . $energy_cost . "</h6>";
		//echo "<h6>Yearly Product Maintance - $" . $product_maintance . "</h6>";
		//echo "<h6 class='subheader'>Lamps per year - " . $lamps_per_year . "</h6>";
		//echo "<h6 class='subheader'>Ballast per year - " . $bals_per_year . "</h6>";
		//echo "<h6 class='subheader'>Lamps per year cost- $" . $lamp_year_cost . "</h6>";
		//echo "<h6 class='subheader'>Lamps Labor cost- $" . $lamp_labor . "</h6>";
		//echo "<h6 class='subheader'>Lamps Recycle cost- $" . round($lamp_recycle) . "</h6>";
		//echo "<h6 class='subheader'>Ballast per year cost- $" . $bal_year_cost . "</h6>";
		//echo "<h6 class='subheader'>Ballast Labor cost- $" . $bal_labor . "</h6>";
		//echo "<h6 class='subheader'>Ballast Recycle cost- $" . round($bal_recycle) . "</h6>";
		if(get_sub_field('ac')) {
			//echo "<h6 class='subheader'>AC Related Product - YES</h6>";
		} else {
			//echo "<h6 class='subheader'>AC Related Product - NO</h6>";
		}

	//Totals
		$existing_tkWh = ($total_kwh+$existing_tkWh);
		$existing_energy_cost = ($existing_energy_cost + $energy_cost);
		$maintance = ($maintance + $product_maintance);
		$productID++;
	}

	//Display Existing Totals
		//echo '<h2>Existing Products Totals</h2>';
		//echo '<h6>Existing kWh Use - ' . $existing_tkWh . '</h6>' ;
		//echo '<h6>Existing Energy Cost- $' . $existing_energy_cost . '</h6>' ;
		//echo '<h6>Maintance - $' . $maintance . '</h6>' ;
		//echo '<h6 class="subheader">Energy Cost of AC products - $' . $currentAC  . '</h6>' ;

//Proposed Products Database Entry
	//echo '<h1>Proposed Products</h1>';
	while (has_sub_field('selected_products')) {
	//Load Variables
		$postobject = get_sub_field('newprod');
		$pid = $postobject->ID;
		$qty = get_sub_field('qty');
		$fixit_watts = get_field('fixit_watts', $pid);
		$hours = get_sub_field('hours');
		$price = get_sub_field('cost');
		$rated_life = get_field('rated_life', $pid);
	//Fixture Cost
		$current_watts = ($qty * $fixit_watts);
		$current_kwh = ($current_watts * .001);
		$total_kwh = ($current_kwh * $hours);
		$energy_cost = ($total_kwh * $kWhc);

	//Per Product AC??
		if(get_sub_field('ac')) {
			$newAC = ($newAC + $energy_cost);
		}
	//Product Cost
		$cost = ($qty * $price);
		$project_cost = ($project_cost + $cost);
	//Product Life
		$estimated_lamp_years = ($rated_life / $hours);
		$total_years = (($estimated_lamp_years * $qty)+ $total_years);
		$totalqty = ($qty + $totalqty);
	//Echos
		//echo "<h2>Product #" . $productID . " <span>Auto</span></h2>";
		//echo "<h4>" . get_the_title($pid) . '</h4>';
		//echo "<h6>Qty -" . $qty . "</h6>";
		//echo "<h6>Total Wts- " . $current_watts . "</h6>";
		//echo "<h6>KWH - " . $current_kwh . "</h6>";
		//echo "<h6>kWh Use- " . $total_kwh . "</h6>";
		//echo "<h6>Energy Cost - $" . $energy_cost . "</h6>";
		//echo "<h6>Yearly Hours - " . $hours . "</h6>";
		//echo "<h6>Lampe Life - " . $estimated_lamp_years . " years</h6>";
		//echo "<h6>Total Years - " . $total_years . " years</h6>";
		if(get_sub_field('ac')) {
			//echo "<h6 class='subheader'>AC Related Product - YES</h6>";
		} else {
			//echo "<h6 class='subheader'>AC Related Product - NO</h6>";
		}
	//Add To Proposed Totals
		$proposed_tkWh = ($total_kwh+$proposed_tkWh);
		$proposed_energy_cost = ($proposed_energy_cost + $energy_cost);
		$productID++;
	}

//Proposed Products Manual Entry
	while (has_sub_field('new_productsm')) {
	//Load Variables
		$postobject = get_sub_field('newprod');
		$qty = get_sub_field('qty');
		$fixit_watts = get_sub_field('watts');
		$hours = get_sub_field('hours');
		$price = get_sub_field('cost');
		$rated_life = get_sub_field('rated_life');
	//Fixture Cost
		$current_watts = ($qty * $fixit_watts);
		$current_kwh = ($current_watts * .001);
		$total_kwh = ($current_kwh * $hours);
		$energy_cost = ($total_kwh * $kWhc);

	//Per Product AC??
		if(get_sub_field('ac')) {
			$newAC = ($newAC + $energy_cost);
		}
	//Product Cost
		$cost = ($qty * $price);
		$project_cost = ($project_cost + $cost);
	//Product Life
		$estimated_lamp_years = ($rated_life / $hours);
		$total_years = (($estimated_lamp_years * $qty)+ $total_years);
		$totalqty = ($qty + $totalqty);
	//Echos
		//echo "<h2>Product #" . $productID . " <span>Manual</span></h2>";
		//echo "<h4>Manual Entry</h4>";
		//echo "<h6>Qty -" . $qty . "</h6>";
		//echo "<h6>Total Wts- " . $current_watts . "</h6>";
		//echo "<h6>KWH - " . $current_kwh . "</h6>";
		//echo "<h6>kWh Use- " . $total_kwh . "</h6>";
		//echo "<h6>Energy Cost - $" . $energy_cost . "</h6>";
		//echo "<h6>Yearly Hours - " . $hours . "</h6>";
		//echo "<h6>Lampe Life - " . $estimated_lamp_years . " years</h6>";
		//echo "<h6>Total Years - " . $total_years . " years</h6>";
		if(get_sub_field('ac')) {
			//echo "<h6 class='subheader'>AC Related Product - YES</h6>";
		} else {
			//echo "<h6 class='subheader'>AC Related Product - NO</h6>";
		}

	//Add To Proposed Totals
		$proposed_tkWh = ($total_kwh+$proposed_tkWh);
		$proposed_energy_cost = ($proposed_energy_cost + $energy_cost);
		$productID++;
	}

	//Display Propsed Totals
		//echo '<h2>Proposed Totals</h2>';
		//echo '<h6>Proposed kWh Use - ' . $proposed_tkWh . '</h6>' ;
		//echo '<h6>Proposed Energy Cost- $' . $proposed_energy_cost . '</h6>' ;
		//echo '<h6 class="subheader">Energy Cost of AC products - $' . $newAC  . '</h6>' ;




//SPEC SHEET TOTALS/FINAL MATH

	//Savings
		$annual_kw_saved = ($existing_tkWh - $proposed_tkWh);
		$annual_cost_saved = ($existing_energy_cost - $proposed_energy_cost);

	//Product Life
		$estimated_product_life = ($total_years/$totalqty);

	//AC SAVINGS [Only Select Products]
		$ac_difference = ($currentAC - $newAC);
		//echo $ac_difference;
		$ac = get_field('ac');
		$ac_percent = ((($ac/52)*0.9));
		$ac_percent = $ac_percent/2.7;
		$ac_savings = $ac_percent * $ac_difference;

	//Loan Amount & Payments
		$loan = $project_cost;
		$taxrate = get_field('sales_tax');
		$salestax = ($loan * ($taxrate/100));
		//echo $taxrate;
		//echo '</br>' . $loan;
		//echo '</br>' . $salestax;
		$loan = $loan + ($loan * ($taxrate/100));
		$months = 60;
		$int = 6;
		$rate = ($int/100) / 12;
		$payments = floor(($loan*$rate/(1-pow(1+$rate,(-1*$months))))*100)/100;

	//Shipping Install & Totals
		$ship = get_field('shipping');
		$install = get_field('install');
		$total = ($ship + $loan + $install);

	//Incentives & Rebates
		$enginc = get_field('energy_incentive');
		$taxinc = get_field('tax_incentive');

	//Total Annual Savings
		$total_annual_savings = ($annual_cost_saved+$maintance+$ac_savings);
		$monthly_cash = ($total_annual_savings/12)-$payments;
		$total_annual_savings  = round($total_annual_savings);
	//RATE OF PAYBACKS
		$payback = ($total / $total_annual_savings);
		$paybackre = ($total - ($enginc + $taxinc)) / ($total_annual_savings);

	//Life & Savings
		$life_savings = ($estimated_product_life * $total_annual_savings);
		$life_profit_after = ($life_savings - $total);
		$return_on_investment = ($life_profit_after / $total);
		$return_on_investment = $return_on_investment*100;

	//Inflation
		$inf = .05;
		$einf = .07;

	//Total Return YEARS
		$RORmonth = ($annual_cost_saved/12);
		$RORone = $annual_cost_saved;
	//Total Return FIVE YEARS
		$yc = 2;
		$ROR = $annual_cost_saved;
		while ($yc <= 5) {
			////echo $inf . '</br>';
			$ROR = ($ROR * $einf) + $ROR;
			$RORtot = $RORtot + $ROR;
			$yc++;
		}
		$RORfive = $RORtot + $annual_cost_saved;
	//Total Return TEN YEARS
		$yc = 2;
		$ROR = $annual_cost_saved;
		$RORtot = 0;
		while ($yc <= 10) {
			$ROR = ($ROR * $einf) + $ROR;
			$RORtot = $RORtot + $ROR;
			$yc++;
		}
		$RORten = $RORtot + $annual_cost_saved;
	//Total Return TWENTY YEARS
		$yc = 2;
		$ROR = $annual_cost_saved;
		$RORtot = 0;
		while ($yc <= 20) {
			$ROR = ($ROR * $einf) + $ROR;
			$RORtot = $RORtot + $ROR;
			$yc++;
		}
		$RORtwen = $RORtot + $annual_cost_saved;

	//Tax Toats and Tots
		$capital_outlay = ($total);

	//PIE CHARTS!
		$chart = ($annual_cost_saved + $proposed_energy_cost);
		$chartnew = ($proposed_energy_cost/$chart);
		$chartsave = ($annual_cost_saved/$chart);

			//echo '<h1>Final Figures/Numbers/ROR/ETC</h1>';
			//echo '<h2>AC Totals</h2>';
			//echo '<h6>AC Difference- ' . $ac_difference . '</h6>';
			//echo '<h6>AC Weeks - ' . $ac . '</h6>';
			//echo '<h6>AC Percent - ' . $ac_percent . '</h6>';
			//echo '<h6>AC Savings - ' . $ac_savings . '</h6>';

			//echo '<h2>Cost / Loan </h2>';
			//echo '<h6>New Product Cost - $' . $project_cost . '</h6>';
			//echo '<h6>New Product Cost after tax- $' . $loan . '</h6>';
			//echo '<h6>Monthly (60 months & 6%) - $' . $payments . '</h6>';
			//echo '<h2>Product Life</h2>';
			//echo '<h6>Total Product Years - ' . $total_years . '</h6>';
			//echo '<h6>Total Porudct qty - ' . $totalqty . '</h6>';
			//echo '<h6>Estimated Product Life - ' . $estimated_product_life . '</h6>';
			//echo '<h6>Estimated Product Life Savings - ' . $life_savings . '</h6>';
			//echo '<h6>ROI - ' . $return_on_investment . '%</h6>';

			//echo '<h2>Shipping/Install </h2>';
			//echo '<h6>Shipping - $' . $ship . '</h6>';
			//echo '<h6>Install -  $' . $install . '</h6>';
			//echo '<h6>Total Cost (Including Products) - $' . $total . '</h6>';

			//echo '<h2>Energy</h2>';
			//echo '<h6>Proposed kWh Use- ' . $proposed_tkWh . '</h6>';
			//echo '<h6>Proposed Energy Cost - ' . $proposed_energy_cost . '</h6>';
			//echo '<h6>Existing kWh Use - ' . $existing_tkWh . '</h6>';
			//echo '<h6>Existing Energy Cost - ' . $existing_energy_cost . '</h6>';

			//echo '<h2>Savings</h2>';
			//echo '<h6>Annual kWh Savings - ' . $annual_kw_saved . '</h6>';
			//echo '<h6>Annual Energy Savings - ' . $annual_cost_saved . '</h6>';
			//echo '<h6>Annual Maintenance Savings - ' . $maintance  . '</h6>';
			//echo '<h6>Annual A/C Savings - ' . $ac_savings  .'</h6>';

			//echo '<h2>Rate Of Return</h2>';
			//echo '<h6>Total Return Each Month - ' . number_format(round($RORmonth)) . '</h6>';
			//echo '<h6>Total Return 1 Year - ' . number_format(round($RORone)) . '</h6>';
			//echo '<h6>Total Return 5 Years - ' . number_format(round($RORfive)) . '</h6>';
			//echo '<h6>Total Return 10 Years - ' . number_format(round($RORten)) . '</h6>';
			//echo '<h6>Total Return 20 Years - ' . number_format(round($RORtwen)) . '</h6>';

			//echo '<h2>Rebates and Incentives</h2>';
			//echo '<h6>Utility Energy Incentive and/or Rebate - ' . round($enginc) . '</h6>';
			//echo '<h6>Epact 179d Tax Incentive - ' . round($taxinc) . '</h6>';
			//echo '<h6>Payback Period in Years Before Rebates and Incentives - ' . $payback . '</h6>';
			//echo '<h6>Payback Period in Years After Rebates and Incentives - ' . $paybackre . '</h6>';
			//echo '<h2>Capital Outlay</h2>';
			//echo '<h6>Capital Outlay for Purchase - ' . $capital_outlay . '</h6>';
			//echo '<h6>Pre-Incentive ROI - ' . $return_on_investment . '</h6>';
			//echo '<h6>Pre-Incentive Payback in Years - ' . $payback . '</h6>';
?>


<!-- TITLE PAGE-->

<?php if ( get_post_status ( $post->ID ) == 'pending' ) { ?>
		<div class="row pending">
			<img src="http://lampinator.com/roi/wp-content/themes/ledpdf/pdfimages/pending.png" width="100%" height="100%">
		</div>
<?php } ?>
<div class="row">
		<img src="http://lampinator.com/roi/wp-content/themes/ledpdf/pdfimages/logo.png" width="70%" height="70%">
</div>
<div class="row imgbox">
	<?php
			if ( has_post_thumbnail()) {
               $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'frontcover');
			?>
       	    <img src="<?php echo $large_image_url[0] ?>" alt="" />
    <?php } ?>
</div>
<div class="row">
	<div class="row dots small">&nbsp;</div>
	<div class="row dots small">&nbsp;</div>
</div>
<!-- TITLE PAGE -->
<div class="row title">

	<div class="box">
		<h4>DETAILED LED LIGHTING RETROFIT PROPOSAL FOR</h4>
		<h1><?php the_title(); ?></h1>
		<?php while (has_sub_field('sales_person')) {  ?>
			<div class="leftbox">
				<p>Proposal Date:  <?php echo date('M j, Y'); ?></p>
				<p><a href="http://www.ledsource.com/" target="_blank">www.LEDSource.com</a></p>
			</div>
			<div class="rightbox">
				<p>Prepared By: <?php the_sub_field('name'); ?> </p>
				<p>Phone: <?php the_sub_field('phone'); ?></p>
			</div>
		<?php } ?>
	</div>

</div>
<!-- END TITLE PAGE -->


<!-- START ABOUT US PAGE -->
<?php if ( get_post_status ( $post->ID ) == 'pending' ) { ?>
		<div class="row pending">
			<img src="http://lampinator.com/roi/wp-content/themes/ledpdf/pdfimages/pending.png" width="100%" height="100%">
		</div>
<?php } ?>
<div class="row header">
		<img src="http://lampinator.com/roi/wp-content/themes/ledpdf/pdfimages/logo.png" width="50%" height="50%">
</div>
<div class="row dots">&nbsp; </div>


<div class="row aboutus">
	<h1>About Us</h1>
	<div class="row nomarg">
		<div class="colleft">
			<p>LED Source® is the leading international supplier and solutions provider of professional, high quality LED lighting products. Our level of knowledge, in additional to our strong customer support, has brought us to the forefront in the LED lighting industry. We specialize in full-scale evaluations, support, design, supply and retrofits for commercial applications.</p>
			<p>We offer LED lighting solutions for hotels, commercial office spaces, schools, churches, theaters, art galleries, restaurants, nightclubs, special events, residential, landscape lighting and much more. Whether we are upgrading your lighting or providing LED products for your new project, we will find the perfect solution for YOU.</p>
			<p>With the disappearance of incandescent and other lighting technologies on the horizon, alternative lighting solutions such as light-emitting-diodes, or LEDs are the natural choice. Though LED lighting has steadily increased in demand, the average business has no idea where to start when it comes to locating the right products and information, until now.</p>
		</div>
		<div class="colright">
			<p>LEDs save energy, cut electric and maintenance costs, give off very little heat and contain no dangerous toxic chemicals – all of which should be extremely important to any commercial user.</p>
			<p>Business leaders focused on reducing your operating expenses and increasing your green corporate profile, have been seeking a single point of contact that can provide the right solution to meet your desired project goals.</p>
			<p>At LED Source®, we have seen how imported low quality products can ruin the customer experience. It is for this reason; we only carry the highest quality products from brands including Cree, eFFINION, Lighting Science, Philips, Color Kinetics and Toshiba. Through these relationships with our trusted manufacturing partners, we have been able to provide valuable input and help drive what is next for commercial LED lighting applications.</p>
			<p>Sure LED Source® offers state-of-the-art LED lighting products, but more importantly, we offer our expertise and the LED solution that is right for you. It is our goal to become your trusted solutions provider.</p>
		</div>
	</div>
		<blockquote>
			<div class="row nomarg">
				<img src="http://lampinator.com/roi/wp-content/themes/ledpdf/pdfimages/quote.png" width="7%" height="7%">
				<p>LED Source® did an outstanding job. From design to project management, they are true professionals. We look forward to working with them on our next project..</p>
				<p class="who">Larry Lubeck,Vice President, Portfolio Energy Manager Energy and Sustainability Services Jones Lang LaSalle</p>
			</div>
		</blockquote>

	<div class="row nomarg aboutfoot">
		<div class="colleft">
			<h3><span>LED Lamp</span></h3>
			<p>The light-emitting diode (LED) is one of today's most energy-efficient and rapidly-developing lighting technologies. Quality LED light bulbs last longer, are more durable, and offer comparable or better light quality than other types of lighting.
	The high efficiency and directional nature of LEDs makes them ideal for many industrial uses. </p>
		</div>
		<div clas="colright">
			<img src="http://lampinator.com/roi/wp-content/themes/ledpdf/pdfimages/bulbs.jpg" width="50%" height"50%">
		</div>
	</div>

</div>



<div class="row footer">
	<p class="left"><span class="num">2</span><a href="http://www.ledsource.com">LEDsource.com</a> - Proposal Prepared For <span><?php the_title(); ?></p>
	<p class="right"><?php echo date('F jS Y'); ?>
</div>

<!-- END ABOUT US PAGE -->


<!--- START OBJECTIVES PAGE -->

<?php if ( get_post_status ( $post->ID ) == 'pending' ) { ?>
		<div class="row pending">
			<img src="http://lampinator.com/roi/wp-content/themes/ledpdf/pdfimages/pending.png" width="100%" height="100%">
		</div>
<?php } ?>
<div class="row header">
		<img src="http://lampinator.com/roi/wp-content/themes/ledpdf/pdfimages/logo.png" width="50%" height="50%">
</div>
<div class="row dots">&nbsp; </div>


<div class="row obj">
	<h1>OBJECTIVES &amp; BENEFITS</h1>
	<h6>THANK YOU FOR YOUR CAREFUL CONSIDERATION OF THIS PROPOSAL</h6>

	<h4>Objectives</h4>
		<ol type="1">
			<li>Maximize savings while improving lighting output to an acceptable level</li>
			<li>Provide uniform light that maintains output over time</li>
			<li>Justify the improvement with reasonable payback, including annual maintenance cost</li>
		</ol>



	<h4>Benefits</h4>
	<ul class="dotlist">
		<li>
			<span>&nbsp;</span>
			<p>Color rendering and quality better than metal halide</p>
		</li>
		<li>
			<span>&nbsp;</span>
			<p>The “perceived” brightness is even higher than the measured lumens</p>
		</li>
		<li>
			<span>&nbsp;</span>
			<p>Color consistency is near perfect</p>
		</li>
		<li>
			<span>&nbsp;</span>
			<p>Consumes 85% less energy than incandescent and 50% less energy than fluorescent</p>
		</li>
		<li>
			<span>&nbsp;</span>
			<p>Low heat produced = lower cooling cost</p>
		</li>
		<li>
			<span>&nbsp;</span>
			<p>Lower maintenance costs</p>
		</li>
		<li>
			<span>&nbsp;</span>
			<p>Most fixtures rated for 100,000 hours to 70% lumen maintenance</p>
		</li>
		<li>
			<span>&nbsp;</span>
			<p>A typical application will see 20+ years before needing replacement</p>
		</li>
		<li>
			<span>&nbsp;</span>
			<p>No outside contractor is required to change/dispose lamp</p>
		</li>
		<li>
			<span>&nbsp;</span>
			<p>Consumes less electricity / emits fewer greenhouse gases</p>
		</li>
		<li>
			<span>&nbsp;</span>
			<p>Longer life means less landfills are impacted</p>
		</li>
		<li>
			<span>&nbsp;</span>
			<p>No harmful mercury</p>
		</li>
		<li>
			<span>&nbsp;</span>
			<p>Almost all components are 100% recyclable</p>
		</li>
		<li>
			<span>&nbsp;</span>
			<p>Lifetime savings on Energy and Maintenance cost is significant</p>
		</li>
		<li>
			<span>&nbsp;</span>
			<p>One of very few green products that can actually produce cost savings</p>
		</li>
	</ul>
	<p class="xsmall">Note: Figures or percentages indicated in this Proposal are considered to be generated on the best efforts basis, based on certain stipulated conditions concerning blended kWh electricity rate; hours of operation; existing lighting system data; and proposed lighting system data. All calculations or figures are estimates or based on estimated information.</p>
</div>



<div class="row footer">
	<p class="left"><span class="num">3</span><a href="http://www.ledsource.com">LEDsource.com</a> - Proposal Prepared For <span><?php the_title(); ?></p>
	<p class="right"><?php echo date('F jS Y'); ?>
</div>



<!--- END OBJECTIVES PAGE -->









<!-- START HEADER-->
<?php if ( get_post_status ( $post->ID ) == 'pending' ) { ?>
		<div class="row pending">
			<img src="http://lampinator.com/roi/wp-content/themes/ledpdf/pdfimages/pending.png" width="100%" height="100%">
		</div>
<?php } ?>
<div class="row header">
		<img src="http://lampinator.com/roi/wp-content/themes/ledpdf/pdfimages/logo.png" width="50%" height="50%">
	<div class="contact">
		<?php while (has_sub_field('sales_person')) {  ?>
			<p><?php the_sub_field('name'); ?></p>
			<p><?php the_sub_field('phone'); ?></p>
			<p><?php the_sub_field('email'); ?></p>


		<?php } ?>
	</div>
</div>
<div class="row dots">&nbsp; </div>
<!-- END HEADER -->

<!-- START Figure PAGE -->
<div class="row">
	<div class="youknow">
			<img src="http://lampinator.com/roi/wp-content/themes/ledpdf/pdfimages/didyouknow.png" width="30%" height="30%">
		<p>LED lighting not only reduces operating costs and lasts longer, it uses 85% less energy than traditional lighting and has a higher color rendering than fluorescent.</p>
	</div>
	<div class="projhead">
		<h6 class="subprj">Proposal Prepared For:</h6>
		<h1 class="prjname"><?php the_title(); ?></h1>
	</div>
</div>
<div class="row">
		<?php $stringlength = strlen($total_annual_savings);
		if ($stringlength == 6) {?>
			<ul class="graybox small">
				<li>
					<h3>ANNUAL SAVINGS</h3>
					<div class="row nomarg">
						<h1>$<?php echo number_format($total_annual_savings); ?></h1>
						<p class="right">Annually</p>
						<p>Why are you giving your money away?</p>
					</div>
				</li>
				<li>
					<h3>UPGRADE COST*</h3>
					<div class="row nomarg">
						<h1>$<?php echo number_format($payments); ?></h1>
						<p class="right">Monthly</p>
						<p>One low payment with no money down.</p>
					</div>
				</li>
				<li>
					<h3>INSTANT CASH FLOW</h3>
					<div class="row nomarg">
						<h1>$<?php echo number_format($monthly_cash); ?></h1>
						<p class="right">Monthly</p>
						<p>Receive positive cash flow from the savings.</p>
					</div>
				</li>
			</ul>
		<?php } if($stringlength == 7) { ?>
			<ul class="graybox smaller">
				<li>
					<h3>ANNUAL SAVINGS</h3>
					<div class="row nomarg">
						<h1>$<?php echo number_format($total_annual_savings); ?></h1>
						<p class="right">Annually</p>
						<p>Why are you giving your money away?</p>
					</div>
				</li>
				<li>
					<h3>UPGRADE COST*</h3>
					<div class="row nomarg">
						<h1>$<?php echo number_format($payments); ?></h1>
						<p class="right">Monthly</p>
						<p>One low payment with no money down.</p>
					</div>
				</li>
				<li>
					<h3>INSTANT CASH FLOW</h3>
					<div class="row nomarg">
						<h1>$<?php echo number_format($monthly_cash); ?></h1>
						<p class="right">Monthly</p>
						<p>Receive positive cash flow from the savings.</p>
					</div>
				</li>
			</ul>
		<?php  } if($stringlength < 6) { ?>
					<ul class="graybox">
				<li>
					<h3>ANNUAL SAVINGS</h3>
					<div class="row nomarg">
						<h1>$<?php echo number_format($total_annual_savings); ?></h1>
						<p class="right">Annually</p>
						<p>Why are you giving your money away?</p>
					</div>
				</li>
				<li>
					<h3>UPGRADE COST*</h3>
					<div class="row nomarg">
						<h1>$<?php echo number_format($payments); ?></h1>
						<p class="right">Monthly</p>
						<p>One low payment with no money down.</p>
					</div>
				</li>
				<li>
					<h3>INSTANT CASH FLOW</h3>
					<div class="row nomarg">
						<h1>$<?php echo number_format($monthly_cash); ?></h1>
						<p class="right">Monthly</p>
						<p>Receive positive cash flow from the savings.</p>
					</div>
				</li>
			</ul>
		<?php } ?>
</div>

<div class="row">

	<div class="padbox">
		<p class="med">Finance your LED lighting retrofit using a portion of the monthly energy savings as the payments. The remaining savings become immediate cash flow to your business’s bottom line.</p>
	</div>
</div>

<div class="row">
	<h5>Program Benefits:</h5>
	<ul class="checklist">
		<li><img src="http://lampinator.com/roi/wp-content/themes/ledpdf/pdfimages/check-sm.png">MONTHLY PAYMENT FROM THE ENERGY SAVINGS</li>
		<li><img src="http://lampinator.com/roi/wp-content/themes/ledpdf/pdfimages/check-sm.png">NOTHING OUT-OF-POCKET</li>
		<li><img src="http://lampinator.com/roi/wp-content/themes/ledpdf/pdfimages/check-sm.png">NO ADDITIONAL COLLATERAL</li>
		<li><img src="http://lampinator.com/roi/wp-content/themes/ledpdf/pdfimages/check-sm.png">FAST AND EASY APPLICATION PROCESS</li>
	</ul>
</div>

<div class="row">
	<div class="totalbox">
		<div class="wleft">
			<h1>Total Savings</h1>
			<h6>over estimated life span</h6>
		</div>
		<div class="wright">
			<h1>$<?php echo number_format($life_savings); ?></h1>
		</div>
	</div>
	<div class="cf"></div>
</div>

<div class="row">
	<div class="padbox">
		<p class="disclaim"><sup>*</sup>Financing rates are estimated at 6% and 60 month term. Actual rate may vary and is subject to satisfactory credit approval and market conditions at time of contract execution. All numbers are an estimate only and based upon information provided.</p>
		<img class="right"src="http://lampinator.com/roi/wp-content/themes/ledpdf/pdfimages/loumoney.png" width="28%" height="28%">
	</div>
</div>
<!-- END FIRST PAGE-->
<div class="row footer">
	<p class="left"><span class="num">4</span><a href="http://www.ledsource.com">LEDsource.com</a> - Proposal Prepared For <span><?php the_title(); ?></p>
	<p class="right"><?php echo date('F jS Y'); ?>
</div>










<!-- START HEADER-->
<?php if ( get_post_status ( $post->ID ) == 'pending' ) { ?>
		<div class="row pending">
			<img src="http://lampinator.com/roi/wp-content/themes/ledpdf/pdfimages/pending.png" width="100%" height="100%">
		</div>
<?php } ?>
<div class="row header">
		<img src="http://lampinator.com/roi/wp-content/themes/ledpdf/pdfimages/logo.png" width="50%" height="50%">
	<div class="contact">
		<?php while (has_sub_field('sales_person')) {  ?>
			<p><?php the_sub_field('name'); ?></p>
			<p><?php the_sub_field('phone'); ?></p>
			<p><?php the_sub_field('email'); ?></p>
		<?php } ?>
	</div>
</div>
<div class="row dots">&nbsp; </div>
<!-- END HEADER -->
<div class="row crosshead">
	<h1>Crossover Analysis</h1>
	<p class="small">Use existing capital to create immediate cash flow. With this option you can turn the savings into immediate cash flow. The requirement for this option is an initial cash outlay, which gives you 100% monthly savings.</p>
</div>

<div class="row charts">
	<h5 class="is">Identified Savings</h5>
	<h5 class="isv">$<?php echo number_format(round($annual_cost_saved)); ?></h5>
	<h5 class="pl">Proposed Lighting</h5>
	<h5 class="plv">$<?php echo number_format(round($proposed_energy_cost)); ?></h5>
	<div class="leftbox">
		<h1>Current Lighting Expense</h1>
		<div class="circle"><h2>$<?php echo number_format(round($existing_energy_cost)); ?></h2></div>
	</div>
	<div class="rightbox">
		<h1>Lighting Expense After</h1>



		<?php if ($chartnew > $chartsave) { ?>
			<div class="pie big" data-start="0" data-value="<?php echo round($chartnew*360); ?>"></div>
			<div class="pie" data-start="<?php echo round($chartnew*360); ?>" data-value="<?php echo round($chartsave*360); ?>"></div>
		<?php } else { ?>
			<div class="pie" data-start="0" data-value="<?php echo round($chartnew*360); ?>"></div>
			<div class="pie big" data-start="<?php echo round($chartnew*360); ?>" data-value="<?php echo round($chartsave*360); ?>"></div>
		<? } ?>
	</div>
</div>

<div class="row chartdata">
<ul>
	<li class="higlight"><h4>Chart Data</h4></li>
	<li><b>Current Annual Energy Use</b></li>
	<li>Proposed kWh Use <span><?php echo number_format(round($proposed_tkWh)); ?></span></li>
	<li>Proposed Energy Cost <span>$<?php echo number_format(round($proposed_energy_cost)); ?></span></li>
	<li>Exisiting kWh Use <span><?php echo number_format(round($existing_tkWh)); ?></span></li>
	<li>Exisiting Energy Cost <span>$<?php echo number_format(round($existing_energy_cost)); ?></span></li>
	<li class="blank"> &nbsp; </li>
	<li>Annual kWh Savings <span><?php echo number_format(round($annual_kw_saved)); ?></span></li>
	<li>Annual Energy Savings <span>$<?php echo number_format(round($annual_cost_saved)); ?></span></li>
	<li>Annual Maintance Savings <span>$<?php echo number_format(round($maintance)); ?></span></li>
	<li>Annual A/C Savings <span>$<?php echo number_format(round($ac_savings)); ?></span></li>
	<li class="blank"> &nbsp; </li>
	<li>Total Return Over Each Month <span>$<?php echo number_format(round($RORmonth)); ?></span></li>
	<li>Total Return Over 1 Year <span>$<?php echo number_format(round($RORone)); ?></span></li>
	<li>Total Return Over 5 Years <span>$<?php echo number_format(round($RORfive)); ?></span></li>
	<li>Total Return Over 10 Years <span>$<?php echo number_format(round($RORten)); ?></span></li>
	<li>Total Return Over 20 Years <span>$<?php echo number_format(round($RORtwen)); ?></span></li>
	<li class="blank"> &nbsp; </li>
	<li class="higlight"><h4>Rebates and Incentives</h4></li>
	<li>Utility Energy Incentive and/or Rebate <span>$<?php echo number_format(round($enginc)); ?></span></li>
	<li>Epact 179d Tax Incentive <span>$<?php echo number_format(round($taxinc)); ?></span></li>
	<li class="blank"> &nbsp; </li>
	<li>Payback Period in Years Before Rebates and Incentives <span><?php echo number_format((float)$payback, 2, '.', ''); ?></span></li>
	<li>Payback Period in Years After Rebates and Incentives <span><?php echo number_format((float)$paybackre, 2, '.', ''); ?></span></li>
	<li class="blank"> &nbsp; </li>
	<li class="higlight"><h4>Capital Outlay</h4></li>
	<li>Capital Outlay for Purchase <span>$<?php echo number_format((float)$capital_outlay, 2, '.', ','); ?></span></li>
	<li>Pre-Incentive ROI <span><?php echo number_format((float)$return_on_investment, 2, '.', ',') ;?>%</span></li>
	<li>Pre-Incentive Payback in Years <span><?php echo number_format((float)$payback, 2, '.', ''); ?></span></li>
</ul>

</div>

<!-- FOOTer  -->
<div class="row footer">
	<p class="left"><span class="num">5</span><a href="http://www.ledsource.com">LEDsource.com</a> - Proposal Prepared For <span><?php the_title(); ?></p>
	<p class="right"><?php echo date('F jS Y'); ?>
</div>


<!-- START HEADER-->
<?php if ( get_post_status ( $post->ID ) == 'pending' ) { ?>
		<div class="row pending">
			<img src="http://lampinator.com/roi/wp-content/themes/ledpdf/pdfimages/pending.png" width="100%" height="100%">
		</div>
<?php } ?>
<div class="row header">
		<img src="http://lampinator.com/roi/wp-content/themes/ledpdf/pdfimages/logo.png" width="50%" height="50%">
	<div class="contact">
		<?php while (has_sub_field('sales_person')) {  ?>
			<p><?php the_sub_field('name'); ?></p>
			<p><?php the_sub_field('phone'); ?></p>
			<p><?php the_sub_field('email'); ?></p>
		<?php } ?>
	</div>
</div>
<div class="row dots">&nbsp; </div>
<!-- END HEADER -->
<div class="pageblock">
	<div class="row">
		<ul class="dotlist">
				<li>
					<span>&nbsp;</span>
					<p>Pricing Valid for 45 days</p>
				</li>
				<li>
					<span>&nbsp;</span>
					<p>Figures or percentages indicated in this proposal are considered to be generated on the best efforts basis, based on certain stipulated conditions concerning blended kWh electricity rate; hours of operation; existing lighting system data; and proposed lighting system data. All calculations or figures are estimates or based on estimated information.</p>
					</li>
				<li>
					<span>&nbsp;</span>
					<p>HVAC operating hours source: Controlling Energy Consumption in Single Buildings, U.S. Department of the Navy, Naval Civil Engineering Lab, CR82.028, 1982</p>
				</li>
				<li>
					<span>&nbsp;</span>
					<p>HVAC savings calculated using formulas created by Rundquist Associates, using data from ASHRAE, validated by DOE-2 Computer modeling. Available at <a href="http://www.lightsearch.com/resources/lightguides/hvac.html">http://www.lightsearch.com/resources/lightguides/hvac.html</a></p>
				</li>
		</ul>
	</div>
	<div class="row acc">
		<h1>PROPOSAL ACCEPTANCE</h1>
		<h3>Investments</h3>
		<ul>
			<li>Product <span>$<?php echo number_format((float)$project_cost, 2, '.', ','); ?></span></li>
			<li>Sales Tax<span>$<?php echo number_format((float)$salestax, 2, '.', ','); ?></span></li>
			<li>Shipping<span>$<?php echo number_format((float)$ship, 2, '.', ','); ?></span></li>
			<li>Estimated Installation <span>$<?php echo number_format((float)$install, 2, '.', ','); ?></li>
			<li>Total Proposed Amount <span>$<?php echo number_format((float)$total, 2, '.', ','); ?></li>
		</ul>
	</div>
	<div class="row payments">
		<ul>
		<?php while (has_sub_field('payment')) {
					$postobject = get_sub_field('option');
					$pid = $postobject->ID; ?>
				<li>
				<h3><?php echo get_post_field('post_title', $pid);?></h3>
				<img src="http://lampinator.com/roi/wp-content/themes/ledpdf/pdfimages/box.png" height="20" width="20">	<p><?php  echo get_post_field('post_content', $pid); ?></p>
				</li>
		<?php } ?>
		</ul>
		<p class="disclaim">
			<b><sup>*</sup>Acceptance of Proposal:</b>The prices, specifications and terms contained herein are satisfactory and are hereby accepted. I accept and agree to the items selected above. LED Source is authorized to proceed with the project and to provide the products and services as specified. Payments will be made as outlined above. I have read and agree to the terms and conditions, and statements contained herein.
		</p>
	</div>
	<div class="row sign">
		<ul>
			<li>Name:	<span>Title:</span></li>
			<li>Email:	<span>Signature:</span></li>
			<li>Date:	<span>Purchase Order#:</span></li>
		</ul>
	</div>
</div>
<!-- FOOTer  -->
<div class="row footer">
	<p class="left"><span class="num">6</span><a href="http://www.ledsource.com">LEDsource.com</a> - Proposal Prepared For <span><?php the_title(); ?></p>
	<p class="right"><?php echo date('F jS Y'); ?>
</div>
<?php wp_footer(); ?>
