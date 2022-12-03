<?php
include('../assets/database/connect.php');
?>
<?php
$noibat = 'Có';
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$limit = 5;
$start = ($page - 1) * $limit;
$total_title = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM product_info where featured = '" . $noibat . "'"));
$total_page = ceil($total_title / $limit);
$query = "SELECT * FROM product_info where featured = '" . $noibat . "' LIMIT " . $start . ", " . $limit;
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/image/admin.png">
    <link rel="stylesheet" href="../assets/css/styleadmin2.css">
    <title>Quản lí sản phẩm nổi bật</title>
</head>

<body>
    <div class="khungtrang">
        <h1 class="title">Quản lí sản phẩm nổi bật</h1>
        <a href="../trangquantri.php" class="dangxuat">Quay lại</a>
        <table class="quanlisanphamnoibat">
            <tr>
                <th>ID</th>
                <th>Tên Sản Phẩm</th>
                <th>Số lượng</th>
                <th>Đã bán</th>
                <th>Giá cũ</th>
                <th>Giá mới</th>
                <th>Mô tả</th>
                <th>Ảnh</th>
                <th>Quyền Admin</th>
            </tr>
            <?php
            while ($info = mysqli_fetch_array($result)) {
                $query2 = "SELECT * from order_info where ID_product = '" . $info['ID'] . "'";
                $result2 = mysqli_query($conn, $query2);
                $sold = 0;
                while ($info2 = mysqli_fetch_array($result2)) {
                    $sold += $info2['Soluong'];
                }
                $id = $info['ID'];
                $query3 = "UPDATE product_info set sold = '$sold' where ID = '$id'";
                $result3 = mysqli_query($conn, $query3);
                $title = $info['title'];
                $amount = $info['amount'] - $sold;
                $old_price = number_format($info['old_price'], 3);
                $new_price = number_format($info['new_price'], 3);
                $description = $info['description'];
                $image_name = $info['image_name'];
            ?>
            <tr>
                <td><?php echo $id ?></td>
                <td><?php echo $title ?></td>
                <td><?php if ($amount <= 0) {
                            echo "Hết hàng";
                        } else {
                            echo $amount;
                        } ?></td>
                <td><?php echo $sold ?></td>
                <td><?php echo $old_price . ' VNĐ' ?></td>
                <td><?php echo $new_price . ' VNĐ' ?></td>
                <td style=" width:300px"><?php echo $description ?></td>
                <td><img class="hinhanh" src="../assets/image/<?php echo $image_name; ?>"></td>
                <td>
                    <a href="./Quanlisanphamnoibat/update.php?id=<?php echo $id; ?>" class="update">Update admin</a>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
        <div class="phantrang">
            <?php
            for ($i = 1; $i <= $total_page; $i++) {
                echo '<a href="quanlisanphamnoibat.php?page=' . $i . '">' . $i . '</a>';
            }
            ?>
        </div>
    </div>
</body>

</html>