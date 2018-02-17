<?php
include '../../../htconfig/dbConfig2.php';

$con = new mysqli($db->host, $db->user, $db->pass, 'udemy');

$yr_mth = $_POST['input'];

$sql = "SELECT DATE_FORMAT(dt, '%Y-%c-%e') AS dd, descript
				FROM u1202calendar WHERE DATE_FORMAT(dt, '%Y-%c-%e') LIKE '$yr_mth'
				ORDER BY dt
				";
$result = $con->query($sql);

while($row = $result->fetch_assoc())
{
	$evts[] = $row;
}

echo json_encode($evts);
?>