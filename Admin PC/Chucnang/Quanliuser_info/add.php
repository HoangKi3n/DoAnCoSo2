<?php
include('../../assets/database/connect.php');
?>

<?php
if (isset($_GET['submit'])) {
    $taikhoan = $_GET['taikhoan'];
    $matkhau = $_GET['matkhau'];
    $hoten = $_GET['hoten'];
    $email = $_GET['email'];
    $sdt = $_GET['sdt'];
    if ($taikhoan != "" && $matkhau != "" && $hoten != "" && $email != "" && $sdt != "") {
        $sql = "INSERT INTO user_info VALUES('$taikhoan', '$matkhau', '$hoten', '$email', '$sdt')";
        $qr = mysqli_query($conn, $sql);
        echo "<script language='javascript'>alert('Thêm thành công !');";
        echo "location.href='../quanlithongtinnguoidung.php';</script>";
    } else {
        echo "<script>alert('Bạn vui lòng điền đầy đủ thông tin !')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets//css/styleadmin2.css">
    <link rel="icon" href="../../assets/image/admin.png">
    <title>Add User</title>
</head>

<body>
    <div class="khungtrang">
        <h1 class="title">Add User</h1>
        <a href="../quanlithongtinnguoidung.php" class="dangxuat">Quay lại</a>
        <form action="" method="get">
            <span>Tài khoản</span>
            <br>
            <input type="text" name="taikhoan" placeholder="Tài khoản">
            <br>
            <span>Mật khẩu</span>
            <br>
            <input type="password" name="matkhau" placeholder="Mật khẩu">
            <br>
            <span>Họ tên</span>
            <br>
            <input type="text" name="hoten" placeholder="Họ tên">
            <br>
            <span>Địa chỉ Email</span>
            <br>
            <input type="email" name="email" require placeholder="Email">
            <br>
            <span>Số điện thoại</span>
            <br>
            <input type="text" name="sdt" placeholder="Phone">
            <br>
            <br>
            <input type="submit" name="submit" value="Add" class="update1">
        </form>
    </div>
</body>

</html>