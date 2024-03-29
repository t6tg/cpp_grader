<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
require_once "../../Database/Database.php";
if ($_SESSION['username'] == "") {
    echo "<script>alert('Please Login !!')</script>";
    header("Refresh:0 , url=../../logout.php");
    exit();
}
if ($_SESSION['status'] != "admin") {
    echo "<script>alert('This page for admin only!')</script>";
    header("Refresh:0 , url=../../logout.php");
    exit();
}
$sql = "select * from server where id=1";
$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_array($query);
$i = $_GET['class'];
if ($GET['submit_class']) {
    $i = $_GET['class'];
}
$sql_score = "select * from student where class='" . $i . "' order by quiz_t1_n1+quiz_t1_n2+quiz_t1_n3 DESC";
$query_score = mysqli_query($conn, $sql_score);
?>
<!doctype html>
<html lang="en">

    <head>
        <title>Admin</title>
        <meta charset="utf-8">
        <link rel="icon" href="../../img/cnrlogo.png">
        <link rel="stylesheet" href="./admin.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>

    <body>
        <ul>
            <li><a href="../">Admin</a></li>
            <li><a href="server.php">SERVER</a></li>
            <li><a href="aprov.php">APROV</a></li>
            <li><a href="manual.php">MANUAL</a></li>
            <li><a href="file.php">FILE</a></li>
            <li><a class="active" href="#">QUIZ</a></li>
            <li><a href="score.php">Score</a></li>
            <li><a href="special.php">S.Score</a></li>
            <li><a href="user.php">USER</a></li>
            <li><a href="create.php">Create Problem</a></li>
            <li style="float:right"><a href="../../logout.php">Logout</a></li>
        </ul>
    </body>
    <center>
        <div class="container">
            Quiz : <?php echo $_GET['quiz']; ?>
            Class : <?php echo $i; ?>
            <form action="" method="get">
                <label for="">Section : </label>
                <select style="width:100px;" name="class">
                    <?php for ($j = 1; $j <= 10; $j++) {?>
                    <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                    <?php }?>
                </select>
                <select style="width:100px;" name="quiz">
                    <option value="1">Quiz 1</option>
                    <option value="2">Quiz 2</option>
                    <option value="3">Quiz 3</option>
                </select>
                <input type="submit" name="submit_class" value="submit">
                <br>
            </form>
            <br>
            <table>
                <tr>
                    <th>SID</th>
                    <th>Name</th>
                    <th>Quiz_N1</th>
                    <th>Quiz_N2</th>
                    <th>Quiz_N3</th>
                    <th>Sum</th>
                </tr>
                <!-- quiz1 -->
                <?php if ($_GET['quiz'] == '1') {?>
                <?php while ($row_score = mysqli_fetch_array($query_score)) {?>
                <tr>
                    <td><?php echo $row_score['username']; ?></td>
                    <td><?php echo $row_score['name']; ?></td>
                    <td style="text-align:center;">
                        <?php if ($row_score['quiz_t1_n1'] == "") {echo '0';} else {echo '<a href="code.php?week=quiz_t1_n1&id=' . $row_score['username'] . '">' . $row_score['quiz_t1_n1'] . '</a>';}?>
                    </td>
                    <td style="text-align:center;">
                        <?php if ($row_score['quiz_t1_n2'] == "") {echo '0';} else {echo '<a href="code.php?week=quiz_t1_n2&id=' . $row_score['username'] . '">' . $row_score['quiz_t1_n2'] . '</a>';}?>
                    </td>
                    <td style="text-align:center;">
                        <?php if ($row_score['quiz_t1_n3'] == "") {echo '0';} else {echo '<a href="code.php?week=quiz_t1_n3&id=' . $row_score['username'] . '">' . $row_score['quiz_t1_n3'] . '</a>';}?>
                    </td>
                    <td style="text-align:center;">
                        <?php echo $row_score['quiz_t1_n1'] + $row_score['quiz_t1_n2'] + $row_score['quiz_t2_n3']; ?>
                    </td>
                </tr>
                <?php }?>
                <?php }?>
                <!-- quiz2 -->
                <?php if ($_GET['quiz'] == '2') {?>
                <?php while ($row_score = mysqli_fetch_array($query_score)) {?>
                <tr>
                    <td><?php echo $row_score['username']; ?></td>
                    <td><?php echo $row_score['name']; ?></td>
                    <td style="text-align:center;">
                        <?php if ($row_score['quiz_t2_n1'] == "") {echo '0';} else {echo '<a href="code.php?week=quiz_t2_n1&id=' . $row_score['username'] . '">' . $row_score['quiz_t2_n1'] . '</a>';}?>
                    </td>
                    <td style="text-align:center;">
                        <?php if ($row_score['quiz_t2_n2'] == "") {echo '0';} else {echo '<a href="code.php?week=quiz_t2_n2&id=' . $row_score['username'] . '">' . $row_score['quiz_t2_n2'] . '</a>';}?>
                    </td>
                    <td style="text-align:center;">
                        <?php if ($row_score['quiz_t2_n3'] == "") {echo '0';} else {echo '<a href="code.php?week=quiz_t2_n3&id=' . $row_score['username'] . '">' . $row_score['quiz_t2_n3'] . '</a>';}?>
                    </td>
                    <td style="text-align:center;">
                        <?php echo $row_score['quiz_t2_n1'] + $row_score['quiz_t2_n2'] + $row_score['quiz_t2_n3']; ?>
                    </td>
                </tr>
                <?php }?>
                <?php }?>
                <!-- quiz3 -->
                <?php if ($_GET['quiz'] == '3') {?>
                <?php while ($row_score = mysqli_fetch_array($query_score)) {?>
                <tr>
                    <td><?php echo $row_score['username']; ?></td>
                    <td><?php echo $row_score['name']; ?></td>
                    <td style="text-align:center;">
                        <?php if ($row_score['quiz_t3_n1'] == "") {echo '0';} else {echo '<a href="code.php?week=quiz_t3_n1&id=' . $row_score['username'] . '">' . $row_score['quiz_t3_n1'] . '</a>';}?>
                    </td>
                    <td style="text-align:center;">
                        <?php if ($row_score['quiz_t3_n2'] == "") {echo '0';} else {echo '<a href="code.php?week=quiz_t3_n2&id=' . $row_score['username'] . '">' . $row_score['quiz_t3_n2'] . '</a>';}?>
                    </td>
                    <td style="text-align:center;">
                        <?php if ($row_score['quiz_t3_n3'] == "") {echo '0';} else {echo '<a href="code.php?week=quiz_t3_n3&id=' . $row_score['username'] . '">' . $row_score['quiz_t3_n3'] . '</a>';}?>
                    </td>
                    <td style="text-align:center;">
                        <?php echo $row_score['quiz_t3_n1'] + $row_score['quiz_t3_n2'] + $row_score['quiz_t3_n3']; ?>
                    </td>
                </tr>
                <?php }?>
                <?php }?>
                <!-- --- -->
            </table>
        </div>
    </center>
    <?php header("Refresh:10");?>

</html>
<?php mysqli_close($conn);?>
