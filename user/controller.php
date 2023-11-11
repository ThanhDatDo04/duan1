  <?php
  // Navbar
  ob_start();
  session_start();
  include_once("_navbar.php");
  include_once("./global.php");
  include_once "./model/pdo.php";
  include_once "./model/cat.php";
  include_once "./model/product.php";
  include_once "./model/size.php";
  include_once "./model/slider.php";
  include_once "./model/user.php";

  $spnew = loadall_pro_home();
  $dsdm = loadall_cat();
  $dst8 = loadall_pro_top8();
  $dssl = loadall_slider();
  // Controller
  if (isset($_GET['act']) && ($_GET['act']) != "") {
    $act = $_GET['act'];
    switch ($act) {
      case 'home':
        include_once("user/home/index.php");
        break;
      case 'search_pro':
        if (isset($_POST['kyw']) && ($_POST['kyw']) != "") {
          $kyw = $_POST['kyw'];
        } else {
          $kyw = "";
        }
        $sp = loadall_proo($kyw);
        // $name_cat = load_ten_dm($id_cat);
        include "search_pro.php";
        break;
      case 'pro_detail':
        if (isset($_GET['id_pro']) && ($_GET['id_pro']) > 0) {
          $onesp = loadone_pro($_GET['id_pro']);
          $dss = loadall_size();
          extract($onesp);
          $spcl = loadone_sp_cungloai($_GET['id_pro'], $id_cat);
          tangluotxem($_GET['id_pro']);
          include "detail.php";
        } else {
          include "user/home/index.php";
        }
        break;
      case 'product_cat':
        if (isset($_GET['id_cat']) && ($_GET['id_cat']) > 0) {
          $id_cat = $_GET['id_cat'];
        } else {
          $id_cat = 0;
        }
        $dssp = loadall_pro_cat($id_cat);
        $name_cat = load_ten_dm($id_cat);
        include "product_cat.php";
        break;

        //shop
      case 'shop':
        $sps = loadall_pro_shop1();
        include_once("shop.php");
        break;
      case 'shop1':
        $sps = loadall_pro_shop2();
        include_once("shop.php");
        break;
      case 'shop2':
        $sps = loadall_pro_shop3();
        include_once("shop.php");
        break;

      case 'contact':
        include_once("contact.php");
        break;

      case 'checkout':
        include_once("checkout.php");
        break;
      case 'sign_up':
        if (isset($_POST['sign_up']) && ($_POST['sign_up'])) {
          $username = $_POST['username'];
          $password = $_POST['password'];
          $name = $_POST['name'];
          $address = $_POST['address'];
          $phone = $_POST['phone'];
          $email = $_POST['email'];
          $file = $_FILES['image']['name'];
          $target_dir = "./upload/";
          $target_file = $target_dir . basename($_FILES['image']["name"]);
          if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
          } else {
            // echo "Sorry, there was an error uploading your file.";
          }
          //  $hinh=$_POST['hinh'];
          insert_tk($username, $password, $name, $address, $phone, $email, $file);
          $tbao = "Creat account sucsess!Please login to do comment or order products!";
        }
        include_once("pages-sign-up.php");
        break;
      case 'login':
        if (isset($_POST['dangnhap']) && ($_POST['dangnhap'])) {
          $username = $_POST['username'];
          $password = $_POST['password'];
          $check_user = check_user($username, $password);
          if (is_array($check_user)) {
            $_SESSION['user'] = $check_user;
            // header('Location:login_sucsess.php');
            include "login_sucsess.php";
            // $tbao = "Ban da dang nhap thanh cong!";
          } else {
            $tbao = "Account no have, Please check or sign_up!";
          }
        }
        include "login.php";
        break;
      case 'account':
        include 'account.php';
        break;
      case 'edit_account':
        if (isset($_POST['capnhap']) && ($_POST['capnhap'])) {
          $username = $_POST['username'];
          $password = $_POST['password'];
          $name = $_POST['name'];
          $address = $_POST['address'];
          $phone = $_POST['phone'];
          $email = $_POST['email'];
          $file = $_FILES['img']['name'];
          $id_user = $_POST['id_user'];
          $target_dir = "./upload/";
          $target_file = $target_dir . basename($_FILES['img']["name"]);
          if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
            // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
          } else {
            // echo "Sorry, there was an error uploading your file.";
          }
          update_taikhoan($id_user, $username, $password, $name, $address, $phone, $email, $file);
          $_SESSION['user'] = check_user($username, $password); // sau khi edit xong thi edit lai $_SESSION['user'] moi
          // header("location:index.php?act=edit_taikhoan");

          $tb = "Edit account sucsess!";
        }
        include "edit_account.php";
        break;
      case 'forgot_password':
        if (isset($_POST['send_email']) && ($_POST['send_email'])) {
          $email = $_POST['email'];
          $check_email =  check_email($email);
          if (is_array($check_email)) {
            $tbao = "Your password is:" . $check_email['password'];
          } else {
            $tbao = "Email no have!";
          }
        }
        include 'forgot-password.php';
        break;
      case 'log_out':
        session_unset();
        header('Location:?act=login');
        break;
      default:
        include_once("user/home/index.php");
        break;
    }
  } else {
    include_once("user/home/index.php");
  }
  // Footer
  include_once("_footer.php");
  ?>

