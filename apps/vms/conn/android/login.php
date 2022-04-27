<?php
  include('conn.php');
  $name = str_replace(" ", "", $_POST['username']);
  $sql = "select * from user where '$name' = username";
  $query = mysql_query($sql);
  $result = mysql_fetch_array($query);
  $response = array();
  if (is_array($result)) {
  	if ($_POST['password'] == $result['password']) {
  		$response['success'] = 1;
  	} else {
  		$response['success'] = 0;
  	}
  	echo json_encode($response);
  }
  mysql_close($conn);
?>