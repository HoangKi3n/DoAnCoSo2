<?php
session_start();
include('../../assets/database/connect.php');
?>

<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $result = "Select * from user_info";
    $sql = mysqli_query($conn, $result);
    while ($info = mysqli_fetch_array($sql)) {
        if ($id == $info['ID']) {
            $username = $info['username'];
            $password = $info['password'];
            $HoTen = $info['HoTen'];
            $Email = $info['Email'];
            $SDT = $info['SDT'];
        }
    }
}
if (isset($_POST['submit'])) {
    $username = $_POST['taikhoan'];
    $password = $_POST['matkhau'];
    $hoten = $_POST['hoten'];
    $email = $_POST['email'];
    $sdt = $_POST['sdt'];
    if ($username != "" && $password != "" && $hoten != "" && $email != "" && $sdt != "") {
        $sql = "UPDATE user_info set username = '" . $username . "', password = '" . $password . "', HoTen = '" . $hoten . "', Email = '" . $email . "', SDT = '" . $sdt . "' where ID = $id";
        $qr = mysqli_query($conn, $sql);
        echo "<script language='javascript'>alert('Sửa thành công !');";
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
    <link rel="stylesheet" href="../../assets/css/styleadmin2.css">
    <link rel="icon" href="../../assets/image/admin.png" />
    <title>Update</title>
</head>

<body>
    <div class="khungtrang">
        <h1 class="title">Update User</h1>
        <a href="../quanlithongtinnguoidung.php" class="dangxuat">Quay lại</a>
        <form action="" method="post">
            <span>Tài Khoản</span>
            <br>
            <input type="text" name="taikhoan" placeholder="UserName" value="<?php echo $username; ?>">
            <br>
            <span>Mật khẩu</span>
            <br>
            <input type="password" name="matkhau" placeholder="Password" value="<?php echo $password; ?>">
            <br>
            <span>Họ Tên</span>
            <br>
            <input type="text" name="hoten" placeholder="Name" value="<?php echo $HoTen; ?>">
            <br>
            <span>Địa chỉ Email</span>
            <br>
            <input type="email" name="email" require placeholder="Email" value="<?php echo $Email; ?>">
            <br>
            <span>Số điện thoại</span>
            <br>
            <input type="text" name="sdt" name="Phone" value="<?php echo $SDT; ?>">
            <br>
            <br>
            <input type="submit" name="submit" value="Update" class="update1">
        </form>
    </div>
</body>

</html>