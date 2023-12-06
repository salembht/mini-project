<?php
define('ROOT_PATH', '/mini-project/');
define('BASE_PATH', __DIR__);


require_once('inc/app.php');

$db_server = "localhost";
$db_user = "root";
$db_user_pass = "";
$db_name = "ekhabarina";
$connection = db_connect($db_server, $db_user, $db_user_pass, $db_name);

$posts;

function  getposts($type = "*", $id = null)
{
    global $connection;
    $idfind = array(
        "column" => "id",
        "operator" => "=",
        "value" => $id
    );
    $typefind = array(
        "column" => "catogry",
        "operator" => "=",
        "value" => $type
    );
   
    $where = array();
   
   
    // $where[] = $checkUsername;
    if ($type == "*" && $id == null) {
        return db_select($connection, "posts" );
    } else if ($type == "*" && $id != null) {
        $where[] = $idfind;
        return db_select($connection, "posts", "*", $where);
    } else if ($type !== "*") {
        $where[] = $typefind;
        return db_select($connection, "posts", "*", $where);
    }
}
function getusers($type = "*")
{
    global $connection;
    $typefind = array(
        "column" => "catogry",
        "operator" => "=",
        "value" => $type
    );
    $where = array();
    $where[] = $typefind;
    if ($type == "*") {
        return db_select($connection, 'users');
    } else if ($type !== "*") {
        return db_select($connection, "users", "*", $where);
    }
}
function getrequstes($id = null)
{
    global $connection;
    $idfind = array(
        "column" => "id",
        "operator" => "=",
        "value" => $id
    );
    $where = array();
    $where[] = $idfind;
    if ($id == null) {
        return db_select($connection, 'request');
    } else {
        return db_select($connection, 'request', "*", $where);
    }
}
$page_name = requestRout();
if ($_SERVER['REQUEST_METHOD'] === "POST" || $_SERVER['REQUEST_METHOD'] === "GET") {

    if ($page_name == 'signin') {
        if (isSignin()) {
            header("Location: " . ROOT_PATH);
            exit;
        } else if (isset($_POST['username']) && isset($_POST['password'])) {
            if (siginin($_POST['username'], $_POST['password'], $connection)) {
                // Redirect to /
                header("Location: " . ROOT_PATH);
                exit;
            }
        }
    } else if ($page_name == 'signup') {
        if (isset($_POST['username'])) {
            $user_name = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $file = $_FILES['cv'];

            $data = array(
                "username" => $user_name,
                "email" => $email,
                "password" => $password,
                "cv" => renamefile($file)
            );
            if (isset($_FILES["cv"])) {
                $file = $_FILES["cv"];
                $directory = "/assets/cvs";
                HandleFileUpload($file, $directory);
            }
            db_insert($connection, "request", $data);
        }
    } else if ($page_name == "post") {
        if (!isSignin()) {
            header("Location: " . ROOT_PATH . 'signin');
            exit;
        } else {
            if (isset($_POST['title'])) {
                $title = $_POST['title'];
                $content = $_POST['content'];
                $catogry = $_POST['catogry'];
                $file = $_FILES['postimage'];

                $data = array(
                    "title" => $title,
                    "content" => $content,
                    "catogry" => $catogry,
                    "imagepath" => renamefile($file),
                    "author" => $_SESSION['username']
                );
                if (isset($_FILES["postimage"])) {
                    $file = $_FILES["postimage"];
                    $directory = "/assets/image";
                    HandleFileUpload($file, $directory);
                }
                db_insert($connection, "posts", $data);
            }
        }
    } else if (str_starts_with($page_name, 'dashboard')) {
        if(!isAdmin() ){
            header("Location: " . ROOT_PATH . 'signin');
            exit;
        }
            $page_name = 'dashboard/' . explode('/', $page_name)[1];
            if ($page_name == "dashboard/home") {
                if (isset($_POST['delete'])) {
                    $takeid = array(
                        "column" => "id",
                        "operator" => "=",
                        "value" => $_POST['delete']
                    );
                    $where = array();
                    $where[] = $takeid;
                    db_delete($connection, 'posts', $where);
                }
            }
            if ($page_name == "dashboard/users") {
                if (isset($_POST['delete'])) {
                    $takeid = array(
                        "column" => "id",
                        "operator" => "=",
                        "value" => $_POST['delete']
                    );
                    $where = array();
                    $where[] = $takeid;
                    db_delete($connection, 'users', $where);
                }
                if (isset($_POST['update'])) {
                    $checkid = array(
                        "column" => "id",
                        "operator" => "=",
                        "value" => $_POST['update']
                    );
                    $data = array(
                        "username" => $_POST['username'],
                        "password" => $_POST['password']
                    );
                    $where = array();
                    $where[] = $checkid;
                    db_update($connection, "users", $data, $where);
                }
            }
            if ($page_name == "dashboard/request") {
                if (isset($_POST['delete'])) {
                    $takeid = array(
                        "column" => "id",
                        "operator" => "=",
                        "value" => $_POST['delete']
                    );
                    $where = array();
                    $where[] = $takeid;
                    db_delete($connection, 'request', $where);
                }
                if (isset($_POST['accept'])) {
                    $requstdata = getrequstes($_POST['accept'])[0];
                    //    print_r($requstdata);
                    $data = array(
                        "username" => $requstdata['username'],
                        "email" => $requstdata['email'],
                        "password" => $requstdata['password'],
                        "type" => 'author'
                    );
                    db_insert($connection, "users", $data);
                    $takeid = array(
                        "column" => "id",
                        "operator" => "=",
                        "value" => $_POST['accept']
                    );
                    $where = array();
                    $where[] = $takeid;
                    db_delete($connection, 'request', $where);
                }
            }
       
    }
    if (isset($_GET['type'])) {
        $posts = getposts($_GET['type']);
    } else {
        $posts = getposts();
    }
}

if ($page_name == "signout") {
    siginout();
    // Redirect to /
    header("Location: " . ROOT_PATH);
    exit;
}
if ($page_name == "home" && !isset($_POST['type'])) {
    $posts = getposts();
}
function rturenpost()
{
    global $posts;
    return $posts;
}
if (str_contains($page_name, '?')) {
    $page_name = explode('?', $page_name)[0];
}
// if(isAdmin()){
//     $page_name='dashboard/home';
// }
$filePath = 'pages/' . $page_name . '.php';

if (file_exists($filePath)) {
    require_once('layout/header.php');
    if (str_starts_with($page_name, 'dashboard')) {
        require_once('pages/dashboard/container.php');
    }
    require_once($filePath);
    require_once('layout/footer.php');
} else {
    require_once('layout/header.php');
    require_once('pages/notfound.php');
    require_once('layout/footer.php');
}
