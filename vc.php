<!DOCTYPE html>
<html>

<head>
    <title>Quản lý sản phẩm</title>
    <link rel="stylesheet" href="layout.css">
    <script>
        // JavaScript để hiển thị thông báo
        function showAlert() {
            var alertBox = document.getElementById("alert");
            alertBox.style.display = "block";
        }

        // JavaScript để ẩn thông báo
        function hideAlert() {
            var alertBox = document.getElementById("alert");
            alertBox.style.display = "none";
        }
    </script>
</head>

<body>

    <section class="container">
        <section class="phandau">

            <img src="img/logo.png" alt="" class="logo">
            <section class="khuvuc">
            <a href="#" >Khu vực</a>
            </section>
            <input type="text" placeholder="Bạn đang tìm gì?" class="search">
            <img src="img/search.png" alt="" class="anh1">
            <section class="thongtin">
            <a href="#" >Thông tin<br> khách hàng</a>
            </section>
            <section class="ngonngu">
            <a href="#" >Ngôn ngữ<br> Vi/VN</a>
            
            </section>
            <a href="#"><img src="img/giohang.png" alt="" class="giohang"></a>
            
        </section>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Danh sách</a></li>
                <li><a href="#">Dịch vụ</a></li>
                <li><a href="#">Đồ điện tử</a></li>
                <li><a href="#">Thời trang</a></li>
                <li><a href="#">Thể thao</a></li>
                <li><a href="#">Sức khoẻ và làm đẹp</a></li>
                <li><a href="#">Đồ chơi</a></li>
                <li><a href="#">Sách</a></li>
                <li><a href="#">Voucher</a></li>
                <li><a href="#">Bán</a></li>
            </ul>
        </nav>
    </section>
    <section class="php">
    <?php
    // Mảng chứa thông tin sản phẩm
    $products = array(
        1 => array(
            'stt' => '1',
            'name' => 'Sản phẩm 1',
            'price' => '999$',
            'image' => 'anh1.jpg',
        ),
        2 => array(
            'stt' => '2',
            'name' => 'Sản phẩm 2',
            'price' => '99$',
            'image' => 'anh2.jpg',
        ),
        3 => array(
            'stt' => '3',
            'name' => 'Sản phẩm 3',
            'price' => '99$',
            'image' => 'anh1.jpg',
        ),
    );

    // Xử lý Thêm sản phẩm
    if (isset($_POST['addProduct'])) {
        $newProductId = count($products) + 1; // Tạo ID mới cho sản phẩm
        $newProduct = array(
            'stt' => $newProductId,
            'name' => $_POST['productName'],
            'price' => $_POST['productPrice'],
            'image' => $_POST['productImage'],
        );
        $products[$newProductId] = $newProduct;
    }

    // Xử lý Sửa thông tin sản phẩm
    if (isset($_POST['updateProduct'])) {
        $productIdToEdit = $_POST['productID'];
        if (isset($products[$productIdToEdit])) {
            $products[$productIdToEdit]['stt'] = $_POST['productStt'];
            $products[$productIdToEdit]['name'] = $_POST['productName'];
            $products[$productIdToEdit]['price'] = $_POST['productPrice'];
            $products[$productIdToEdit]['image'] = $_POST['productImage'];
        }
    }

    // Xử lý Xóa sản phẩm
    if (isset($_GET['delete'])) {
        $productIdToDelete = $_GET['delete'];
        if (isset($products[$productIdToDelete])) {
            unset($products[$productIdToDelete]);
        }
    }
    ?>

    <h1>Danh sách sản phẩm</h1>
    <table>
        <tr>
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Giá</th>
            <th>Thao tác</th>
        </tr>
        <?php
        foreach ($products as $id => $product) {
            echo '<tr>';
            echo '<td>' . $product['stt'] . '</td>';
            echo '<td>' . $product['name'] . '</td>';
            echo '<td><img src="' . $product['image'] . '" alt="' . $product['name'] . '"></td>';
            echo '<td class = "mau">' . $product['price'] . '</td>';
            echo '<td><a href="?edit=' . $id . '">Sửa</a> | <a href="?delete=' . $id . '">Xóa</a></td>';
            echo '</tr>';
        }
        ?>
    </table>
    <br>
    <button onclick="showAlert()" class="hi">Thêm sản phẩm</button>

    <!-- Thông báo -->
    <div id="alert" class="form-container">
        <h3>Thêm sản phẩm mới</h3>
        <form method="post" action=""> 
        <label for="">Tên sản phẩm:</label> <input type="text" name="productName" required placeholder="Nhập tên sản phẩm"><br>
        <label for="">Giá sản phẩm:</label> <input type="text" name="productPrice" required placeholder="Nhập giá sản phẩm"><br>
        <label for="">Hình ảnh:</label> <input type="text" name="productImage" required class="input1" placeholder="Chọn ảnh"><br>
            <input type="submit" name="addProduct" value="Thêm sản phẩm" class="input2">
            <button type="button" onclick="hideAlert()">Hủy</button>
        </form>
    </div>

    <?php
    // Xử lý Sửa sản phẩm
    if (isset($_GET['edit'])) {
        $productIdToEdit = $_GET['edit'];
        if (isset($products[$productIdToEdit])) {
            $editedProduct = $products[$productIdToEdit];
            echo '<section class ="sua">';
            echo '<h1>Chỉnh sửa sản phẩm</h1>';
            echo '<form method="post"  action="?edit=' . $productIdToEdit . '">';
            echo '<input type="hidden" name="productID" value="' . $productIdToEdit . '">';
            echo 'STT sản phẩm: <input type="text" name="productStt" value="' . $editedProduct['stt'] . '" required><br>';
            echo 'Tên sản phẩm: <input type="text" name="productName" value="' . $editedProduct['name'] . '" required><br>';
            echo 'Giá sản phẩm: <input type="text" name="productPrice" value="' . $editedProduct['price'] . '" required><br>';
            echo 'Hình ảnh: <input type="text" name="productImage" value="' . $editedProduct['image'] . '" required class ="sua1"><br>';
            echo '<input type="submit" name="updateProduct" value="Cập nhật" class="sua3">';
            echo '</form>';
            echo '</section>';
        }
    }
    ?>
    
    </section>
    <footer>Nguyễn Kim Kỳ-PH46127</footer>
</body>

</html>