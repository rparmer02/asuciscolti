<?php

 	$username="drup197";

 	$password="bandit20";

        $database="drup197";

        $server="localhost";

 	$link = mysqli_connect($server,$username,$password,$database);

 

 	$query = "

 				SELECT * 

 				FROM dr_webform_views_add_lti_content_9 wfc

 				LEFT JOIN dr_file_managed f on f.fid = wfc.display_image
                                LEFT JOIN LTIComments c on c.LTIKey = wfc.sid

 			 "; 

 	

 	$result = mysqli_query($link,$query);

 	

 	if(!$result)  die( "Query: " . $query . "\nError:" . mysql_error() );

 	//print_r($row);

     $tableData = '{"aaData": [[';

     $rowNum = mysqli_num_rows($result);

 
     //Set up to display rows of 4
     for($i=0; $i<$rowNum; $i+=4){

 		if($i>0) $tableData .= ',[';

 		$row = mysqli_fetch_array($result);

 	    $tableData .= formatData($row) . ',';

 		$row = mysqli_fetch_array($result);

 	    $tableData .= formatData($row) . ',';

 		$row = mysqli_fetch_array($result);

 	    $tableData .= formatData($row) . ',';

 		$row = mysqli_fetch_array($result);

 		$tableData .= formatData($row) . ']';

     }

     $tableData .= ']}';

 

     echo $tableData;

 	

 	function formatData($rowArray){

 		if($rowArray){

     		if($rowArray['filename'] != "") 

 				$table = '"<a href=\"?q=instructor_preview\"><img width=\"200px\" height=\"200px\" src=\"http://68.2.131.105:8080/drupal/sites/'

                        . 'default/files/webform/Form_displaypics/' . $rowArray['filename'] . '\" alt=\"No Image\"><br/>';

 			else $table = '"<a href=\"?q=instructor_preview\"><img width=\"200px\" height=\"200px\" src=\"http://68.2.131.105:8080/drupal/Uploaded'

                        . '/Images/thumbnail_default.png\" alt=\"No Image\"><br/>';

 	

 	        if($rowArray['name'] != "") $table .= $rowArray['name'] . '</a><br/>';

 	        else $table .= 'No Name</a><br/>';

	        if($rowArray['rating'] != "") $table .= formatRating($rowArray['rating']) . '<br/>';
	        else $table .= formatRating(0) . '<br/>';

	        if($rowArray['description'] != "") $table .= $rowArray['description'] . '"';

 	        else $table .= 'No description"';

 		}else{

 		    $table ='" "';

 		}

 		return $table;

 	}

    	function formatRating($star){
        	$return = '';
        	for($i=1; $i<6; $i++){
          	  if($i == $star)
			$return .= '<input type=\"radio\" value=\"\" class=\"star\" disabled=\"disabled\" checked=\"checked\"/>';
	  	  else
			$return .= '<input type=\"radio\" value=\"\" class=\"star\" disabled=\"disabled\"/>';
       	 	}
		return $return;
    	}


 

 ?>

 
