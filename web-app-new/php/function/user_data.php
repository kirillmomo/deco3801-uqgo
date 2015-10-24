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
	$error_msg="";
	$user_name="";
	$first_name="";
	$last_name="";
	$user_icon="";
	$user_email = "";
	$user_birth_day = "";
	$user_birth_month = "";
	$user_birth_year = "";
	$user_height = 0;
	$user_weight = 0;
	$user_age=0;
	$user_member_date=0;
	$user_friend_number=0;
	$user_group_number=0;
	$user_challenges_number=0;
	$friend_list_display=array();
	$friend_list_id=array();
	$friend_list_firstname=array();
	$friend_list_lastname=array();
	$friend_list_icon=array();
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
	$search_all_user_id=array();
	$search_all_user_username=array();
	$search_all_user_firstname=array();
	$search_all_user_lastname=array();
	$friend_group_firstname=array();
	$friend_group_lastname=array();
	$friend_group_id=array();
	$search_friend_request_user_id = array();
	$search_friend_request_first_name = array();
	$search_friend_request_last_name = array();
	$a=0;
	$b=0;
	$c=0;
	$d=0;
	$x=0;
	$y=0;
	$z=0;
	
	// SQL query
	$user_query = "SELECT * FROM user WHERE user_id = '$user_id'";	
	$friend_query = "SELECT * FROM user WHERE user_id = '$friend_id'";	
	$user_friend_query = "SELECT * FROM friends WHERE user_id = '$user_id' or friend_id = '$user_id'";
	$user_group_query = "SELECT * FROM group_member WHERE group_member_user_id = '$user_id'";
	$user_challenge_query = "SELECT * FROM challenge_member WHERE challenge_user_id = '$user_id'";
	$user_data = mysqli_query($dbconn, $user_query);
	$friend_data = mysqli_query($dbconn, $friend_query);
	$user_friend_data = mysqli_query($dbconn, $user_friend_query);
	$user_group_data = mysqli_query($dbconn, $user_group_query);
	$user_challenge_data = mysqli_query($dbconn, $user_challenge_query);

	$user_group_number = mysqli_num_rows($user_group_data);
	$user_challenges_number = mysqli_num_rows($user_challenge_data);
	$user_friend_number = mysqli_num_rows($user_friend_data);

	// Store user data into variable
	while($user_row = mysqli_fetch_array($user_data))
		{
			$user_name = $user_row['username'];
			$first_name = $user_row['first_name'];
			$last_name = $user_row['last_name'];
			$user_icon = $user_row['user_icon'];
			$user_email = $user_row['user_email'];
			$user_height = $user_row['user_height'];
			$user_weight = $user_row['user_weight'];
			$user_age = date("Y") - date("Y",strtotime($user_row['user_day_of_birth']));
			$user_birth_day = date("d",strtotime($user_row['user_day_of_birth']));
			$user_birth_month = date("F",strtotime($user_row['user_day_of_birth']));
			$user_birth_year = date("Y",strtotime($user_row['user_day_of_birth']));
			$user_member_date = date("Y",strtotime($user_row['user_date_created']));
		}

		while($friend_row = mysqli_fetch_array($friend_data))
		{
			$friend_name = $friend_row['username'];
			$friend_friend_id = $friend_row['user_id'];
			$friend_first_name = $friend_row['first_name'];
			$friend_last_name = $friend_row['last_name'];
			$friend_age = date("Y") - date("Y",strtotime($friend_row['user_day_of_birth']));
			$friend_member_date = date("Y",strtotime($friend_row['user_date_created']));
		}

	// Store user friends data into variable
	while($user_friend_row = mysqli_fetch_array($user_friend_data))
		{
			$friend_user_id = $user_friend_row['user_id'];
			$friend_friend_id = $user_friend_row['friend_id'];

			// Check the friend list of the user
			if($friend_user_id==$user_id && $friend_friend_id!=$user_id)
			{
				$friend_query = "SELECT * FROM user WHERE user_id = '$friend_friend_id'";	
				$friend_data = mysqli_query($dbconn, $friend_query);
				while($friend_row = mysqli_fetch_array($friend_data))
				{
					$search_user_friend_id[$x]=$friend_row['user_id'];
				}
			}
			elseif($friend_friend_id==$user_id && $friend_user_id!=$user_id)
			{
				$friend_query = "SELECT * FROM user WHERE user_id = '$friend_user_id'";
				$friend_data = mysqli_query($dbconn, $friend_query);
				while($friend_row = mysqli_fetch_array($friend_data))
				{
					$search_user_friend_id[$x]=$friend_row['user_id'];
				}
			}
			$x++;
		}

		//Search unadded user
		$search_friend_array = implode(',', $search_user_friend_id);
		$search_friend_query = "SELECT * FROM user WHERE user_id != $user_id AND user_id NOT IN ($search_friend_array) and first_name LIKE '%$search_detail%' OR user_id != $user_id AND user_id NOT IN ($search_friend_array) and last_name LIKE '%$search_detail%'  ";	
		$search_friend_data = mysqli_query($dbconn, $search_friend_query);
		$search_friend_data_status = mysqli_query($dbconn, $search_friend_query);
		$search_all_user_query = "SELECT * FROM user WHERE user_id != $user_id AND first_name LIKE '%$search_detail%' OR user_id != $user_id AND last_name LIKE '%$search_detail%'";	
		$search_all_user_data = mysqli_query($dbconn, $search_all_user_query);
		$search_all_user_data_status = mysqli_query($dbconn, $search_all_user_query);

		if(mysqli_fetch_array($search_friend_data_status)==false && mysqli_fetch_array($search_all_user_data_status)==false)
		{
			$error_msg="<i class='fa fa-frown-o'></i> No users found.";
		}

		while($search_friend_row = mysqli_fetch_array($search_friend_data))
			{
				$search_friend_id[$z] = $search_friend_row['user_id'];
				$search_friend_username[$z] = $search_friend_row['username'];
				$search_friend_firstname[$z] = $search_friend_row['first_name'];
				$search_friend_lastname[$z] = $search_friend_row['last_name'];
				$z++;
			}

		while($search_all_user_row = mysqli_fetch_array($search_all_user_data))
			{
				$search_all_user_id[$b] = $search_all_user_row['user_id'];
				$search_all_user_username[$b] = $search_all_user_row['username'];
				$search_all_user_firstname[$b] = $search_all_user_row['first_name'];
				$search_all_user_lastname[$b] = $search_all_user_row['last_name'];
				$b++;
			}

		// Search friend request
		
		$search_friend_request_query = "SELECT * FROM user INNER JOIN friend_request ON user.user_id = friend_request.user_id WHERE request_friend_id = $user_id";
		$search_friend_request_data=mysqli_query($dbconn, $search_friend_request_query);
		while($search_friend_request_row = mysqli_fetch_array($search_friend_request_data))
			{
				$search_friend_request_user_id[$d] = $search_friend_request_row['user_id'];
				$search_friend_request_first_name[$d] = $search_friend_request_row['first_name'];
				$search_friend_request_last_name[$d] = $search_friend_request_row['last_name'];
				$d++;
			}
		

		// Add Friend
		$search_friend_available_query1 = "SELECT * FROM friends WHERE user_id = $user_id AND friend_id = $add_user_id";
		$search_friend_available_query2 = "SELECT * FROM friends WHERE user_id = $add_user_id AND friend_id = $user_id";
		$search_friend_delete_query1 = "SELECT * FROM friends WHERE user_id = $user_id AND friend_id = $delete_user_id";
		$search_friend_delete_query2 = "SELECT * FROM friends WHERE user_id = $delete_user_id AND friend_id = $user_id";
		$check_friend_request_query1 = "SELECT * FROM friend_request WHERE user_id = $user_id AND request_friend_id = $add_user_id";
		$check_friend_request_query2 = "SELECT * FROM friend_request WHERE user_id = $add_user_id AND request_friend_id = $user_id";
		$search_friend_available_data1 = mysqli_query($dbconn, $search_friend_available_query1);
		$search_friend_available_data2 = mysqli_query($dbconn, $search_friend_available_query2);
		$status_search_friend_available1 = mysqli_fetch_array($search_friend_available_data1);
		$status_search_friend_available2 = mysqli_fetch_array($search_friend_available_data2);
		$search_friend_delete_data1 = mysqli_query($dbconn, $search_friend_delete_query1);
		$search_friend_delete_data2 = mysqli_query($dbconn, $search_friend_delete_query2);
		$status_search_friend_delete1 = mysqli_fetch_array($search_friend_delete_data1);
		$status_search_friend_delete2 = mysqli_fetch_array($search_friend_delete_data2);
		$check_friend_request_data1=mysqli_query($dbconn, $check_friend_request_query1);
		$check_friend_request_data2=mysqli_query($dbconn, $check_friend_request_query2);
		$check_friend_request_available1=mysqli_fetch_array($check_friend_request_data1);
		$check_friend_request_available2=mysqli_fetch_array($check_friend_request_data2);
		
		if($add_user_id!=null)
		{

			if ($status_search_friend_available1==false && $status_search_friend_available2==false && $check_friend_request_available1==false && $check_friend_request_available2==false) 
			{
				$add_query = "INSERT INTO friend_request SET user_id='$user_id', request_friend_id='$add_user_id'";
	        	mysqli_query($dbconn, $add_query);
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
	        	mysqli_query($dbconn, $delete_query);
	        	unset($_SESSION["delete_userid"]);
			}
			else if ($status_search_friend_delete1!=false && $status_search_friend_delete2==false) 
			{
				$delete_query = "DELETE FROM friends WHERE user_id='$user_id' AND friend_id='$delete_user_id'";
	        	mysqli_query($dbconn, $delete_query);
	        	unset($_SESSION["delete_userid"]);
			}
			else
			{
				unset($_SESSION["delete_userid"]);
			}
    	}


    	$rank_by_friend_search = implode(',', $search_user_friend_id);
		$rank_by_friend_search_query = "SELECT * FROM user WHERE user_id IN ($rank_by_friend_search) ORDER BY $rank_by DESC";	
		$rank_by_friend_search_data = mysqli_query($dbconn, $rank_by_friend_search_query);
		while($rank_by_friend_search_row = mysqli_fetch_array($rank_by_friend_search_data))
		{
			$friend_list_display[$a] = $rank_by_friend_search_row['username'];
			$friend_list_firstname[$a] = $rank_by_friend_search_row['first_name'];
			$friend_list_lastname[$a] = $rank_by_friend_search_row['last_name'];
			$friend_list_icon[$a] = $rank_by_friend_search_row['user_icon'];
			$friend_list_id[$a]=$rank_by_friend_search_row['user_id'];
		$a++;
		}

		$group_friend_search = implode(',', $search_user_friend_id);
		$group_friend_search_query = "SELECT * FROM user WHERE user_id IN ($group_friend_search) ORDER BY first_name";	
		$group_friend_search_data = mysqli_query($dbconn, $group_friend_search_query);
		while($group_friend_search_row = mysqli_fetch_array($group_friend_search_data))
		{
			$friend_group_firstname[$c] = $group_friend_search_row['first_name'];
			$friend_group_lastname[$c] = $group_friend_search_row['last_name'];
			$friend_group_id[$c]=$group_friend_search_row['user_id'];
		$c++;
		}

		// Delete friend and search session
		unset($_SESSION["friend_id"]);
		unset($_SESSION["search"]);
?>
