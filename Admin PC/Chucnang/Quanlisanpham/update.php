<?php
include('../../assets/database/connect.php');
?>

<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $result = "Select * from product_info where ID=" . $_GET['id'];
    $sql = mysqli_query($conn, $result);
    $info = mysqli_fetch_assoc($sql);
    $img_pro = mysqli_query($conn, "SELECT * FROM image_desc WHERE id_product =$id");
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
    <title>Update sản phẩm</title>
</head>

<body>
    <div class="khungtrang">
        <h1 class="title">Update Product</h1>
        <a href="../quanlisanpham.php" class="dangxuat">Quay lại</a>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="formdonhang">
                <div>
                    <span>ID</span>
                    <br>
                    <input type="text" name="id" placeholder="ID" value="<?php echo $info['ID'] ?>">
                    <br>
                    <span>Title</span>
                    <br>
                    <input type="text" name="title" placeholder="Title" value="<?php echo $info['title']; ?>">
                    <br>
                    <span>Quantity</span>
                    <br>
                    <input type="text" name="amount" placeholder="Số lượng" value="<?php $sum = $info['amount'] - $info['sold'];echo $sum ?>">
                    <br>
                    <input type="hidden" name="sold" placeholder="Đã bán" value="<?php echo $info['sold'] ?>">
                    <br>
                    <span>Old Price</span>
                    <br>
                    <input type="text" name="old_price" placeholder="Old price"
                        value="<?php echo $info['old_price']; ?>">
                    <br>
                    <span>New Price</span>
                    <br>
                    <input type="text" name="new_price" placeholder="New price"
                        value="<?php echo $info['new_price']; ?>">
                </div>
                <div>
                    <span>Featured</span>
                    <br>
                    <select name="featured" aria-labelledby="state"
                        style="width:100px; text-align:center; height: 25px">
                        <?php
                        if ($featured == 'Không') {
                            echo '<option value="' . $featured . '">' . $featured . '</option>';
                            echo '<option value="' . 'Có' . '">' . 'Có' . '</option>';
                        } else if ($featured == 'Có') {
                            echo '<option value="' . $featured . '">' . $featured . '</option>';
                            echo '<option value="' . 'Không' . '">' . 'Không' . '</option>';
                        } else {
                            echo '<option value="' . 'Không' . '">' . 'Không' . '</option>';
                            echo '<option value="' . 'Có' . '">' . 'Có' . '</option>';
                        }
                        ?>
                    </select>
                    <br>
                    <br>
                    <img src="../../assets/image/<?php echo $info['image_name'] ?>" width="60px" height="60px"
                        alt="<?php echo $info['title']; ?>" />
                    <br>
                    <span>Select image</span>
                    <br>
                    <input type="file" name="image" placeholder="Image">
                    <br>
                    <span>Image description</span>
                    <br>
                    <input multiple="multiple" type="file" name="images[]" placeholder="Image Description">
                    <br>
                    <?php foreach ($img_pro as $key => $value) { ?>
                    <img src="../../assets/image/<?php echo $value['image'] ?>" alt="Image description"
                        style="max-height:100px">
                    <?php } ?>
                </div>
                <div>
                    <span>Description</span>
                    <br>
                    <textarea name="description" id="product-content" cols="60"
                        rows="8"><?php echo $info['description']; ?></textarea>
                    <br>
                    <span>Category</span>
                    <br>
                    <select name="categoryid" aria-labelledby="state">
                        <?php
                        $sql = "SELECT * FROM danhmuc_info";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($result)) {
                            echo '<option value="' . $row['id'] . '">' . $row['tendanhmuc'] . '</option>';
                        }
                        ?>
                    </select>
                    <br>
                    <br>
                    <input type="submit" name="submit" value="Update" class="update1">
                </div>
            </div>
        </form>

        <?php
        if (isset($_FILES["image"]["name"])) {
            $filename = $_FILES["image"]["name"];
        }
        if (isset($_FILES['image']['tmp_name'])) {
            $tempname = $_FILES['image']['tmp_name'];
            if (isset($_GET['id'])) {
                $sl = "select image_name from product_info where ID=" . $_GET['id'];
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
        if (isset($_POST["title"])) {
            $title = $_POST['title'];
        }
        if (isset($_POST["amount"])) {
            $amount = $_POST['amount'];
        }
        if (isset($_POST["sold"])) {
            $sold = $_POST['sold'];
        }
        if (isset($_POST["old_price"])) {
            $old_price = $_POST['old_price'];
        }
        if (isset($_POST["new_price"])) {
            $new_price = $_POST['new_price'];
        }
        if (isset($_POST["featured"])) {
            $featured = $_POST['featured'];
        }
        if (isset($_POST["description"])) {
            $description = $_POST['description'];
        }
        if (isset($_POST["categoryid"])) {
            $categoryid = $_POST['categoryid'];
        }
        if (isset($_POST['submit'])) {
            $amount = $amount + $sold;
            if (isset($_GET["id"])) {
                $key = $_GET["id"];
            }
            if (isset($_FILES["image"]["name"])) {
                $filename = $_FILES["image"]["name"];
                if ($filename == "" && $id != "" && $title != "" && $amount != "" && $old_price != "" && $new_price != "" && $featured != "" && $categoryid != "" && $description != "") {
                    $sl = "update product_info set ID = '$id', title='$title', amount='$amount', old_price='$old_price',new_price='$new_price', featured='$featured', category_id = '$categoryid', description = '$description' where id='$key'";
                    mysqli_query($conn, $sl);
                    echo "<script language='javascript'>alert('Sửa thành công !');";
                    echo "location.href='../quanlisanpham.php';</script>";
                } else if ($filename != "" && $id != "" && $title != "" && $old_price != "" && $new_price != "" && $featured != "" && $categoryid != "" && $description != "") {
                    $sl = "update product_info set ID = '$id', title='$title', amount='$amount', old_price='$old_price',new_price='$new_price', featured='$featured', image_name='$filename' , category_id = '$categoryid', description = '$description' where id ='$key'";
                    mysqli_query($conn, $sl);
                    echo "<script language='javascript'>alert('Sửa thành công !');";
                    echo "location.href='../quanlisanpham.php';</script>";
                } else {
                    echo "<script language='javascript'>alert('Bạn cần nhập đủ thông tin !');";
                }
            }
            if (isset($_FILES["images"])) {
                $file_names = $_FILES["images"]['name'];
                if (!empty($file_names[0])) {
                    mysqli_query($conn, "DELETE FROM image_desc WHERE id_product= $id");
                    foreach ($file_names as $key => $value) {
                        move_uploaded_file($files['tmp_name'][$key], '../../assets/image/' . $value);
                    }
                    foreach ($file_names as $key => $value) {
                        mysqli_query($conn, "INSERT INTO image_desc(id_product, image) VALUES('$id', '$value')");
                    }
                }
            }
        }
        ?>
    </div>
</body>

</html>