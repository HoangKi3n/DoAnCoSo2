<?php
include('../assets/database/connect.php');
?>

<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$limit = 5;
$start = ($page - 1) * $limit;
$total_title = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM comment_user"));
$total_page = ceil($total_title / $limit);
$query = "SELECT * FROM comment_user LIMIT " . $start . ", " . $limit;
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/styleadmin2.css">
    <link rel="icon" href="../assets/image/admin.png" />
    <title>Quản lí bình luận</title>
</head>

<body>
    <div class="khungtrang">
        <h1 class="title">Quản lí bình luận</h1>
        <a href="../trangquantri.php" class="dangxuat">Quay lại</a>
        <table class="quanlibinhluan">
            <tr>
                <th>ID</th>
                <th>ID User</th>
                <th>ID Product</th>
                <th>Comment</th>
                <th>Trạng thái</th>
                <th>Quyền Admin</th>
            </tr>
            <?php
            while ($info = mysqli_fetch_array($result)) {
                $id = $info['ID'];
                $id_user = $info['ID_user'];
                $id_product = $info['ID_product'];
                $comment = $info['Comment'];
                $status = $info['status'];
            ?>
            <tr>
                <td><?php echo $id ?></td>
                <td><?php echo $id_user ?></td>
                <td><?php echo $id_product ?></td>
                <td><?php echo $comment ?></td>
                <td><?php echo $status ?></td>
                <td>
                    <a href="./Quanlibinhluan/update.php?id=<?php echo $id; ?>" class="update">Sửa bình luận</a>
                    <a href="./Quanlibinhluan/delete.php?id=<?php echo $id; ?>" class="delete">Xóa bình luận</a>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
        <div class="phantrang">
            <?php
            for ($i = 1; $i <= $total_page; $i++) {
                echo '<a href="quanlibinhluan.php?page=' . $i . '">' . $i . '</a>';
            }
            ?>
        </div>
    </div>
</body>

</html>