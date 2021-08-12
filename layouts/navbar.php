<div class="container">
<div class="row">
    <div class="col-lg-12 pt-5">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>" href="/public/" id="profileLink">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'change_password.php'? 'active' : ''  ?>" href="/public/change_password.php" id="cpLink">Change Password</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php" >Logout</a>
            </li>
        </ul>
    </div>
</div>