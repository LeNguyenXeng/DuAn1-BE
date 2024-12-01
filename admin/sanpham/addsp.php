<?php
include "header.php";
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">SẢN PHẨM<nav></nav>
            </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Thêm Sản Phẩm</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Bảng Sản Phẩm
                </div>
                <div class="card-body">
                    <form action="index.php?act=addsp" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="tkmk form-label">Danh Mục</label>
                            <select name="iddm" class="form-select" aria-label="Default select example">
                                <?php
                                   foreach ($listdanhmuc as $danhmuc) {
                                    extract($danhmuc);
                                    echo '<option value="' . $id . '">' . $name . '</option>';
                                }                                
                                    ?>

                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="tkmk form-label">Tên sản phẩm</label>
                            <input name="tensp" type="text" class="inputform form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder=" Tên sản phẩm" required>
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="tkmk form-label">Giá</label>
                            <input name="giasp" type="number" class="inputform form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder=" Giá" required>
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="tkmk form-label">Hình ảnh</label>
                            <input name="hinh" type="file" class="inputform form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder=" Hình ảnh">
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="tkmk form-label">Mô tả</label>
                            <textarea name="mota" class="form-control" id="exampleFormControlTextarea1" rows="5"
                                required></textarea>
                        </div>
                        <div class="button">
                            <input name="themmoi" type="submit" value="Thêm" class="btn btn-dark"></input>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>