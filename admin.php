
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Pannel</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
</head>

<body>
<div id="Holder">
    <div id="Header"></div>
    <div id="NavBar">
        <nav>
            <ul>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </div>
    <div id="Content">
        <div id="PageHeading">
            <h1>Admin Pannel</h1>
        </div>
        <div id="ContentLeft">
            <p>
                <?php
                if($admin !== 1) {
                    header('location: home.php');
                }
                ?>
                <?php
                if(isset($_GET['type']) && !empty($_GET['type'])){
                ?>
            <table>
                <tr>
                    <td width='150px'>Users></td>
                    <td>Options</td>
                </tr>
                <?php
                $list_query = mysqli_query("SELECT userID, username, type FROM users");
                while ($run_list = mysqli_fetch_array($list_query)){
                    $u_userID = $run_list['userID'];
                    $u_username = $run_list['username'];
                    $u_type = $run_list['type'];
                    ?>
                    <tr>
                        <td><?php echo $u_username ?></td>
                        <td>
                            <?php
                            if ($admin == '0') {
                                echo "<a href='option.php?u_userID=$u_userID&type=$u_type'>Deactivate</a>";
                            } else {
                                echo "<a href='option.php?u_userID=$u_userID&type=$u_type'>Activate<a/>";
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <?php
            } else {
                echo "Select Options Above";
            }
            ?>
            </p>
            <div id="Contentbar">
                <nav>
                    <ul>

                    </ul>
                </nav>
            </div>
        </div>
        <div id="ContentRight">

        </div>
    </div>
</div>
</body>
<footer>
    <p> 2016 secvre </p>
</footer>
</html>