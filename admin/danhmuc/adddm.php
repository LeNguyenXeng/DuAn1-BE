
<div class="row">
 <div class="row forntile">
   <h1>
     THÊM MỚI LỌAI HÀNG HÓA
   </h1>
   </div>
   <div class="row forncontent ">

     <form action="index.php?act=adddm" method="POST">
     <div class="row mb10">
            Mã loại<br>
            <input type="text" name="maloai "disabled>
    </div>
       <div class="row mb10">
         <label>Tên loại </label> <br>
         <input type="text" name="tenloai" placeholder="Nhập vào tên">
       </div>
       <div class="row mb10 ">
         <input class="mr20" type="submit" name="submit" value="THÊM MỚI">
         <input class="mr20" type="reset" value="NHẬP LẠI">
         <a href="index.php?act=listdm"><input class="mr20" type="button" value="DANH SÁCH"></a>
       </div>
        <?php
      if (isset($thongbao) && ($thongbao != "")) {
        echo $thongbao;
      }
      ?>
     </form>
    
   </div>
 </div>