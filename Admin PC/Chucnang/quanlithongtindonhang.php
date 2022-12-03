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
$total_title = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM order_info "));
$total_page = ceil($total_title / $limit);
$query = "SELECT * FROM order_info LIMIT " . $start . ", " . $limit;
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
    <title>Quản lí thông tin đơn hàng</title>
</head>

<body>

    <div class="khungtrang">
        <h1 class="title">Quản lí thông tin đơn hàng</h1>
        <a href="../trangquantri.php" class="dangxuat">Quay lại</a>
        <table class="quanlithongtindonhang">
            <tr>
                <th>ID đơn hàng</th>
                <th>ID sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Quyền Admin</th>
            </tr>
            <?php
            while ($info = mysqli_fetch_array($result)) {
                $id_order = $info['ID_order'];
                $id_product = $info['ID_product'];
                $soluong = $info['Soluong'];
                $gia = currency_format($info['Gia']);
            ?>
            <tr>
                <td><?php echo $id_order ?></td>
                <td><?php echo $id_product ?></td>
                <td><?php echo $soluong ?></td>
                <td><?php echo $gia ?></td>
                <td>
                    <a href="./Quanlithongtindonhang/delete.php?id=<?php echo $id_order; ?>" class="delete">Delete
                        admin</a>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
        <div class="phantrang">
            <?php
            for ($i = 1; $i <= $total_page; $i++) {
                echo '<a href="quanlithongtindonhang.php?page=' . $i . '">' . $i . '</a>';
            }
            ?>
        </div>
    </div>
</body>

</html>