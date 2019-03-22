<nav class="navbar">
    <div class="dropdown">
    <button class="dropbtn">
        Menu
    </button>
    <div class="dropdown-content">
        <div class="row">
            <div class="column">
                <h3>Kategorien A-Z</h3>
                <!-- Loop -->
                <?php foreach($navlinks as $cat): ?>
                    <a href="category?id=<?php echo $cat['cat_id']; ?>"><?php echo $cat['cat_title']; ?></a>
                <?php endforeach; ?>
            </div>

            <div class="column">
                <h3>Account</h3>
                <!-- Session -->
                <?php if(isset($_SESSION['forum_user'])): ?>
                    <a href="logout">Logout</a>
                    <a href="user/dashboard">Account verwalten</a>
                <?php else: ?>
                    <a href="login">Login</a>
                    <a href="register">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    </div>
</nav>