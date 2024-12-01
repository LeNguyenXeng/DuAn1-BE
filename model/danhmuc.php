<?php
  function loadall_danhmuc(){
    $sql = "SELECT * FROM danhmuc ORDER by id desc";
    $listdanhmuc = pdo_query($sql);
    return $listdanhmuc;
}
?>