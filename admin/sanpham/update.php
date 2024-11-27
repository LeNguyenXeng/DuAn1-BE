<?php
    include "header.php";
?>
<?php
if (is_array($sp)) {
    extract($sp);
}
$hinhpath = "../upload/" . $img;
                        if (is_file($hinhpath)) {
                          $hinh = '<img src="' . $hinhpath . '" height="100">';
                        } else {
                          $hinh = "no photo";
                        }

?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">SẢN PHẨM<nav></nav>
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
                    <form action="index.php?act=updatesp&id=<?=$id?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <select class="form-select" aria-label="Default select example" name="iddm">
                            <option selected>Tất Cả</option>
                            <?php foreach ($listdanhmuc as $danhmuc) {
                            extract($danhmuc);
                            if($id==$iddm) $s="selected"; else $s="";
                             echo '<option value="' . $id . '" '.$s.'>' . $name . '</option>';
                         }
                        ?>
                        </select>

                        <div class="form-group mt-2">
                            <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="Nhập tên sản phẩm" name="tensp" value="<?= $tensp ?>">
                        </div>

                        <div class="form-group mt-2">
                            <label for="exampleInputEmail1">Giá</label>
                            <input type="number" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Nhập giá sản phẩm" name="giasp"
                                value="<?= $price ?>">
                        </div>
                        <div class="form-group mt-2">
                            <label for="exampleInputEmail1">Hình Ảnh</label>
                            <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="Nhập giá sản phẩm" name="hinh" value="<?= $hinh ?>">
                        </div>
                        <div class="form-group mt-2">
                            <label for="exampleInputEmail1">Mô Tả</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="6"
                                value="<?= $mota ?>" name="mota"></textarea>
                        </div>
                      <button >Cập Nhật</button>
                        <!-- <input onclick="return confirm('Ban co muon cap nhat khong?')" type="button" class="btn mt-2 btn btn-dark" name="capnhat" value="Cập Nhật"> -->
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>