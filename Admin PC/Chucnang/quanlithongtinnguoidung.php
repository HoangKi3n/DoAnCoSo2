<?php
include("../assets/database/connect.php");
?>

<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$limit = 5;
$start = ($page - 1) * $limit;
$total_title = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user_info"));
$total_page = ceil($total_title / $limit);
$query = "SELECT * FROM user_info LIMIT " . $start . ", " . $limit;
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../assets/css/styleadmin2.css" />
    <link rel="icon" href="../assets/image/admin.png" />
    <title>Quản lí thông tin người dùng</title>
</head>

<body>
    <div class="khungtrang">
        <h1 class="title">Quản lý thông tin người dùng</h1>
        <a href="../trangquantri.php" class="dangxuat">Quay lại</a>
        <table class="quanlithongtinnguoidung">
            <tr>
                <th>ID</th>
                <th>Tài khoản</th>
                <th>Mật khẩu</th>
                <th>Họ tên</th>
                <th>Địa chỉ Email</th>
                <th>Số điện thoại</th>
                <th>Quyền Admin</th>
            </tr>
            <?php
            while ($info = mysqli_fetch_array($result)) {
                $id = $info['ID'];
                $username = $info['username'];
                $password = $info['password'];
                $HoTen = $info['HoTen'];
                $Email = $info['Email'];
                $SDT = $info['SDT'];
            ?>
            <tr>
                <td><?php echo $id; ?></td>
                <td><?php echo $username; ?></td>
                <td><?php echo $password; ?></td>
                <td><?php echo $HoTen; ?></td>
                <td><?php echo $Email; ?></td>
                <td><?php echo $SDT; ?></td>
                <td>
                    <a href='./Quanliuser_info/update.php?id=<?php echo $id; ?>' class="update">Update Admin</a>
                    <a href='./Quanliuser_info/delete.php?id=<?php echo $id; ?>' class="delete">Delete
                        Amin</a>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
        <div class="phantrang">
            <?php
            for ($i = 1; $i <= $total_page; $i++) {
                echo '<a href="quanlithongtinnguoidung.php?page=' . $i . '">' . $i . '</a>';
            }
            ?>
        </div>
        <div>
            <a href="./Quanliuser_info/add.php" class="add">Add User</a>
        </div>
    </div>
</body>

</html>