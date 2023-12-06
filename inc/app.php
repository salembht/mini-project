<?php

use function PHPSTORM_META\type;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function siginin($username,$password ,$connection){
 
    $checkUsername = array(
        "column" => "username",
        "operator" => "=",
        "value" => $username
    );
    $checkPassword = array(
        "column" => "password",
        "operator" => "=",
        "value" => $password
    );
    $where = array();
    $where[] = $checkPassword;
    $where[] = $checkUsername;
    $user = db_select($connection, "users", "*", $where);
    
    if(!empty($user)){
        $_SESSION['isSignedIn'] = true;
        $_SESSION['username']=$username;
        $_SESSION['type']=$user[0]['type'];
        return true;
    }else{
        return false;
    }
}
function isAdmin(){
  
    if(isset ($_SESSION['type'])){
        if($_SESSION['type'] =='admin'){
            return true;
        }else{
            return false;
        }
       
    }
 }
function isSignin(){
    return isset($_SESSION['isSignedIn']);
}
function siginout(){
    session_unset();
    session_destroy();
}

function requestRout(){
    $page_name=$_SERVER['REQUEST_URI'];
    
    $page_name=str_replace(ROOT_PATH,"",$page_name);
    $page_name=DeleteLastSlash($page_name);

    if($page_name==""){
        $page_name='home';
    }

    return $page_name;
}
function DeleteLastSlash($string)
{
    if (substr($string, -1) === '/') {
        $string = substr_replace($string, "", -1);
    }
    return $string;
}
function fileExntion($file){
    return pathinfo($file, PATHINFO_EXTENSION);
}
function renamefile($file){
 $originalFileName = $file['name'];
 $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
 if(isset($_SESSION['username'])){
    return 'salem_' . time() . '.' . $fileExtension;
 }else {
    return 'request' . time() . '.' . $fileExtension;
 }
}
function HandleFileUpload($file, $directory = "")
{
    $path = BASE_PATH;
    
    // @TODO 
    $path .= $directory ;
    $uploadPath = $path .'/'. renamefile($file);

    // Check if file is a valid upload
    if (!is_uploaded_file($file['tmp_name'])) {
        return false; //"Invalid file upload.";
    }

    // Check if the target directory exists, create it if necessary
    if (!file_exists($path)) {
        mkdir($path, 0755, true);
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
        return true; // "File uploaded successfully.";
    } else {
        return false; // "File upload failed.";
    }
}
function db_connect($servername, $username, $password, $dbname){

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        //die("Connection failed: " . mysqli_connect_error());
        return array("status" => "error", "code" => 401, "message" => mysqli_connect_error());
    }

    return $conn;
}

function db_close($conn){

    try{
        mysqli_close($conn);
    } catch(Exception $e){
        return array("status" => "error", "code" => 402, "message" => $e->getMessage());
    }
}

// function db_execute_query($conn, $sql){
//     try{
//         $result = mysqli_query($conn, $sql);
//     }catch(Exception $e) {
//         return array("status" => "error", "code" => 403, "message" => $e->getMessage());
//     }
//     return $result;
// }
function db_execute_query($conn, $sql){
    try {
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            throw new Exception(mysqli_error($conn));
        }
    } catch (Exception $e) {
        return array("status" => "error", "code" => 403, "message" => $e->getMessage());
    }
    
    return $result;
}

function db_select($conn, $table, $columns = "*", $where = ""  ){

    if (is_array($columns)) {
        $columns = implode(", ", $columns);
    }

    $sql = "SELECT $columns FROM $table";

    if (is_array($where) && !empty($where)) {
        $whereClause = _buildWhereClause($conn, $where);
        $sql .= " WHERE $whereClause";
        
    }
    else if (!empty($where)) {
        $sql .= " WHERE $where";
    }
    
    try{
        $result = db_execute_query($conn, $sql);
        // print_r($result);
    }catch(Exception $e){
        return array("status" => "error", "code" => 404, "message" => $e->getMessage());
    }

    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function db_insert($conn, $table, $data){

    $columns = implode(", ", array_keys($data));
    $values = "'" . implode("', '", array_values($data)) . "'";

    $sql = "INSERT INTO $table ($columns) VALUES ($values)";

    db_execute_query($conn, $sql);

    $result = mysqli_insert_id($conn);
    if(!$result){
        return array("status" => "error", "code" => 405, "message" => mysqli_error($conn));
    }
    return $result;
}

function db_update($conn, $table, $data, $where){

    $set = "";

    foreach ($data as $column => $value) {
        $set .= "$column = '$value', ";
    }

    $set = rtrim($set, ", ");

    $sql = "UPDATE $table SET $set";
    if (is_array($where) && !empty($where)) {
        $whereClause = _buildWhereClause($conn, $where);
        $sql .= " WHERE $whereClause";
    }
    else if (!empty($where)) {
        $sql .= " WHERE $where";
    }

    try{
        $result = db_execute_query($conn, $sql);
        return $result;
    }catch(Exception $e){
        return array("status" => "error", "code" => 406, "message" => $e->getMessage());
    }
}

function db_delete($conn, $table, $where){

    $sql = "DELETE FROM $table";
    if (is_array($where) && !empty($where)) {
        $whereClause = _buildWhereClause($conn, $where);
        $sql .= " WHERE $whereClause";
    }
    else if (!empty($where)) {
        $sql .= " WHERE $where";
    }
    $result = db_execute_query($conn, $sql);

    if(!$result){
        return array("status" => "error", "code" => 407, "message" => mysqli_error($conn));
    }

    return $result;
}

function _escapeValue($conn, $value) {
    return mysqli_real_escape_string($conn, $value);
}

function _buildWhereClause($conn, $where) {

    $conditions = [];

    foreach ($where as $condition) {
        $column = _escapeValue($conn, $condition['column']);
        $operator = _escapeValue($conn, $condition['operator']);
        $value = _escapeValue($conn, $condition['value']);
        $conditions[] = "$column $operator '$value'";
    }

    $out = implode(" AND ", $conditions);
    return $out;
}
