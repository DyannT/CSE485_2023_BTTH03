<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music for Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style_login.css">
</head>

<body>
    <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
            <div class="container-fluid">
                <div class="my-logo">
             
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="./">Trang chủ</a>
                    </li>
 
                </ul>
 
                </div>
            </div>
        </nav>

    </header>
    <main class="container mt-5 mb-5">
    <?php
        // var_dump($_SERVER);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $user   = $_POST['txtUser'];
            $pass1  = $_POST['txtPass1'];
            // Kiểm
                // Kiểm tra Tài khoản nó đã TỒN TẠI CHƯA
                try{
                    $conn = mysqli_connect('localhost','root','','demo_membershipv2');
                }catch(Exception $e){
                    echo $e->getMessage();
                }
                $select_sql = "SELECT * FROM users WHERE username = '$user' OR email='$user'";
                $result_sql = mysqli_query($conn,$select_sql);
                if(mysqli_num_rows($result_sql) > 0){
                    $row = mysqli_fetch_assoc($result_sql);
                    $password_saved = $row['password'];
                    if(password_verify($pass1, $password_saved)){
                        if($row['is_activated'] == 1){
                            // Tạo phiên
                            session_start();
                            $_SESSION['user'] = $user;
                            $_SESSION['role'] = $row['membership_level'];
                            if($_SESSION['role'] == 'admin'){
                                header("Location: admin.php");
                            }else{
                                // Chuyển hướng
                            header("Location: member.php");
                            }
                        }else{
                            echo "<p style='color:red'>Tài khoản chưa được kích hoạt. Vui lòng kiểm tra lại</p>";
                        }

                    }else{
                        echo "<p style='color:red'>Mật khẩu không chính xác</p>"; 
                    }
                }else{
                    echo "<p style='color:red'>Tài khoản không tồn tại. Vui lòng kiểm tra lại</p>"; 
                }
            }
    ?>
        <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
        <div class="d-flex justify-content-center h-100">
                <div class="card">
                    <div class="card-header text-center ">
                        <h3>Sign In</h3>
                    </div>
                    <div class="card-body">
                    <form id = "formLogin" action="login.php" method="post">
                        <div class="error-input input-group mb-3">
                            <span class="input-group-text" id="txtUser"><i class="fas fa-user"></i></span>
                            <input type="text" class=" form-control" placeholder="username" name="txtUser">
                        </div>

                        <div class="error-input input-group mb-3">
                            <span class="input-group-text" id="txtPass"><i class="fas fa-key"></i></span>
                            <input type="password" class=" form-control" placeholder="password" name="txtPass1">
                        </div>
                        <div class="row align-items-center remember">
                            <input type="checkbox">Remember Me
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" name="login" value="Login" class="btn login_btn">
                        </div>

                    </form>
                    <div class="d-flex justify-content-center social_icon">
                            <span><i class="fa-brands fa-square-facebook"></i></span>
                            <span><i class="fab fa-google-plus-square"></i></span>
                            <span><i class="fab fa-twitter-square"></i></span>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center ">
                        Don't have an account? &nbsp
                        
                         <a href="register.php" class="text-decoration-none">Sign Up</a>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="#" class="text-decoration-none">Forgot your password?</a>
                    </div>
                </div>
            </div>

        </div>
    </main>
    <footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary  border-2" style="height:80px">
        <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>
