<?php
function echoSeason($season)
{
	$output = "<div class='tl-block'>\n";
	$output .= "\t<div class='tl-year'>\n";
	$output .= "\t\t<div>Season $season</div>\n";
	$output .= "\t</div>\n";
	$output .= "</div>";
	
	echo $output;
}

function echoEpisode($position, $airdate, $title, $summary)
{
	$format_date = date('F j, Y', strtotime($airdate));	
	
	$output = "<div class='tl-block'>\n";
	$output .= "\t<div class='tl-event'>\n";
	$output .= "\t\t<div class='$position'>\n";
	$output .= "\t\t\t<div>\n";
	$output .= "\t\t\t\t<time datatime='$airdate'>$format_date</time>\n";
	$output .= "\t\t\t\t<h4>$title</h4>\n";
	$output .= "\t\t\t\t<p>$summary</p>\n";
	$output .= "\t\t\t</div>\n";
	$output .= "\t\t</div>\n";
	$output .= "\t</div>\n";
	$output .= "</div>\n";	
	
	echo $output;
}