<?php
if (is_array($dm)) {
    extract($dm);
}

?>
<div class="row">
    <div class="row forntile">
        <h1>CẬP NHẬT LOẠI HÀNG HÓA</h1>
    </div>
    <div class="row forncontent ">
        <form action="index.php?act=update" method="POST">
            <div class="row mb10 ">
                <label> Mã loại </label> <br>
                <input type="text" name="id" placeholder="nhập vào mã loại" disabled>
            </div>
            <div class="row mb10">
                <label>Tên loại </label> <br>
                <input type="text" name="ten" placeholder="nhập vào tên" value="<?php if ($name != "") echo  $name ?>">
            </div>
            <div class="row mb10 ">
                <input type="hidden" name="id" value="<?php if ($id >0) echo  $id ?>">
                <input class="mr20" type="submit" name="capnhat" value="Cập Nhật">
                <input class="mr20" type="reset" value="Nhập Lại">

                <a href="index.php?act=list"><input class="mr20" type="button" value="DANH SÁCH"></a>
            </div>
            <?php
            if (isset($thongbao) && $thongbao != "") {
                echo $thongbao;
            }

            ?>
            <div><?php $thongbao ?></div>
        </form>
    </div>
</div>