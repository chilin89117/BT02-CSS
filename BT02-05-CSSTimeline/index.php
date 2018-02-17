<?php
include '../../../htconfig/dbConfig2.php';
include 'includes/header.php';
include 'includes/functions.php';

$con = new mysqli($db->host, $db->user, $db->pass, 'udemy');

$sql = "SELECT * FROM udemy.U1205timeline ORDER BY season, episode";
$result = $con->query($sql);

$current_season = 0;

while($row = $result->fetch_object())
{
	$season = $row->season;
	$episode = $row->episode;
	$airdate = $row->airdate;
	$title = $row->title;
	$summary = $row->summary;
	
	if($season != $current_season)
	{
		echoSeason($season);
		$current_season = $season;
	}
	
	if($episode % 2 == 1)
	{
		$position = "event-l";
	} else {
		$position = "event-r";
	}
	
	echoEpisode($position, $airdate, $title, $summary);
}		
?>
					
<?php
include 'includes/footer.php';
?>