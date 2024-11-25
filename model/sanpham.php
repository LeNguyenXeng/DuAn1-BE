<?php

function insert_sanpham($tensp,$giasp,$hinh,$mota,$iddm)
{
    $sql="insert into sanpham (tensp,price,img,mota,iddm) values('$tensp','$giasp','$hinh','$mota','$iddm')";
    pdo_execute($sql);
}
function delete_sanpham($id)
{
    $sql = "DELETE from sanpham where id=" . $id;
    pdo_execute($sql);
}

function loadall_sanpham_home()
{
    $sql = "SELECT * FROM sanpham where 1 order by id desc limit 0,9";
    $listsanpham = pdo_query($sql);
    return $listsanpham;
}

function loadall_sanpham_top10()
{
    $sql = "SELECT * FROM sanpham where 1 order by luotxem desc limit 0,10";
    $listsanpham = pdo_query($sql);
    return $listsanpham;
}


function loadall_sanpham()
{
    $sql = "SELECT * FROM sanpham order by id desc";
    $listsanpham = pdo_query($sql);
    return $listsanpham;
}


function load_sanpham_cungloai($id,$iddm)
{
    $sql = "SELECT * from sanpham where iddm = $iddm and id <> $id LIMIT 0,3" . $id;
    $listsanpham = pdo_query($sql);
    return $listsanpham;
}

function loa_tendm($iddm)
{
    if($iddm>0){
    $sql = "SELECT * from danhmuc where id=" . $iddm;
    $dm = pdo_query_one($sql);
    extract($dm);
    return $name;
    }else{
        return "";
    }
}
function loadone_sanpham($id)
{
    $sql = "SELECT * from sanpham where id=" . $id;
    $sp = pdo_query_one($sql);
    return $sp;
}
function    update_sanpham($id,$tensp,$giasp,$hinh,$mota,$iddm){
    if ($hinh != "")
        $sql = "UPDATE sanpham SET tensp='" . $tensp . "',price='" . $giasp . "',img='" . $hinh . "',mota='" . $mota . "',iddm='" . $iddm . "' where id=" . $id;
    else
        $sql = "UPDATE sanpham SET tensp='" . $tensp . "',price='" . $giasp . "',mota='" . $mota . "',iddm='" . $iddm . "' where id=" . $id;
    pdo_execute($sql);

}

