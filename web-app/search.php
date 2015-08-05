<?php
	include('connect.php');

	$keyword = $_GET['keyword'];


	$query_session = "SELECT id, date, time FROM route WHERE time LIKE '%".$keyword."%' OR date LIKE '%".$keyword."%' ORDER BY id DESC ";
	$result_session = mysqli_query($dbconn, $query_session);

	$counter = 0;
	while($row = mysqli_fetch_array($result_session)){
					if(isset($_GET['id'])){
						if($row['id'] == $_GET['id']){
							echo "
								<a href='track.php?id=".$row['id']."'><div class='session-tag'><p>".$row['date']." ".$row['time']."</p></div></a>
							";
						} else {
							echo "
								<a href='track.php?id=".$row['id']."'><div class='session-tag'><p>".$row['date']." ".$row['time']."</p></div></a>
							";
						}
					} else {
						if($counter == 0){
							echo "
								<a href='track.php?id=".$row['id']."'><div class='session-tag'><p>".$row['date']." ".$row['time']."</p></div></a>
							";
							$counter++;
						} else {
							echo "
								<a href='track.php?id=".$row['id']."'><div class='session-tag'><p>".$row['date']." ".$row['time']."</p></div></a>
							";
						}
					}
				}
?>