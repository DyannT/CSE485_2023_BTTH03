<?php
// require_once 'vendor/autoload.php';
require_once __DIR__ . '/vendor/autoload.php';
require_once 'config/config.php';
$loader = new \Twig\Loader\FilesystemLoader(__DIR__);
$twig = new \Twig\Environment($loader);
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'add':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $stmt = $db->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
            $stmt->execute([$name, $email]);
            header('Location: index.php');
            exit;
        }
        echo $twig->render('templates/add.twig');
        break;
    case 'edit':
        $id = $_GET['id'];
        $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_user = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $stmt = $db->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
            $stmt->execute([$name, $email, $id_user]);
            header('Location: index.php');
            exit;
        }
        echo $twig->render('templates/edit.twig', ['user' => $user]);
        break;
    case 'delete':
        $id = $_GET['id'];
        $stmt = $db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
        header('Location: index.php');
        exit;
        break;
    default:
        $stmt = $db->query("SELECT * FROM users");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo $twig->render('templates/index.twig', ['users' => $users]);
        break;
}

?>