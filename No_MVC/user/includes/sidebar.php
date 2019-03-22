<?php
$menuObj = new UserDashboard();
$links = $menuObj->getMenu();
?>

<aside class="sidebar-dashboard">
    <p>Hallo, <?php echo $_SESSION['forum_user']; ?></p>
    <div class="sidebar-dashboard">
        <?php foreach($links as $menu): ?>
        <div class="btn-dropdown"><?php echo $menu['menu_title']; ?></div><!-- Parent Menu -->
        <div class="dropdown-container">
                <?php $subLinks = $menuObj->getSubMenuByParentId($menu['menu_id']); foreach($subLinks as $submenu): ?>
        <!-- Submenu -->    <a href="<?php echo $submenu['link']; ?>"><?php echo $submenu['submenu_title']; ?></a>
            <?php endforeach; ?>
        </div>
        <?php endforeach; ?>
</aside>