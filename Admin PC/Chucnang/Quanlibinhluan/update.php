<?php
include('../../assets/database/connect.php');
?>

<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $result = "Select * from comment_user";
    $sql = mysqli_query($conn, $result);
    while ($info = mysqli_fetch_array($sql)) {
        if ($id == $info['ID']) {
            $rep_comment = $info['Rep_comment'];
            $status = $info['status'];
        }
    }
}
if (isset($_POST['submit'])) {
    $rep_comment = $_POST['rep_comment'];
    $status = $_POST['status'];
    if ($rep_comment != "" && $status == 'Đã trả lời') {
        $sql = "UPDATE comment_user set Rep_comment = '" . $rep_comment . "', status = '" . $status . "' where ID = $id";
        $qr = mysqli_query($conn, $sql);
        echo "<script language='javascript'>alert('Sửa thành công !');";
        echo "location.href='../quanlibinhluan.php';</script>";
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
        <h1 class="title">Rep Comment</h1>
        <a href="../quanlibinhluan.php" class="dangxuat">Quay lại</a>
        <form action="" method="post">
            <span>Trạng thái bình luận</span>
            <br>
            <select name="status" aria-labelledby="state">
                <?php
                if ($status == 'Đã trả lời') {
                    echo '<option value="' . $status . '">' . $status . '</option>';
                    echo '<option value="' . 'Chưa trả lời' . '">' . 'Chưa trả lời' . '</option>';
                } else if ($status == 'Chưa trả lời') {
                    echo '<option value="' . $status . '">' . $status . '</option>';
                    echo '<option value="' . 'Đã trả lời' . '">' . 'Đã trả lời' . '</option>';
                } else {
                    echo '<option value="' . 'Chưa trả lời' . '">' . 'Chưa trả lời' . '</option>';
                    echo '<option value="' . 'Đã trả lời' . '">' . 'Đã trả lời' . '</option>';
                }
                ?>
            </select>
            <br>
            <span>Trả lời bình luận người dùng</span>
            <br>
            <textarea name="rep_comment" cols="80" rows="20"
                placeholder="Trả lời bình luận"><?php echo $rep_comment; ?></textarea>
            <br>
            <br>
            <input type="submit" name="submit" value="Update" class="update1">
        </form>
    </div>
</body>

</html>