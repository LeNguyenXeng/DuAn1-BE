<?php
    function insert_sanpham($tensp,$giasp,$hinhanhsp,$mota,$iddm){
        $sql = "INSERT INTO sanpham(tensp,price,img,mota,iddm) values('$tensp','$giasp','$hinhanhsp','$mota','$iddm')";
        pdo_execute($sql);
    }
    function delete_sanpham($id){
        $sql = "DELETE from sanpham WHERE id=".$id;
        pdo_execute($sql);
    }
    function loadall_sanpham($kyw,$iddm=0){
        $sql = "SELECT * FROM sanpham where 1";
        if($kyw!=""){
            $sql.=" and tensp like '%".$kyw."%'";
        }
        if($iddm>0){
            $sql.=" and iddm ='".$iddm."'";
        }
        $sql.=" ORDER by id desc";
        $listsanpham = pdo_query($sql);
        return $listsanpham;
    }
    function loadone_sanpham($id){
        $sql = "SELECT * FROM sanpham WHERE id=".$id;
        $sp = pdo_query_one($sql);
        return $sp;
    }
    function update_sanpham($id,$tensp,$giasp,$mota,$hinh){
        if($hinh!=""){
            $sql = "UPDATE sanpham set tensp='".$tensp."', price='".$giasp."', mota='".$mota."', img='".$hinh."' WHERE id=".$id;
        }
        else{
            $sql = "UPDATE sanpham set tensp='".$tensp."', price='".$giasp."', mota='".$mota."' WHERE id=".$id;

        }
        pdo_execute($sql);
    }
    function loadall_sanpham_home(){
        $sql = "SELECT * FROM sanpham WHERE 1 order by id desc limit 0,16";
        $listsanpham = pdo_query($sql);
        return $listsanpham;
    }
?>