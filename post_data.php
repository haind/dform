<?php
/*
1. Check token
2. Check email format
3. Based on token, find the newsletters id to subscribe to
4. Subscribe newletter
*/
header('Access-Control-Allow-Origin: *');
$_POST['msg'] = "<p>Hi <b>" . $_POST['email'] . '</b>,</p>';
$_POST['msg'] .= '<p>You have been subscribed successfully following newsletters from Hear the music:
<ul><li>Newsletter 1</li><li>Newsletter 2</li></ul></p>
<p>We will send you the newsletter weekly or as soon as we have any updates</p>
';
print json_encode($_POST);
