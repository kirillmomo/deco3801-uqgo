<?php

	// Include connect php file
	include('connect.php');

	// Define user variable
	$user_id=$_SESSION['user_id'];
	$friend_id=$_SESSION['friend_id'];
	$search_detail=$_SESSION['search'];
	$add_user_id=$_SESSION['add_userid'];
	$delete_user_id=$_SESSION['delete_userid'];
	$rank_by=$_SESSION["rank_by"];
	$user_name="";
	$first_name="";
	$last_name="";
	$user_age=0;
	$user_member_date=0;
	$user_friend_number=0;
	$user_group_number=0;
	$user_challenges_number=0;
	$friend_list_display=array();
	$friend_list_id=array();
	$friend_list_firstname=array();
	$friend_list_lastname=array();
	$friend_name="";
	$friend_first_name="";
	$friend_last_name="";
	$friend_member_date="";
	$friend_friend_id=0;
	$friend_age=0;
	$search_user_id=array();
	$search_user_friend_id=array();
	$testing_id=array();
	$search_friend_id=array();
	$search_friend_username=array();
	$search_friend_firstname=array();
	$search_friend_lastname=array();
	$a=0;
	$x=0;
	$y=0;
	$z=0;
	
	// SQL query
	$user_query = "SELECT * FROM user WHERE user_id = '$user_id'";	
	$friend_query = "SELECT * FROM user WHERE user_id = '$friend_id'";	
	$user_friend_query = "SELECT * FROM friends WHERE user_id = '$user_id' or friend_id = '$user_id'";
	$user_group_query = "SELECT * FROM group_member WHERE group_member_user_id = '$user_id'";
	$user_challenge_query = "SELECT * FROM challenge_member WHERE challenge_user_id = '$user_id'";
	$user_data = mysql_query($user_query,$dbconn);
	$friend_data = mysql_query($friend_query,$dbconn);
	$user_friend_data = mysql_query($user_friend_query,$dbconn);
	$user_group_data = mysql_query($user_group_query,$dbconn);
	$user_challenge_data = mysql_query($user_challenge_query,$dbconn);

	$user_group_number = mysql_num_rows($user_group_data);
	$user_challenges_number = mysql_num_rows($user_challenge_data);
	$user_friend_number = mysql_num_rows($user_friend_data);

	// Store user data into variable
	while($user_row = mysql_fetch_array($user_data))
		{
			$user_name = $user_row['username'];
			$first_name = $user_row['first_name'];
			$last_name = $user_row['last_name'];
			$user_age = date("Y") - date("Y",strtotime($user_row['user_day_of_birth']));
			$user_member_date = date("Y",strtotime($user_row['user_date_created']));
		}

		while($friend_row = mysql_fetch_array($friend_data))
		{
			$friend_name = $friend_row['username'];
			$friend_friend_id = $friend_row['user_id'];
			$friend_first_name = $friend_row['first_name'];
			$friend_last_name = $friend_row['last_name'];
			$friend_age = date("Y") - date("Y",strtotime($friend_row['user_day_of_birth']));
			$friend_member_date = date("Y",strtotime($friend_row['user_date_created']));
		}

	// Store user friends data into variable
	while($user_friend_row = mysql_fetch_array($user_friend_data))
		{
			$friend_user_id = $user_friend_row['user_id'];
			$friend_friend_id = $user_friend_row['friend_id'];

			// Check the friend list of the user
			if($friend_user_id==$user_id && $friend_friend_id!=$user_id)
			{
				$friend_query = "SELECT * FROM user WHERE user_id = '$friend_friend_id'";	
				$friend_data = mysql_query($friend_query,$dbconn);
				while($friend_row = mysql_fetch_array($friend_data))
				{
					$search_user_friend_id[$x]=$friend_row['user_id'];
				}
			}
			elseif($friend_friend_id==$user_id && $friend_user_id!=$user_id)
			{
				$friend_query = "SELECT * FROM user WHERE user_id = '$friend_user_id'";
				$friend_data = mysql_query($friend_query,$dbconn);
				while($friend_row = mysql_fetch_array($friend_data))
				{
					$search_user_friend_id[$x]=$friend_row['user_id'];
				}
			}
			$x++;
		}

		//Search unadded user
		$search_friend_array = implode(',', $search_user_friend_id);
		$search_friend_query = "SELECT * FROM user WHERE user_id != $user_id AND user_id NOT IN ($search_friend_array) and first_name LIKE '%$search_detail%' OR user_id != $user_id AND user_id NOT IN ($search_friend_array) and last_name LIKE '%$search_detail%'  ";	
		$search_friend_data = mysql_query($search_friend_query,$dbconn);
		if($search_friend_data == false)
		{
			// $search_friend_query = "SELECT * FROM user WHERE user_id != $user_id and first_name LIKE '$search_detail%' ";	
			$search_friend_data = mysql_query($search_friend_query,$dbconn);
			while($search_friend_row = mysql_fetch_array($search_friend_data))
				{
					$search_friend_id[$z] = $search_friend_row['user_id'];
					$search_friend_username[$z] = $search_friend_row['username'];
					$search_friend_firstname[$z] = $search_friend_row['first_name'];
					$search_friend_lastname[$z] = $search_friend_row['last_name'];
					$z++;
				}

		}
		else
		{
			while($search_friend_row = mysql_fetch_array($search_friend_data))
				{
					$search_friend_id[$z] = $search_friend_row['user_id'];
					$search_friend_username[$z] = $search_friend_row['username'];
					$search_friend_firstname[$z] = $search_friend_row['first_name'];
					$search_friend_lastname[$z] = $search_friend_row['last_name'];
					$z++;
				}
		}

		// Add Friend
		$search_friend_available_query1 = "SELECT * FROM friends WHERE user_id = $user_id AND friend_id = $add_user_id";
		$search_friend_available_query2 = "SELECT * FROM friends WHERE user_id = $add_user_id AND friend_id = $user_id";
		$search_friend_delete_query1 = "SELECT * FROM friends WHERE user_id = $user_id AND friend_id = $delete_user_id";
		$search_friend_delete_query2 = "SELECT * FROM friends WHERE user_id = $delete_user_id AND friend_id = $user_id";
		$search_friend_available_data1 = mysql_query($search_friend_available_query1,$dbconn);
		$search_friend_available_data2 = mysql_query($search_friend_available_query2,$dbconn);
		$status_search_friend_available1 = mysql_fetch_array($search_friend_available_data1);
		$status_search_friend_available2 = mysql_fetch_array($search_friend_available_data2);
		$search_friend_delete_data1 = mysql_query($search_friend_delete_query1,$dbconn);
		$search_friend_delete_data2 = mysql_query($search_friend_delete_query2,$dbconn);
		$status_search_friend_delete1 = mysql_fetch_array($search_friend_delete_data1);
		$status_search_friend_delete2 = mysql_fetch_array($search_friend_delete_data2);

		if($add_user_id!=null)
		{

			if ($status_search_friend_available1==false && $status_search_friend_available2==false) 
			{
				$add_query = "INSERT INTO friends SET user_id='$user_id', friend_id='$add_user_id'";
	        	mysql_query($add_query);
	        	unset($_SESSION["add_userid"]);
			}
			else
			{
				unset($_SESSION["add_userid"]);
			}
    	}

    	// Delete friend
    	if($delete_user_id!=null)
		{

			if ($status_search_friend_delete1==false && $status_search_friend_delete2!=false) 
			{
				$delete_query = "DELETE FROM friends WHERE user_id='$delete_user_id' AND friend_id='$user_id'";
	        	mysql_query($delete_query);
	        	unset($_SESSION["delete_userid"]);
			}
			else if ($status_search_friend_delete1!=false && $status_search_friend_delete2==false) 
			{
				$delete_query = "DELETE FROM friends WHERE user_id='$user_id' AND friend_id='$delete_user_id'";
	        	mysql_query($delete_query);
	        	unset($_SESSION["delete_userid"]);
			}
			else
			{
				unset($_SESSION["delete_userid"]);
			}
    	}


    	$rank_by_friend_search = implode(',', $search_user_friend_id);
		$rank_by_friend_search_query = "SELECT * FROM user WHERE user_id IN ($rank_by_friend_search) ORDER BY $rank_by DESC";	
		$rank_by_friend_search_data = mysql_query($rank_by_friend_search_query,$dbconn);
		while($rank_by_friend_search_row = mysql_fetch_array($rank_by_friend_search_data))
		{
			$friend_list_display[$a] = $rank_by_friend_search_row['username'];
			$friend_list_firstname[$a] = $rank_by_friend_search_row['first_name'];
			$friend_list_lastname[$a] = $rank_by_friend_search_row['last_name'];
			$friend_list_id[$a]=$rank_by_friend_search_row['user_id'];
		$a++;
		}


		unset($_SESSION["friend_id"]);
		unset($_SESSION["search"]);
?>
<!-- user_id NOT IN ($matches) AND user_id != $user_id AND -->