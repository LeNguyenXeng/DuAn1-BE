<?php
     function insert_taikhoan($email,$user,$pass,$tel){
        $sql = "INSERT INTO taikhoan(user,tel,email,pass) values('$email','$user','$pass','$tel')";
        pdo_execute($sql);
    }
    function checkuser($email,$pass){
        $sql = "SELECT * FROM taikhoan WHERE email='".$email."' AND pass='".$pass."'";
        $sp = pdo_query_one($sql);
        return $sp;
        
    }
    function update_taikhoan($id,$user,$pass,$email,$address,$tel){
        $sql = "UPDATE taikhoan SET user='".$user."',pass='".$pass."',email='".$email."',address='".$address."',tel='".$tel."' WHERE id=".$id;
        pdo_execute($sql);
    }
    function checkemail($email){
        $sql = "SELECT * FROM taikhoan WHERE email='".$email."'";
        $sp = pdo_query_one($sql);
        return $sp;
    }
    function loadall_taikhoan(){
        $sql = "SELECT * FROM taikhoan ORDER by id desc";
        $listtaikhoan = pdo_query($sql);
        return $listtaikhoan;
    }
    function loadall_cmt(){
        $sql = "SELECT * FROM binh_luan ORDER by id_bl desc";
        $listcmt = pdo_query($sql);
        return $listcmt;
    }
    function delete_taikhoan($id){
        $sql = "DELETE FROM taikhoan WHERE id=".$id;
        pdo_execute($sql);
    }
    function loadone_taikhoan($id){
        $sql = "SELECT * FROM taikhoan WHERE id=".$id;
        $tk = pdo_query_one($sql);
        return $tk;
    }
?>