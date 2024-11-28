<?php
    function insert_sanpham($tensp,$giasp,$hinhanhsp,$mota,$iddm){
        $sql = "INSERT INTO sanpham(tensp,price,img,mota,iddm) values('$tensp','$giasp','$hinhanhsp','$mota','$iddm')";
        pdo_execute($sql);
    }
    function delete_sanpham($id){
        $sql = "DELETE from sanpham WHERE id=".$id;
        pdo_execute($sql);
    }
    function loadall_sanpham(){
        $sql = "SELECT * FROM sanpham order by id desc";
        $listsanpham = pdo_query($sql);
        return $listsanpham;
    }
    function loadone_sanpham($id){
        $sql = "SELECT * FROM sanpham WHERE id=".$id;
        $sp = pdo_query_one($sql);
        return $sp;
    }
    function update_sanpham($id,$tensp,$giasp,$mota,$hinh){
        if($hinh!="")
            $sql = "UPDATE sanpham SET tensp='".$tensp."',price='".$giasp."',mota='".$mota."',img='".$hinh."' WHERE id=".$id;
        
        else
            $sql = "UPDATE sanpham SET tensp='".$tensp."',price='".$giasp."',mota='".$mota."' WHERE id=".$id;
        pdo_execute($sql);
    }
    function loadall_sanpham_home(){
        $sql = "SELECT * FROM sanpham WHERE 1 order by id desc limit 0,16";
        $listsanpham = pdo_query($sql);
        return $listsanpham;
    }
?>