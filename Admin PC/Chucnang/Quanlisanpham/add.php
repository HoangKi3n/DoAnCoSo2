<?php
include('../../assets/database/connect.php');
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST["title"];
    $amount = $_POST['amount'];
    $old_price = $_POST["old_price"];
    $new_price = $_POST["new_price"];
    $featured = $_POST['featured'];
    $description = $_POST["description"];
    $iddanhmuc = $_POST["categoryid"];
    if (isset($_POST['submit'])) {
        if (isset($_FILES["image"]["name"])) {
            $filename = $_FILES["image"]["name"];
        }
        if (isset($_FILES['image']['tmp_name'])) {
            $tempname = $_FILES['image']['tmp_name'];
            move_uploaded_file($tempname, "../../assets/image/" . $filename);
        }
        if (isset($_FILES['images'])) {
            $files = $_FILES['images'];
            $file_names = $files['name'];
            foreach ($file_names as $key => $value) {
                move_uploaded_file($files['tmp_name'][$key], '../../assets/image/' . $value);
            }
        }
        if ($id != "" && $title != "" && $amount != "" && $old_price != "" && $new_price != "" && $featured != "" && $description != "" && $iddanhmuc != "" && $filename != "") {
            $sql = "INSERT INTO product_info (ID, title, amount, old_price, new_price, featured, description, image_name, category_id) VALUES('$id', '$title', '$amount', '$old_price', '$new_price', '$featured', '$description', '$filename', '$iddanhmuc')";
            $kq = mysqli_query($conn, $sql);
            echo "<script language='javascript'>alert('Thêm thành công !');";
            echo "location.href='../quanlisanpham.php';</script>";
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
    <link rel="icon" href="../../assets/image/admin.png">
    <title>Add sản phẩm</title>
</head>

<body>
    <div class="khungtrang">
        <h1 class="title">Add Product</h1>
        <a href="../quanlisanpham.php" class="dangxuat">Quay lại</a>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="formdonhang">
                <div>
                    <span>ID</span>
                    <br>
                    <input type="text" name="id" placeholder="ID">
                    <br>
                    <span>Title</span>
                    <br>
                    <input type="text" name="title" placeholder="Title">
                    <br>
                    <span>Quantity</span>
                    <br>
                    <input type="text" name="amount" placeholder="Số lượng">
                    <br>
                    <span>Old Price</span>
                    <br>
                    <input type="text" name="old_price" placeholder="Old price">
                    <br>
                    <span>New Price</span>
                    <br>
                    <input type="text" name="new_price" placeholder="New price">
                    <br>
                    <span>Featured</span>
                    <br>
                    <select name="featured" aria-labelledby="state">
                        <option value="<?php echo "Không" ?>">Không</option>
                        <option value="<?php echo "Có" ?>">Có</option>
                    </select>
                </div>
                <div>
                    <span>Select image</span>
                    <br>
                    <input type="file" name="image" placeholder="Image">
                    <br>
                    <span>Image description</span>
                    <br>
                    <input multiple="" type="file" name="images[]" placeholder="Image">
                    <br>
                    <span>Category</span>
                    <br>
                    <select name="categoryid" aria-labelledby="state">
                        <?php
                        $sql = "SELECT * FROM danhmuc_info";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($result))
                            echo '<option value="' . $row['id'] . '">' . $row['tendanhmuc'] . '</option>';
                        ?>
                    </select>
                    <br>
                    <span>Content</span>
                    <br>
                    <textarea name="description" id="product-content" cols="60" rows="8"></textarea>
                    <br>
                    <br>
                    <input type="submit" name="submit" value="Add product" class="update1">
                </div>
            </div>
        </form>
    </div>
</body>

</html>