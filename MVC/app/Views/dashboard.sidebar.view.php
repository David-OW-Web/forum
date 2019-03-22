<aside class="sidebar-dashboard">
    <p>Hallo, <?php echo $_SESSION['forum_user']; ?></p>
    <div class="btn-dropdown"><a href="dashboard">Start / Home</a></div>
    <div class="btn-dropdown">Profil</div>
        <div class="dropdown-container">
            <a href="account_details">Details</a>
            <a href="change_details">Details aktualisieren</a>
            <a href="login_activity">Loginaktivität</a>
        </div>
    
    <div class="btn-dropdown">Fragen</div>
        <div class="dropdown-container">
            <a href="my_questions">Meine Fragen</a>
            <a href="create_question">Frage stellen</a>
            <a href="add_category">Kategorie erstellen</a>
        </div>
</aside>

<script src="../side_dropdown.js"></script>