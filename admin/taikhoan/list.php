<?php
    include "header.php";
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">TÀI KHOẢN<nav></nav>
            </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Danh Sách Tài Khoản</li>
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
                                <th scope="col">ID</th>
                                <th scope="col">TÊN</th>
                                <th scope="col">MẬT KHẨU</th>
                                <th scope="col">EMAIL</th>
                                <th scope="col">ĐỊA CHỈ</th>
                                <th scope="col">SỐ ĐIỆN THOẠI</th>
                                <th scope="col">VAI TRÒ</th>
                                <th scope="col">HÀNH ĐỘNG</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($listtaikhoan as $taikhoan){
                                extract($taikhoan);
                                $suatk = "index.php?act=suatk&id=".$id;
                                $xoatk = "index.php?act=xoatk&id=".$id;
                                echo '<tr>
                                    <td>'.$id.'</td>
                                    <td>'.$user.'</td>
                                    <td>'.$pass.'</td>
                                    <td>'.$email.'</td>
                                    <td>'.$address.'</td>
                                    <td>'.$tel.'</td>
                                    <td>'.$role.'</td>
                                    <td><a href="'.$suatk.'"><input type="button" class="btn btn-outline-danger" name="" value="Sửa"></a>
                                       <a onclick="return confirm(\'Bạn có muốn xoá không?\')" href="'.$xoatk.'"><input type="button" class="btn btn-outline-primary" name="" value="Xóa"></a></td>
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