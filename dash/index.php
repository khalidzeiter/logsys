<?php
require_once '../inc/config.php';
require_once '../inc/dbController.php';

// Get All Users Data
$users = new Users('', '', '', '', '');
$getAll = $users->getAll();
?>

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
        echo '<button><a href="profile.php">Profile</a></button>';
        echo '<button id="logout">Logout</button>';
    }
    ?>
</div>
<div class="notifications">
    <p>Notifications</p>
</div>

<?php
if ($_SESSION['privileges'] == 1) {
    ?>
    <div class="userList">
        <table>
            <tr>
                <th>UserID</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Bio</th>
                <th>Control</th>
            </tr>

            <?php
            for ($i = 0; $i < count($getAll); $i++) {
                ?>
                <tr>
                    <td><?= $i + 1; ?></td>
                    <td><?= $getAll[$i]->name; ?></td>
                    <td><?= $getAll[$i]->username; ?></td>
                    <td><?= $getAll[$i]->email; ?></td>
                    <td><?= $getAll[$i]->bio; ?></td>
                    <td class="control">
                    <span value="<?= $getAll[$i]->id; ?>"
                          class="fa fa-ban banUser"
                          ban=<?= $getAll[$i]->ban; ?>
                        <?php
                        if ($getAll[$i]->ban == 1) {
                            echo " style=\"color: #f00\" ";
                        } else {
                            echo " style=\"color: #393\" ";
                        }
                        ?>></span>
                        <span value="<?= $getAll[$i]->id; ?>" class="fa fa-remove deleteUser"
                              style="color: #f00"></span>
                    </td>
                </tr>

                <?php
            }
            ?>
        </table>
    </div>
    <?php
}
?>
<?php require_once '../footer.php'; ?>
</body>

</html>
