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
$total_title = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM danhmuc_info"));
$total_page = ceil($total_title / $limit);
$query = "SELECT * FROM danhmuc_info LIMIT " . $start . ", " . $limit;
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
    <title>Quản lí danh mục</title>
</head>

<body>
    <div class="khungtrang">
        <h1 class="title" style="padding-top:0">Quản lí danh mục</h1>
        <a href="../trangquantri.php" class="dangxuat" style="margin:-6px 24px 0;">Quay lại</a>
        <table class="quanlidanhmuc">
            <tr>
                <th>ID</th>
                <th>Tên Danh Mục</th>
                <th>Ảnh Danh Mục</th>
                <th>Quyền Admin</th>
            </tr>
            <?php
            while ($info = mysqli_fetch_array($result)) {
                $id = $info['id'];
                $tendanhmuc = $info['tendanhmuc'];
                $image = $info['image_name'];
            ?>
            <tr>
                <td><?php echo $id ?></td>
                <td><?php echo $tendanhmuc ?></td>
                <td><img class="hinhanh" src="../assets/image/<?php echo $image; ?>"></td>
                <td>
                    <a href="./Quanlidanhmuc_info/update.php?id=<?php echo $id; ?>" class="update">Sửa Danh Mục</a>
                    <a href="./Quanlidanhmuc_info/delete.php?id=<?php echo $id; ?>" class="delete">Xóa Danh Mục</a>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
        <div class="phantrang">
            <?php
            for ($i = 1; $i <= $total_page; $i++) {
                echo '<a href="quanlidanhmuc.php?page=' . $i . '">' . $i . '</a>';
            }
            ?>
        </div>
        <div>
            <a href="./Quanlidanhmuc_info/add.php" class="add"  style="margin: -14px 50px 0 0;">Add Category</a>
        </div>
    </div>
</body>

</html>