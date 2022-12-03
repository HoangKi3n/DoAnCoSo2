<?php
include('../assets/database/connect.php');
?>
<?php 
if (!function_exists('currency_format')) {
    function currency_format($number)
    {
        if (!empty($number)) {
            return number_format($number, 0, ',', '.');
        }
    }
}
?>
<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$limit = 5;
$start = ($page - 1) * $limit;
$total_title = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM product_info"));
$total_page = ceil($total_title / $limit);
$query = "SELECT * FROM product_info LIMIT " . $start . ", " . $limit;
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
    <title>Quản lí sản phẩm</title>
</head>

<body>
    <div class="khungtrang">
        <h1 class="title" style="padding-top:0">Quản lí sản phẩm</h1>
        <a href="../trangquantri.php" class="dangxuat" style="margin:-6px 24px 0;">Quay lại</a>
        <table class="quanlisanpham">
            <tr>
                <th>ID</th>
                <th>Tên Sản Phẩm</th>
                <th>Số lượng</th>
                <th>Đã bán</th>
                <th>Giá cũ</th>
                <th>Giá mới</th>
                <th>Nổi bật</th>
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
                $old_price =  currency_format($info['old_price']);
                $new_price =  currency_format($info['new_price']);
                $featured = $info['featured'];
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
                <td><?php echo $featured ?></td>
                <td style=" width:300px;
                            display: -webkit-box;
                            -webkit-box-orient: vertical;
                            -webkit-line-clamp: 2;
                            overflow: hidden;
                            padding: 0 0;
                            margin: 26px;">
                <?php echo $description ?></td>
                <td><img class="hinhanh" src="../assets/image/<?php echo $image_name; ?>"></td>
                <td>
                    <a href="./Quanlisanpham/update.php?id=<?php echo $id; ?>" class="update">Sửa sản phẩm</a>
                    <a href="./Quanlisanpham/delete.php?id=<?php echo $id; ?>" class="delete">Xóa sản phẩm</a>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
        <div class="phantrang">
            <?php
            for ($i = 1; $i <= $total_page; $i++) {
                echo '<a href="quanlisanpham.php?page=' . $i . '">' . $i . '</a>';
            }
            ?>
        </div>
        <div>
            <a href="./Quanlisanpham/add.php" class="add" style="margin: -14px 50px 0 0;">Add Product</a>
        </div>
    </div>
</body>

</html>