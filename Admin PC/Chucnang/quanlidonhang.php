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
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$limit = 5;
$start = ($page - 1) * $limit;
$total_title = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM order_user"));
$total_page = ceil($total_title / $limit);
$query = "SELECT * FROM order_user LIMIT " . $start . ", " . $limit;
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/styleadmin2.css">
    <link rel="icon" href="../assets/image/admin.png">
    <title>Quản lí đơn hàng</title>
</head>

<body>

    <div class="khungtrang">
        <h1 class="title">Quản lí đơn hàng</h1>
        <a href="../trangquantri.php" class="dangxuat">Quay lại</a>
        <table class="quanlidonhang">
            <tr>
                <th>ID đơn hàng</th>
                <th>ID người dùng</th>
          
                <th>Họ tên</th>
                <th>SDT</th>
                <th>Địa chỉ</th>
                <th>Ghi chú</th>
                <th>Ngày đặt hàng</th>
                <th>Tổng tiền</th>
                <th>Thanh toán</th>
                <th>Quyền Admin</th>
            </tr>
            <?php
            while ($info = mysqli_fetch_array($result)) {
                $id_order = $info['ID_order'];
                $id_user = $info['ID_user'];
              
                $name = $info['Hoten'];
                $sdt = $info['SDT'];
                $address = $info['DiaChi'];
                $note = $info['GhiChu'];
                $date = $info['Ngaydat'];
                $tongtien = currency_format($info['Tongtien']);
                $thanhtoan = $info['Thanhtoan'];
            ?>
            <tr>
                <td><?php echo $id_order ?></td>
                <td><?php echo $id_user ?></td>
              
                <td><?php echo $name ?></td>
                <td><?php echo $sdt ?></td>
                <td><?php echo $address ?></td>
                <td><?php echo $note ?></td>
                <td><?php echo $date ?></td>
                <td><?php echo $tongtien ?></td>
                <td><?php echo $thanhtoan ?></td>
                <td>
                    <a href="./Quanlidonhang/delete.php?id=<?php echo $id_order; ?>" class="delete">Delete admin</a>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
        <div class="phantrang">
            <?php
            for ($i = 1; $i <= $total_page; $i++) {
                echo '<a href="quanlidonhang.php?page=' . $i . '">' . $i . '</a>';
            }
            ?>
        </div>
    </div>
</body>

</html>