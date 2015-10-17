<?php
// include($_SERVER['DOCUMENT_ROOT'].'/Beta/web-app-new/php/function/session_start.php');
include($_SERVER['DOCUMENT_ROOT'].'/v0-5/php/function/session_start.php');
// include($_SERVER['DOCUMENT_ROOT'].'/Beta/web-app-new/php/function/user_data.php');
include($_SERVER['DOCUMENT_ROOT'].'/v0-5/php/function/user_data.php');
$pic_status = is_file($_SERVER['DOCUMENT_ROOT'].'/profile_img/users/'.$user_id.'.jpg');

?>

<div class="sidebar">
    <div class="user-display">
    <?php 
        if($pic_status==true)
        {?>
        <div class="user-display-image" style="background-image: url(/profile_img/users/<?php echo $user_id; ?>.jpg)"></div>
        <?php }
        else
        {?>
        <div class="user-display-image" style="background-image: url(/profile_img/users/user-default.jpg)"></div>
    <?php } ?>
        <p id="user-display-name"><?php echo $first_name; ?> <?php echo $last_name; ?></p>
    </div>
    <nav>
        <a href="dashboard.php" id="nav-item-dashboard"><i class="fa fa-area-chart fa-fw"></i>&nbsp;Dashboard</a>
        <a href="social.php" id="nav-item-social"><i class="fa fa-users fa-fw"></i>&nbsp;Social</a>
        <a href="challenges.php" id="nav-item-challenges"><i class="fa fa-calendar-check-o fa-fw"></i>&nbsp;Challenges</a>
        <a onClick="toggleNotificationTray()" id="nav-item-notifications"><i class="fa fa-bell fa-fw"></i>&nbsp;Notifications&nbsp;<i id="notify" class="fa fa-star"></i></a>
        <a href="settings.php" id="nav-item-settings"><i class="fa fa-cog fa-fw"></i>&nbsp;Settings</a>
        <a href="./php/function/logout.php" id="nav-item-logout"><i class="fa fa-close fa-fw"></i>&nbsp;Logout</a>
    </nav>
</div>