<?php
//var_dump($_SERVER);
session_start();
if(!empty($_POST['email']) && !empty($_POST['token'])) {
  include('post_data.php');
  die; 
}
$path = $_SERVER['SCRIPT_NAME'];
$path = substr($path, 0, strrpos($path, "/"));
$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
$url = $protocol . $_SERVER['HTTP_HOST'] . $path;
$url_post = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

header('Content-Type: application/javascript');
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$json_data = trim(file_get_contents('form1.json')); //will get from DB later
$json_data = preg_replace( "/\r|\n/", "", $json_data );

$rules = array(
  "rules" => array(
    'email' => array('required' => true, 'email'=>true),
    'name' => array('required' => true)    
  ),
  "messages" => array(
    'email' => array('required' => 'Bitte geben Sie Ihre E-Mail.', 'email'=>'Must be in email format'),
    'name' => array('required' => 'Bitte geben Sie Ihre Name.'),
  ),
);

$rules = json_encode($rules);

if(empty($_SESSION['token'])) {
  $_SESSION['token'] = md5(time());
}
$token = $_SESSION['token']; 

echo <<<OEF
document.write('<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>');
document.write('<script type="text/javascript" src="$url/dist/jquery.dform-1.1.0.min.js"></script>');
document.write('<script type="text/javascript" src="$url/dist/jquery.validate.min.js"></script>');
document.write('<script type="text/javascript" src="$url/dist/jquery.form.min.js"></script>');
document.write('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">');
document.write('<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>');

document.write('<form id="demo-1-form"><input type="hidden" name="token" value="$token"></form>');
document.write('<script type="text/javascript" class="demo" id="demo-1">$(function(){ $("#demo-1-form").dform($json_data);});$("#demo-1-form").validate($rules); $("#demo-1-form").ajaxForm({ url:"$url_post", "type":"POST",  success:function(data) { data=JSON.parse(data); $(".modal-body").html(data.msg); $("#myModal").modal();} });</script>');
document.write('<div id="myModal" class="modal fade"> <div class="modal-dialog"> <div class="modal-content"> <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> <h4 class="modal-title">Subscribing Newsletter</h4> </div> <div class="modal-body"> <p></p> </div> </div> </div></div>');

document.write('Build form successfully.');
OEF;
?>
