<?php
require_once("config/DBConnection.php");
include("models/Category.php");
class CategoryService{
    public function getAllCategorys(){
        // 4 bước thực hiện
       $dbConn = new DBConnection();
       $conn = $dbConn->getConnection();

        // B2. Truy vấn
        $sql = "SELECT * FROM theloai";
        $stmt = $conn->query($sql);

        // B3. Xử lý kết quả
        $categorys = [];
        while($row = $stmt->fetch()){
            $category = new Category( $row['ma_tloai'], $row['ten_tloai'],$row['SLBaiViet']);
            array_push($categorys,$category);
        }

        // Mảng (danh sách) các đối tượng Category Model

        return $categorys;
    }

    public function editCategory($id){
        // 4 bước thực hiện
       $dbConn = new DBConnection();
       $conn = $dbConn->getConnection();

        // B2. Truy vấn
        $sql = "SELECT * FROM theloai WHERE ma_tloai = '" . $id . "'";
        $stmt = $conn->query($sql);

        // B3. Xử lý kết quả
        $categorys = [];
        while($row = $stmt->fetch()){
            $category = new Category( $row['ma_tloai'], $row['ten_tloai'],$row['SLBaiViet']);
            array_push($categorys,$category);
        }

        // Mảng (danh sách) các đối tượng Category Model

        return $categorys;
    }

    public function updateCategory($id,$name){
                // 4 bước thực hiện
       $dbConn = new DBConnection();
       $conn = $dbConn->getConnection();

        // B2. Truy vấn
        $sql_update = "UPDATE `theloai` SET `ten_tloai`='" . $name . "' WHERE `ma_tloai` = '" . $id . "'";
        $stmt_update = $conn->query($sql_update);

        $sql_select = "SELECT * FROM theloai";
        $stmt_select = $conn->query($sql_select);

        // B3. Xử lý kết quả
        $categorys = [];
        while($row = $stmt_select->fetch()){
            $category = new Category( $row['ma_tloai'], $row['ten_tloai'],$row['SLBaiViet']);
            array_push($categorys,$category);
        }

        // Mảng (danh sách) các đối tượng Category Model

        return $categorys;
    }

    public function storeCategory($name){
        // 4 bước thực hiện
       $dbConn = new DBConnection();
       $conn = $dbConn->getConnection();

        // B2. Truy vấn
        $sql_store = "INSERT INTO `theloai`(`ten_tloai`) VALUES ('" . $name . "')";
        $stmt_store = $conn->query($sql_store);

        $sql_select = "SELECT * FROM theloai";
        $stmt_select = $conn->query($sql_select);

        // B3. Xử lý kết quả
        $categorys = [];
        while($row = $stmt_select->fetch()){
            $category = new Category( $row['ma_tloai'], $row['ten_tloai'],$row['SLBaiViet']);
            array_push($categorys,$category);
        }

        // Mảng (danh sách) các đối tượng Category Model

        return $categorys;
    }

    public function deleteCategory($id){
        // 4 bước thực hiện
       $dbConn = new DBConnection();
       $conn = $dbConn->getConnection();

        // B2. Truy vấn
        $sql_delete = "DELETE FROM `theloai` WHERE `ma_tloai` = '" . $id . "'";
        $stmt_delete = $conn->query($sql_delete);

        $sql_select = "SELECT * FROM theloai";
        $stmt_select = $conn->query($sql_select);

        // B3. Xử lý kết quả
        $categorys = [];
        while($row = $stmt_select->fetch()){
            $category = new Category( $row['ma_tloai'], $row['ten_tloai'],$row['SLBaiViet']);
            array_push($categorys,$category);
        }

        // Mảng (danh sách) các đối tượng Category Model

        return $categorys;
    }
}
