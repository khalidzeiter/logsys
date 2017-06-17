<html lang="en">

<?php require_once 'header.php'; ?>

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
        echo '<a class="dashboard" href="dash/"><button id="dashboard">Dashboard</button></a>';
    }
    ?>

</div>
<div class="notifications">
    <p>Notifications</p>
</div>
<div class="login">
    <form method="post" class="lform">
        <div class="form-field">
            <label id="username"><span class="fa fa-user"></span></label>
            <input type="text" name="username" placeholder="Username">
        </div>
        <div class="form-field">
            <label id="password"><span class="fa fa-key"></span></label>
            <input type="password" name="password" placeholder="Password">
        </div>
        <div class="form-field">
            <label class="adminLabel">
                <label class="switch" style="margin:0">
                    <input type="checkbox" value=1 name="privilege">
                    <div class="slider round"></div>
                </label>
                <span>Are you an Admin?!</span>
            </label>
        </div>
        <div class="form-field">
            <input type="submit" value="Login">
        </div>
        <div class="form-field">
            <p>Not a member?
                <span id="signup">
                   Sign up
                </span>
            </p>
        </div>

    </form>

</div>
<div class="signup">
    <form method="post" class="lform">
        <div class="form-field">
            <label id="username"><span class="fa fa-user"></span></label>
            <input type="text" name="name" placeholder="Full Name">
        </div>
        <div class="form-field">
            <label id="username"><span class="fa fa-user"></span></label>
            <input type="text" name="username" placeholder="Username">
        </div>
        <div class="form-field">
            <label id="username"><span class="fa fa-google"></span></label>
            <input type="text" name="email" placeholder="Email">
        </div>
        <div class="form-field">
            <label id="username"><span class="fa fa-info"></span></label>
            <textarea name="bio" placeholder="Your Information"></textarea>
        </div>
        <div class="form-field">
            <label id="password"><span class="fa fa-key"></span></label>
            <input type="password" name="password" placeholder="Password">
        </div>
        <div class="form-field">
            <input type="submit" value="Signup">
        </div>
        <div class="form-field">
            <p>Are you a member?
                <span id="login">
                    Login
                </span>
            </p>
        </div>
    </form>

</div>
<?php require_once 'footer.php'; ?>
</body>

</html>