<nav class="navbar navbar-default" style="border-radius: 0px;margin-bottom: 0px;">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">MFS</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="<?php if($page == 'Sms bKash Page') echo 'active'; ?>"><a href="inbox.php">bKash Transactions</a></li>
            <li class="<?php  if($page == 'Sms 16216 Page') echo 'active' ; ?>"><a href="outbox.php">Rocket Transactions</a></li>
            <li class="<?php if($page == 'Search Page') echo 'active'; ?>"><a href="search_page.php">Search</a></li>
            <li class="<?php if($page == 'Delete Page') echo 'active'; ?>"><a href="delete_page.php">Delete</a></li>
            <li class="<?php if($page == 'Change Password') echo 'active'; ?>"><a href="change-pw.php">Change Password</a></li>

        </ul>
    </div>
</nav>