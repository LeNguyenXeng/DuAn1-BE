<style>
.product-list .mota {
    white-space: normal;
    /* Cho phép xuống dòng tự nhiên */
    word-wrap: break-word;
    /* Ngắt dòng nếu cần */
    max-width: 300px;
    /* Giới hạn chiều rộng (nếu cần) */
    overflow: hidden;
    /* Ẩn phần nội dung tràn (tùy chọn) */
}
</style>
<?php
    include "header.php";
?>
<?php

?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">SẢN PHẨM<nav></nav>
            </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Danh Sách Sản Phẩm</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Bảng Danh Sách
                </div>
                <div class="card-body">
                    <form action="index.php?act=listsp" style="display: flex" method="POST">
                        <input type="text" name="kyw" class="btn"
                            style="    border: 1px solid #ced4da;     margin-bottom: 15px;">
                        <select name="iddm" style="    display: block;
    width: 20%; margin-left: 5px;     margin-bottom: 15px;" class="form-select">
                            <option value="0" selected>Tất Cả</option>
                            <?php
                                   foreach ($listdanhmuc as $danhmuc) {
                                    extract($danhmuc);
                                    echo '<option value="' . $id . '">' . $name . '</option>';
                                }                                
                                    ?>
                        </select>
                        <input type="submit" class="btn btn-outline-secondary" name="listok" value="Tìm Kiếm"
                            style="margin-left: 10px;     margin-bottom: 15px;">
                    </form>
                    <table class=" table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">MÃ LOẠI</th>
                                <th scope="col">TÊN SẢN PHẨM</th>
                                <th scope="col">HÌNH ẢNH</th>
                                <th scope="col">GIÁ</th>
                                <th scope="col">MÔ TẢ</th>
                                <th scope="col">LƯỢT XEM</th>
                                <th scope="col">HÀNH ĐỘNG</th>
                            </tr>
                        </thead>
                        <tbody class="product-list">
                            <?php
                                foreach($listsanpham as $sanpham) {
                                    extract($sanpham);
                                    $suasp = "index.php?act=suasp&id=".$id;
                                    $xoasp = "index.php?act=xoasp&id=".$id;
                                    $hinhanhsppath = "../upload/".$img;
                                    if(is_file($hinhanhsppath)) {
                                        $img = "<img src='".$hinhanhsppath."' height='80'>";
                                    } else {
                                        $img = "No Photos";
                                    }
                                    echo '<tr>
                                        <td>'.$id.'</td>
                                        <td>'.$tensp.'</td>
                                        <td>'.$img.'</td>
                                        <td>'.number_format($price, 0, '', ',').'₫</td>
                                        <td class="mota">'.$mota.'</td>
                                        <td>'.$luotxem.'</td>
                                        <td>
                                            <a href="'.$suasp.'">
                                                <input class="btn btn-outline-danger" type="button" value="Sửa">
                                            </a>
                                            <a onclick="return confirm(\'Bạn có muốn xoá không?\')" href="'.$xoasp.'">
                                                <input class="btn btn-outline-primary" type="button" value="Xóa">
                                            </a>
                                        </td>
                                    </tr>';
                                }
                                ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>