<?php
    if(is_array($tk)){
        extract($tk);
    }
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">CẬP NHẬT TÀI KHOẢN<nav></nav>
            </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Sửa Tài Khoản</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Bảng Tài Khoản
                </div>
                <div class="card-body">
                    <form action="index.php?act=updatetk" method="POST">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="tkmk form-label">UserName</label>
                            <input name="user" type="text" class="inputform form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder=" UserName"
                                value="<?php if (isset($user) && ($user != "")) echo $user; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="tkmk form-label">Email</label>
                            <input name="email" type="email" class="inputform form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder=" Email"
                                value="<?php if (isset($email) && ($email != "")) echo $email; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="tkmk form-label">Mật Khẩu</label>
                            <input name="pass" type="password" class="inputform form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder=" Mật Khẩu"
                                value="<?php if (isset($pass) && ($pass != "")) echo $pass; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="tkmk form-label">Địa Chỉ</label>
                            <input name="address" type="text" class="inputform form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder=" Địa Chỉ"
                                value="<?php if (isset($address) && ($address != "")) echo $address; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="tkmk form-label">Số Điện Thoại</label>
                            <input name="tel" type="number" class="inputform form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder=" Số Điện Thoại"
                                value="<?php if (isset($tel) && ($tel != "")) echo $tel; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="tkmk form-label">Vai Trò</label>
                            <input name="role" type="number" class="inputform form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder=" Vai Trò"
                                value="<?php if (isset($role) && ($role != "")) echo $role; ?>">
                        </div>
                        <div class="button">
                            <input type="hidden" value="<?php if (isset($id) && ($id != "")) echo $id; ?>">
                            <input name="capnhat" type="submit" value="Cập Nhật" class="btn btn-dark"></input>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>