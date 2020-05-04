/**
 * Function called when 'Login' button is pressed.
 * The browser will be redirected to the login.php page.
*/
function login() {
    var root = window.top.location.href.split('taskboard')[0];
    window.top.location.replace(root + 'taskboard/header/login.php');
}

/**
 * Function called when 'Register' button is pressed.
 * The browser will be redirected to the register.php page.
*/
function register() {
    var root = window.location.href.split('taskboard')[0];
    window.top.location.replace(root + 'taskboard/header/register.php');
}

function logout() {
    var root = window.location.href.split('taskboard')[0];
    window.top.location.replace(root + 'taskboard/header/logout.php');
}
