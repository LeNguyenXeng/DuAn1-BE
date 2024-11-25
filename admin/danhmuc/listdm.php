<div class="row">
            <div class="row forntile"><h1> DANH SÁCH LOẠI HÀNG HÓA </h1></div>
            <div class="row forncontent">
                
                    <div class="row mb10 forndsloai">
                   <table>
                    <tr>
                       <th></th>
                        <th>MÃ LOẠI</th>
                        <th>TÊN LOẠI</th>
                      <th></th>

                    </tr>
                    <?php 
                        foreach ($listdanhmuc as $danhmuc) {
                            extract($danhmuc);
                            $suadm = "index.php?act=suadm&id=" . $id;
                            $xoadm = "index.php?act=xoadm&id=" . $id;
                            echo '<tr>
                                <td><input type="checkbox"></td>
                                <td>'.$id.'</td>
                                <td>'.$name.'</td>
                                <td>
                                    <a href="'.$suadm.'"><input type="button" value="Sửa"></a>
                                    <a href="'.$xoadm.'"><input type="button" value="Xóa"></a>
                                    
                                </td>
                            </tr>';
                        }
                        
                     ?>
                    
                   </table>
                </div>
                
                <div class="row mb10">
                    <input type="button" value="Chọn tất cả">
                    <input type="button" value="Bỏ chọn tất cả">
                    <input type="button" value="Xóa các mục đã chọn">
                   <a href="index.php?act=adddm"><input type="button" value="Thêm mới"></a>
                    
                </div>
                </form>
            </div>
        </div>