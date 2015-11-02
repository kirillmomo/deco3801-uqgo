<?php 
// This is the function that generate report as xls file
session_start();

// If session is empty, return to admin login page
if(empty($_SESSION['admin_id'])){
    header('Location: /v0-6/admin-login.php');
  } 

// title
$contents="Report\nNumber\tAge\tGender\tHeight(cm)\tWeight(KG)\tSteps\tDistance(KM)\tCalories(Kcal)\n";
// user filtered/unfiltered data
for($i = 0; $i<sizeof($_SESSION['user_age_arr_xls']); $i++)
{
$contents.=($i+1)."\t";
$contents.=$_SESSION['user_age_arr_xls'][$i]."\t";
$contents.=$_SESSION['user_gender_arr_xls'][$i]."\t";
$contents.=$_SESSION['user_height_arr_xls'][$i]."\t";
$contents.=$_SESSION['user_weight_arr_xls'][$i]."\t";
$contents.=$_SESSION['session_steps_arr_xls'][$i]."\t";
$contents.=$_SESSION['session_distance_arr_xls'][$i]."\t";
$contents.=$_SESSION['session_cal_arr_xls'][$i]."\n"; 
}
$contents = strip_tags($contents); // remove html and php tags etc.
Header("Content-Disposition: attachment; filename=uqgo_report_".date("Y-m-d").".xls");
// store data into xls file
print $contents;
exit;

 // delete all the user session data that generate in the admin page
unset($_SESSION["user_age_arr_xls"]);
unset($_SESSION["user_gender_arr_xls"]);
unset($_SESSION["user_height_arr_xls"]);
unset($_SESSION["user_weight_arr_xls"]);
unset($_SESSION["session_steps_arr_xls"]);
unset($_SESSION["session_distance_arr_xls"]);
unset($_SESSION["session_cal_arr_xls"]);

?>