<?php
# Usage: php bridge.php 'user@example.com' 'exampleusername' 'userpassword'
# Returns json: {'status': 'success', 'data': { user object }}
# Returns json: {'status': 'failure', 'data': ['error messages']

define('IN_MYBB', NULL);
require_once 'global.php';
require_once MYBB_ROOT.'inc/functions_user.php';
require_once MYBB_ROOT.'/inc/datahandlers/user.php';

$userhandler = new UserDataHandler('insert');
$userhandler->set_data(array(
    'email' => $argv[1],      #    String  Email address
    'email2' => $argv[1],     #    String  Email address confirmation
    'username' => $argv[2],   #    String  Name of the new user
    'password' => $argv[3],   #    String  Password of the user
    'password2' => $argv[3],  #    String  Password confirmation
    'usergroup' => 2,         #    Integer Number  ID of the primary user group
    'displaygroup' => 2,      #    Integer Number  Display group ID
    'regdate' => time(),      #    Integer Number  Timestamp of the date, when the user registered
));

if ($userhandler->validate_user()) {
    echo json_encode(array('status'=>'success', 'data'=>$userhandler->insert_user()));
}
else {
    echo json_encode(array('status'=>'failure', 'data'=>$userhandler->get_friendly_errors()));
}


?>
