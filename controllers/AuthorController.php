<?php
require("services/AuthorService.php");
class AuthorController
{
    // Hàm xử lý hành động index
    public function index($twig)
    {
        $authorService = new AuthorService();
        $authors = $authorService->getAllAuthor();
        echo $twig->render('./view/author/author.twig', array('authors' => $authors));
        // include "view/author/author.php";
    }

    public function add()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $name = $_POST['txtAutName'];
            $image_path = $_POST['path'].$_FILES['img']['name'];
            $name_image = $_FILES['img']['name'];
            $authorService = new AuthorService();
            $authorService->create($name, $name_image);
            move_uploaded_file($_FILES['img']['tmp_name'], $image_path);
            header("Location: /index.php?controller=author&action=index");
        }else{
            include "view/author/add_author.php";
        }
    }
    public function edit(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $ma_tgia = $_POST['txtAutId'];
            $name = $_POST['txtAutName'];
            $image_path = $_POST['path'].$_FILES['img']['name'];
            $name_image = $_FILES['img']['name'];
            $authorService = new AuthorService();
            $authorService->edit($ma_tgia, $name, $name_image);
            move_uploaded_file($_FILES['img']['tmp_name'], $image_path);
            header("Location: index.php?controller=author&action=index");
        }else{
            $ma_tgia = $_GET['ma_tgia'];
            $authorService = new AuthorService();
            $author = $authorService->getAuthorById($ma_tgia);
            include "view/author/edit_author.php";
        }
    }
    public function delete()
    {
        if (isset($_GET['ma_tgia'])) {
            $authorService = new AuthorService();
            $ma_tgia = $_GET['ma_tgia'];
            $authorService->delete($ma_tgia);
        }
        header("Location: index.php?controller=author&action=index");
    }

}
