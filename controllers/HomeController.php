<?php
    require("services/ArticleService.php");
    class HomeController{
        public function index($twig){
            $articelService = new ArticleService();
            $articles = $articelService->getAllArticlesHome();
            echo $twig->render('./view/home/index.twig', array('articles' => $articles));
        }

    }