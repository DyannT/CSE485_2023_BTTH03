<?php
    require("services/ArticleService.php");
    class HomeController{
        public function index(){
            $articelService = new ArticleService();
            $articles = $articelService->getAllArticlesHome();

            include("view/home/index.php");
        }

    }