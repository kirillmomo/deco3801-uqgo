<?php
// include($_SERVER['DOCUMENT_ROOT'].'/Beta/web-app-new/php/function/session_start.php');
include($_SERVER['DOCUMENT_ROOT'].'/v0-2/php/function/session_start.php');
// include($_SERVER['DOCUMENT_ROOT'].'/Beta/web-app-new/php/function/user_data.php');
include($_SERVER['DOCUMENT_ROOT'].'/v0-2/php/function/user_data.php');
?>

<div class="sidebar">
    <div class="user-display">
        <div class="user-display-image"></div>
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