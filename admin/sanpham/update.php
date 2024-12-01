<?php
    if(is_array($sanpham)){
        extract($sanpham);
    }
    if (isset($filename) && $filename !== null) {
        if (is_file($filename)) {
            $hinh = "<img src='".$hinhanhsppath."' height='80'>";

        } else {
            $hinh = "No Photos";

        }
    } else {
        // Xử lý khi $filename là null
        echo "Tên file không hợp lệ.";
    }
?>
<?php
include "header.php";
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="">SẢN PHẨM<nav></nav>
            </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Cập Nhật Sản Phẩm</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Bảng Sản Phẩm
                </div>
                <div class="card-body">
                    <form action="index.php?act=updatesp" method="POST" enctype="multipart/form-data">
                        <!-- <div class="mb-3">
                            <label for="exampleInputEmail1" class="tkmk form-label">Tên danh mục</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div> -->
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="tkmk form-label">Tên sản phẩm</label>
                            <input name="tensp" type="text" class="inputform form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder=" Tên sản phẩm" required
                                value="<?php echo $tensp ?>">
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="tkmk form-label">Giá</label>
                            <input name="giasp" type="number" class="inputform form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder=" Giá" required value="<?php echo $price ?>">
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="tkmk form-label">Hình ảnh</label>
                            <input name="hinh" type="file" class="inputform form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder=" Hình ảnh">
                            <?php echo $img?>
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="tkmk form-label">Mô tả</label>
                            <textarea name="mota" class="form-control" id="exampleFormControlTextarea1" rows="5"
                                required><?php echo $mota ?></textarea>
                        </div>
                        <div class="button">
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <input name="capnhat" type="submit" value="Cập Nhật" class="btn btn-dark"></input>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>