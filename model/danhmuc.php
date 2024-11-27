<?php

function insert_danhmuc($tenloai)
{
    $sql = "INSERT into danhmuc(name) value('$tenloai')";
    pdo_execute($sql);
}
function delete_danhmuc($id)
{
    $sql = "DELETE from danhmuc where id=" . $id;
    pdo_execute($sql);
}
function loadall_danhmuc()
{
    $sql = "SELECT * from danhmuc order by id desc";
    $listdanhmuc = pdo_query($sql);
    return $listdanhmuc;
}
function loadone_danhmuc($id)
{
    $sql = "SELECT * from danhmuc where id=" . $id;
    $dm = pdo_query_one($sql);
    return $dm;
}
function update_danhmuc($id, $tenloai)
{
    $sql = "UPDATE danhmuc set name='" . $tenloai . "'where id=" . $id;
    pdo_execute($sql);
}
