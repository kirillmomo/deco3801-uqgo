<?php
	$search = $_GET['search']; // getting search term from ajax request

	// Do a search for user's full names containing the search term
	// Ensure that list returned are not already friends with the user
?>

<!-- EXAMPLE RETURNED LIST - users should be echoed like below -->
<li onClick="showProfile('1', this);"><div class="friend-image"></div><p>Random Fella</p></li>
<li onClick="showProfile('2', this);"><div class="friend-image"></div><p>Another Fella</p></li>
<li onClick="showProfile('3', this);"><div class="friend-image"></div><p>Some Fellow</p></li>
<li onClick="showProfile('4', this);"><div class="friend-image"></div><p>Mellow Fellow</p></li>