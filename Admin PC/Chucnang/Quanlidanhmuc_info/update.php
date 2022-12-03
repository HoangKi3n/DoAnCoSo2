<?php
include('../../assets/database/connect.php');
?>

<?php
if (isset($_GET["id"])) {
    $result = "Select * from danhmuc_info where id=" . $_GET['id'];
    $sql = mysqli_query($conn, $result);
    $info = mysqli_fetch_array($sql);
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
    <title>Update danh mục</title>
</head>

<body>
    <div class="khungtrang">
        <h1 class="title">Update Category</h1>
        <a href="../quanlidanhmuc.php" class="dangxuat">Quay lại</a>
        <form action="" method="POST" enctype="multipart/form-data">
            <span>ID</span>
            <br>
            <input type="text" name="id" placeholder="ID" value="<?php echo $info['id']; ?>">
            <br>
            <span>Danh Mục</span>
            <br>
            <input type="text" name="danhmuc" placeholder="DanhMuc" value="<?php echo $info['tendanhmuc']; ?>">
            <br>
            <br>
            <img src="../../assets/image/<?php echo $info['image_name'] ?>" width="60px" height="60px"
                alt="<?php echo $info['image_name']; ?>" />
            <br>
            <span>Select image</span>
            <br>
            <input type="file" name="image" placeholder="Image">
            <br>
            <br>
            <input type="submit" name="submit" value="Update" class="update1">
        </form>

        <?php
        if (isset($_POST['submit'])) {
            if (isset($_FILES["image"]["name"])) {
                $filename = $_FILES["image"]["name"];
            }
            if (isset($_FILES['image']['tmp_name'])) {
                $tempname = $_FILES['image']['tmp_name'];
                if (isset($_GET['id'])) {
                    $sl = "select image_name from danhmuc_info where id=" . $_GET['id'];
                }
                $results = mysqli_query($conn, $sl);
                $d = mysqli_fetch_array($results);
                if ($d['image_name'] != $filename) {
                    move_uploaded_file($tempname, "../../assets/image/" . $filename);
                }
            }
            if (isset($_POST["id"])) {
                $id = $_POST['id'];
            }
            if (isset($_POST["danhmuc"])) {
                $danhmuc = $_POST['danhmuc'];
            }
            if (isset($_GET["id"])) {
                $key = $_GET["id"];
            }
            if (isset($_FILES["image"]["name"])) {
                $filename = $_FILES["image"]["name"];
            }
            if ($filename == "" && $id != "" && $danhmuc != "") {
                $sl = "update danhmuc_info set id='$id', tendanhmuc='$danhmuc' where id='$key'";
                mysqli_query($conn, $sl);
                echo "<script language='javascript'>alert('Sửa thành công !');";
                echo "location.href='../quanlidanhmuc.php';</script>";
            } else if ($id != "" && $danhmuc != "" && $filename != "") {
                $sl = "update danhmuc_info set id='$id', tendanhmuc='$danhmuc',image_name='$filename' where id ='$key'";
                mysqli_query($conn, $sl);
                echo "<script language='javascript'>alert('Sửa thành công !');";
                echo "location.href='../quanlidanhmuc.php';</script>";
            } else {
                echo "<script language='javascript'>alert('Bạn cần nhập đầy đủ thông tin !');";
            }
        }
        ?>

    </div>
</body>

</html>