<?php require_once '../inc/config.php'; ?>
<html lang="en">

<?php require_once '../header.php'; ?>

<body>
<div class="header">
    <p>Welcome,
        <span class="username">
                 <?php if (isset($_SESSION['name'])) {
                     echo $_SESSION['name'];
                 } else {
                     echo "Guest";
                 }
                 ?>
                </span>
    </p>
    <?php
    if (isset($_SESSION['name'])) {
        if (isset($_GET['edit'])) {
            echo '<button><a href="profile.php">Profile</a></button>';
        } else {
            echo '<button><a href="index.php">Dashboard</a></button>';
        }
        echo '<button id="logout">Logout</button>';
    }
    ?>
</div>
<div class="notifications">
    <p>Notifications</p>
</div>
<?php
if (isset($_GET['edit'])) {
    ?>
    <div class="editProfile">
        <form method="post" class="lform">
            <div class="form-field">
                <label id="username"><span class="fa fa-user"></span></label>
                <input type="text" name="name" placeholder="<?= $_SESSION['name']; ?>">
            </div>
            <div class="form-field">
                <label id="username"><span class="fa fa-user"></span></label>
                <input type="text" name="username" placeholder="<?= $_SESSION['username']; ?>">
            </div>
            <div class="form-field">
                <label id="username"><span class="fa fa-google"></span></label>
                <input type="text" name="email" placeholder="<?= $_SESSION['email']; ?>">
            </div>
            <div class="form-field">
                <label id="username"><span class="fa fa-info"></span></label>
                <textarea name="bio" placeholder="<?= $_SESSION['bio']; ?>"></textarea>
            </div>
            <div class="form-field">
                <label id="password"><span class="fa fa-key"></span></label>
                <input type="password" name="password" placeholder="Password">
            </div>
            <div class="form-field">
                <input type="submit" value="Edit">
            </div>
        </form>

    </div>
    <?php
} else {
    ?>
    <div class="userInfo">
        <p class="infoField">Full Name: <span class="data">
                    <?= $_SESSION['name']; ?>
                </span>
        </p>
        <p class="infoField">Username: <span class="data">
                    <?= $_SESSION['username']; ?>
                </span>
        </p>
        <p class="infoField">Email: <span class="data">
                    <?= $_SESSION['email']; ?>
                </span>
        </p>
        <p class="infoField">Bio: <span class="data">
                    <?= $_SESSION['bio']; ?>
                </span>
        </p>
        <button><a href="profile.php?edit">Edit Profile</a></button>
    </div>
    <?php
}
?>
<?php require_once '../footer.php'; ?>
</body>

</html>