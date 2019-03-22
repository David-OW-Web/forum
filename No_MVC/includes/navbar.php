<?php
$navObj = new Navigation();
$cats = $navObj->getCats();
?>


<div class="navbar">
    <div class="dropdown">
        <button class="dropbtn">
            Menu
        </button>
        <div class="dropdown-content">
            <div class="row">
                <div class="column">
                    <h3>Kategorien A-Z</h3>
                    <?php foreach($cats as $cat): ?>
                        <a href="category/<?php echo $cat['cat_id']; ?>"><?php echo $cat['cat_title']; ?></a>
                    <?php endforeach; ?>
                </div>

                <div class="column">
                    <h3>Account</h3>
                    <?php if(isset($_SESSION['forum_user'])): ?>
                        <a href="logout.php">Logout</a>
                        <a href="user/dashboard.php">Account verwalten</a>
                    <?php else: ?>
                        <a href="login.php">Login</a>
                        <a href="register.php">Register</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>