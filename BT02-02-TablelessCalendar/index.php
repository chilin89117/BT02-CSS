<?php
// Set up variables for month and year to display ---------------------
if(isset($_POST['submit']))
{
	$curr_mth = $_POST['mth'];
	$curr_yr = $_POST['yr'];
} else {
	$curr_mth = date('n');
	$curr_yr = date('Y');
}

// Today --------------------------------------------------------------
$curr_dt = date('j');

// Number of days in current month ------------------------------------
$days_in_curr_mth = cal_days_in_month(CAL_GREGORIAN, $curr_mth, $curr_yr);

// Number of days in February -----------------------------------------
if($curr_mth == 2 AND $curr_yr % 4 == 0)
{
	$days_in_curr_mth = 29;
}

// Month names for drop-down selection and <h1> -----------------------
$months = [1=>'January', 2=>'February', 3=>'March', 4=>'April',
					5=>'May', 6=>'June', 7=>'July', 8=>'August',
					9=>'September', 10=>'October', 11=>'November', 12=>'December'];
?>
<!DOCTYPE html>
<html>
	<head>
		<title>U12-02-ResponsiveTablelessCalendar</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="style.css" type="text/css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
		<script src="script.js"></script>
	</head>
	
	<body>
		<div id="calendar-wrap">
			<header>
				<p><?= $months[$curr_mth].' '.$curr_yr; ?></p>
				<form method="post" action="index.php">
					<select id="m-select" name="mth">
					<?php
						for($i=1;$i<=12;$i++)
						{
							if($curr_mth == $i)
							{
								echo "<option value='$i' selected>$months[$i]</option>";
							} else {
								echo "<option value='$i'>$months[$i]</option>";
							}
						}
					?>
					</select>

					<select id="y-select" name="yr">
					<?php
						for($y=2014;$y<=2020;$y++)
						{
							if($curr_yr == $y)
							{
								echo "<option value='$y' selected>$y</option>";
							} else {
								echo "<option value='$y'>$y</option>"; 					
							}
						}					
					?>	
					</select>
					<input type="submit" name="submit" value="Change" />
				</form>
			</header>
			
			<div id="calendar">
				<ul id="weekdays">
					<li>Sunday</li>
					<li>Monday</li>
					<li>Tuesday</li>
					<li>Wednesday</li>
					<li>Thursday</li>
					<li>Friday</li>
					<li>Saturday</li>
				</ul>
<?php
// Last month ---------------------------------------------------------
if($curr_mth == 1)
{
	$prev_mth = 12;
	$prev_yr = $curr_yr - 1;
} else {
	$prev_mth = $curr_mth - 1;
	$prev_yr = $curr_yr;
}

$days_in_prev_mth = cal_days_in_month(CAL_GREGORIAN, $prev_mth, $prev_yr);

if($prev_mth == 2 AND $prev_yr % 4 == 0)
{
	$days_in_prev_mth = 29;
}

// First & last day of current month ----------------------------------
$curr_first_day_of_wk = jddayofweek(cal_to_jd(CAL_GREGORIAN, $curr_mth, 1, $curr_yr), 0 );
$curr_last_day_of_wk = jddayofweek(cal_to_jd(CAL_GREGORIAN, $curr_mth, $days_in_curr_mth, $curr_yr), 0 );

// Find first day to display (including previous month) --------------- 
if($curr_first_day_of_wk > 0)
{
	$first_day = $days_in_prev_mth - $curr_first_day_of_wk + 1;
} else {
	$first_day = $days_in_prev_mth - 6;
}

// Display last few days of previous month (up to a week) -------------
$day_of_wk = 0;
$date = $first_day;

$flag = 'other-month';

$output = "<ul class='days'>\n";

while($date <= $days_in_prev_mth)
{
	$output .= "\t<li class='day $flag' id='$prev_yr-$prev_mth-$date'>\n";
	$output .= "\t\t<div class='date'>$date</div>\n";
	$output .= "\t</li>\n";
	
	$day_of_wk++;
	$date++; 
}

// Display current month ----------------------------------------------
$date = 1;

while($date <= $days_in_curr_mth)
{
	if($date == $curr_dt AND $curr_mth == date('n') AND $curr_yr == date('Y'))
	{
		$flag = 'today';	
	} else {
		$flag = '';
	}	
	
	$day_of_wk %= 7;

	$output .= "\t<li class='day $flag' id='$curr_yr-$curr_mth-$date'>\n";
	$output .= "\t\t<div class='date'>$date</div>\n";
	$output .= "\t</li>\n";
	
	if($day_of_wk == 6)
	{
		$output .= "</ul>\n";
		$output .= "<ul class='days'>\n";
	}

	$day_of_wk++;
	$date++;
}

// Display first few days of next month to finish the current week ----
$date = 1;
$flag = 'other-month';

if($curr_mth == 12)
{
	$next_mth = 1;
	$curr_yr ++;
} else {
	$next_mth = $curr_mth + 1;
}

// Or, if last day falls on Saturday, print full week of next month ---
if($day_of_wk == 7) {$day_of_wk = 0;}

while($day_of_wk <= 6)
{
	$output .= "\t<li class='day $flag' id='$curr_yr-$next_mth-$date'>\n";
	$output .= "\t\t<div class='date'>$date</div>\n";
	$output .= "\t</li>\n";

	$day_of_wk++;
	$date++;
}

$output .= "</ul>\n";
echo $output;
?>

			</div>
		</div>
	</body>
</html>