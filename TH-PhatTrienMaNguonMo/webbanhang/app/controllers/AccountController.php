<?php
require_once('app/config/database.php');
require_once('app/models/AccountModel.php');
require_once('app/utils/JWTHandler.php');



class AccountController
{
    private $accountModel;
    private $db;
    private $jwtHandler;
    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->accountModel = new AccountModel($this->db);
        $this->jwtHandler = new JWTHandler();
    
    }
    function register()
    {
        include_once 'app/views/account/register.php';
    }
    public function login()
    {
        $error = $_SESSION['login_error'] ?? null; 
        unset($_SESSION['login_error']); 
        include_once 'app/views/account/login.php';
    }

    public function forgotpassword()
    {
        include_once 'app/views/account/forgotpassword.php';
    }

    function save()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $fullName = $_POST['fullname'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirmpassword'] ?? '';
            $errors = [];
            if (empty($username)) {
                $errors['username'] = "Vui long nhap userName!";
            }
            if (empty($fullName)) {
                $errors['fullname'] = "Vui long nhap fullName!";
            }
            if (empty($password)) {
                $errors['password'] = "Vui long nhap password!";
            }
            if ($password != $confirmPassword) {
                $errors['confirmPass'] = "Mat khau va xac nhan chua dung";
            }
            //kiểm tra username đã được đăng ký chưa?
            $account = $this->accountModel->getAccountByUsername($username);
            if ($account) {
                $errors['account'] = "Tai khoan nay da co nguoi dang ky!";
            }
            if (count($errors) > 0) {
                include_once 'app/views/account/register.php';
            } else {
                $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
                $result = $this->accountModel->save($username, $fullName, $password);
                if ($result) {
                    header('Location: /webbanhang/account/login');
                }
            }
        }
    }
    function logout()
    {
        unset($_SESSION['username']);
        unset($_SESSION['role']);
        header('Location: /webbanhang/product');
    }
    public function checkLogin()
    {

        header('Content-Type: application/json');
        $data = json_decode(file_get_contents("php://input"), true);
        
        $username = $data['username'] ?? '';
        $password = $data['password'] ?? '';    
        $user = $this->accountModel->getAccountByUserName($username);
        if ($user && password_verify($password, $user->password)) {
            $token = $this->jwtHandler->encode(['id' => $user->id, 'username' =>
            $user->username]);
            echo json_encode(['token' => $token]);
            } else {
                http_response_code(401);
                echo json_encode(['message' => 'Invalid credentials']);
            }
    }   

    public function checkUsernameExists()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $account = $this->accountModel->getAccountByUsername($username);

            if ($account) {
                $verification_code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
                $_SESSION['reset_username'] = $username;
                $_SESSION['verification_code'] = $verification_code;

                echo "<script>console.log('Mã xác nhận của bạn là: " . $verification_code . "');</script>";
                
                header('Location: /webbanhang/account/showVerifyCodeForm');
                
                exit();
            } else {
                $error = "Username does not exist!";
                include_once 'app/views/account/forgotpassword.php';
                exit();
            }
        } else {
            header('Location: /webbanhang/account/forgotpassword');
            exit();
        }
    }

    public function showVerifyCodeForm()
    {
        if (!isset($_SESSION['reset_username']) || !isset($_SESSION['verification_code'])) {
            header('Location: /webbanhang/account/forgotpassword');
            exit();
        }
        $error = $_SESSION['verify_error'] ?? null;
        unset($_SESSION['verify_error']);
        $code_for_display = $_SESSION['verification_code'];
        include_once 'app/views/account/verify_code.php';
    }

    public function verifyCode()
    {
        if (!isset($_SESSION['reset_username']) || !isset($_SESSION['verification_code'])) {
            header('Location: /webbanhang/account/forgotpassword');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user_code = $_POST['verification_code'] ?? '';
            if ($user_code == $_SESSION['verification_code']) {
                $_SESSION['is_verified'] = true;
                unset($_SESSION['verification_code']);
                header('Location: /webbanhang/account/showResetForm');
                exit();
            } else {
                $_SESSION['verify_error'] = 'Mã xác nhận không chính xác!';
                header('Location: /webbanhang/account/showVerifyCodeForm');
                exit();
            }
        }
    }

    public function showResetForm()
    {
        if (!isset($_SESSION['reset_username']) || !isset($_SESSION['is_verified'])) {
            header('Location: /webbanhang/account/forgotpassword');
            exit();
        }
        include_once 'app/views/account/reset_password.php';
    }

    public function updatePassword()
    {
        if (!isset($_SESSION['reset_username']) || !isset($_SESSION['is_verified'])) {
            header('Location: /webbanhang/account/forgotpassword');
            exit();
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            $username = $_SESSION['reset_username'];
            $errors = [];

            if (empty($password)) {
                $errors[] = "Password is required!";
            }
            if ($password != $confirmPassword) {
                $errors[] = "Passwords do not match!";
            }

            if (count($errors) > 0) {
                // Có lỗi, hiển thị lại form reset với các lỗi
                include_once 'app/views/account/reset_password.php';
            } else {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
                $result = $this->accountModel->updatePasswordByUsername($username, $hashedPassword);

                if ($result) {
                    unset($_SESSION['reset_username']);
                    header('Location: /webbanhang/account/login');
                    exit();
                } else {
                    $errors[] = "An error occurred while updating the password. Please try again.";
                    include_once 'app/views/account/reset_password.php';
                }
            }
        }
    }
}
