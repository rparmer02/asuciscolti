<?php
	$username="drup197";
	$password="bandit20";
	$database="drup197";
	$server="localhost";

	$link = mysqli_connect($server,$username,$password,$database);
 	//@mysql_select_db($database,$link) or die( "Unable to select database");

	$query = "
		SELECT name,expiration_date 
		FROM dr_webform_views_add_lti_content_9 wfc
		WHERE expiration_date IS NOT NULL AND TRIM(expiration_date) <> ''
		"; 

	$result = mysqli_query($link,$query);

	if(!$result)  die( "Query: " . $query . "\nError:" . mysql_error() );
 	//print_r($row);
	$tableData = '{"aaData": [[';
	$numRows = $result->num_rows;
	$row = mysqli_fetch_array($result);
	for ($i = 0; $i < $numRows; $i++) {
		if ($i != 0) {
			$tableData .= ",[";
		}
		$tableData .= '"' . $row['name'] . '",';
		$tableData .= '"' . $row['expiration_date'] . '"]';
		if ($i != $numRows - 1) {
			$row = mysqli_fetch_array($result);
		}
	}
	$tableData .= ']}';

	echo $tableData;
?>