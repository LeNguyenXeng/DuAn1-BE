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
                    <table class="table table-hover">
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
                        <tbody>
                            <?php
                            foreach($listsanpham as $sanpham){
                                extract($sanpham);
                                $suasp = "index.php?act=suasp&id=".$id;
                                $xoasp = "index.php?act=xoasp&id=".$id;
                                $hinhanhsppath = "../upload/".$img;
                                if(is_file($hinhanhsppath)){
                                    $hinh = "<img src='".$hinhanhsppath."' height='80'>";
                                }
                                else{
                                    $hinh = "No Photos";
                                }
                                echo '<tr>
                                    <td>'.$id.'</td>
                                    <td>'.$tensp.'</td>
                                    <td>'.$hinh.'</td>
                                    <td>'.number_format($price, 0, '', ',').'₫</td>
                                    <td>'.$mota.'</td>
                                    <td>'.$luotxem.'</td>
                                    <td><a href="'.$suasp.'"><input class="btn btn-outline-danger" type="button" name="" value="Sửa"></a>
                                       <a onclick="return confirm(\'Bạn có muốn xoá không?\')" href="'.$xoasp.'"><input class="btn btn-outline-primary" type="button" name="" value="Xóa"></a></td>
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
<?php
    include "footer.php";
?>