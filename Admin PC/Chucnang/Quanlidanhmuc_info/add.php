<?php
include('../../assets/database/connect.php');
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $danhmuc = $_POST['danhmuc'];
    if (isset($_POST['submit'])) {
        if (isset($_FILES["image"]["name"])) {
            $filename = $_FILES["image"]["name"];
        }
        if (isset($_FILES['image']['tmp_name'])) {
            $tempname = $_FILES['image']['tmp_name'];
            move_uploaded_file($tempname, "../../assets/image/" . $filename);
        }
        if ($id != "" && $danhmuc != "" && $filename != "") {
            $sql = "INSERT INTO danhmuc_info VALUES('$id', '$danhmuc', '$filename')";
            $qr = mysqli_query($conn, $sql);
            echo "<script language='javascript'>alert('Thêm thành công !');";
            echo "location.href='../quanlidanhmuc.php';</script>";
        } else {
            echo "<script>alert('Bạn vui lòng điền đầy đủ thông tin !')</script>";
        }
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
    <title>Thêm danh mục</title>
</head>

<body>
    <div class="khungtrang">
        <h1 class="title">Add Category</h1>
        <a href="../quanlidanhmuc.php" class="dangxuat">Quay lại</a>
        <form action="" method="post" enctype="multipart/form-data">
            <span>ID</span>
            <br>
            <input type="text" name="id" placeholder="ID">
            <br>
            <span>Danh Mục</span>
            <br>
            <input type="text" name="danhmuc" placeholder="DanhMuc">
            <br>
            <span>Select image</span>
            <br>
            <input type="file" name="image" placeholder="Image">
            <br>
            <br>
            <input type="submit" name="submit" value="Add" class="update1">
        </form>
    </div>
</body>

</html>