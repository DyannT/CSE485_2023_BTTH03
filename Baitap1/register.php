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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user   = $_POST['txtUser'];
            $mail   = $_POST['txtMail'];
            $pass1  = $_POST['txtPass1'];
            $pass2  = $_POST['txtPass2'];
            // Kiểm tra Mật khẩu có khớp ko
            if ($pass1 != $pass2) {
                echo "<p style='color:red'>Mật khẩu không khớp</p>";
                // header("Location:register.php");
            } else {
                // Kiểm tra Tài khoản nó đã TỒN TẠI CHƯA
                try {
                    $conn = mysqli_connect('localhost', 'root', '', 'demo_membershipv2');
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
                $select_sql = "SELECT * FROM users WHERE username = '$user' OR email='$mail'";
                $result_sql = mysqli_query($conn, $select_sql);
                if (mysqli_num_rows($result_sql) > 0) {
                    echo "<p style='color:red'>Tên đăng nhập hoặc Email đã được sử dụng</p>";
                } else {
                    // Lưu lại bản đăng kí vào CSDL
                    $pass_hash = password_hash($pass1, PASSWORD_DEFAULT);
                    $code_hash = md5(random_bytes(20));
                    $insert_sql = "INSERT INTO users (username, email, password, activation_code)
                    VALUES ('$user', '$mail', '$pass_hash', '$code_hash')";
                    if (mysqli_query($conn, $insert_sql)) {
                        echo "<p style='color:green'>Đăng kí thành công, vui lòng check Email để kích hoạt tài khoản</p>";
                        // Gửi Email chứa liên kết để kích hoạt
                        require './interface/EmailServerInterface.php';
                        require './class/EmailSender.php';
                        require './class/MyEmailServer.php';
                        $myEmailServer = new MyEmailServer();
                        $emailSender = new EmailSender($myEmailServer);
                        $body = 'Click the link to visit <a href="http://localhost:3000/activation.php?user='.$user.'&code='.$code_hash.'">Example Website</a>';
                        $myEmailServer->sendEmail('trantan1804@gmail.com', 'Kích hoạt tài khoản', $body);
        
                    }
                }
            }
        }
        ?>
        <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header text-center ">
                    <h3>Register</h3>
                </div>
                <div class="card-body">
                    <form id="formLogin" action="register.php" method="post">
                        <div class="error-input input-group mb-3">
                            <span class="input-group-text" id="txtUser"><i class="fas fa-user"></i></span>
                            <input type="text" class=" form-control" placeholder="User name" name="txtUser">
                        </div>
                        <div class="error-input input-group mb-3">
                            <span class="input-group-text" id="txtUser"><i class="fas fa-user"></i></span>
                            <input type="text" class=" form-control" placeholder="Email" name="txtMail">
                        </div>
                        <div class="error-input input-group mb-3">
                            <span class="input-group-text" id="txtPass"><i class="fas fa-key"></i></span>
                            <input type="password" class=" form-control" placeholder="Password" name="txtPass1">
                        </div>
                        <div class="error-input input-group mb-3">
                            <span class="input-group-text" id="txtPass"><i class="fas fa-key"></i></span>
                            <input type="password" class=" form-control" placeholder="Re-type Password" name="txtPass2">
                        </div>


                        <div class="form-group text-center">
                            <input type="submit" name="register" value="Register" class="btn login_btn">
                        </div>

                    </form>
                    <div class="d-flex justify-content-center social_icon">
                        <span><i class="fa-brands fa-square-facebook"></i></span>
                        <span><i class="fab fa-google-plus-square"></i></span>
                        <span><i class="fab fa-twitter-square"></i></span>
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