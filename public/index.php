<?php
session_start();
require_once '../config/config.php';
require_once '../src/db.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Admin routes
if (strpos($page, 'admin') === 0) {
    if ($page === 'admin_login_form') {
        include '../templates/admin/login.php';
        exit();
    }

    if ($page === 'admin_login') {
        include '../src/admin/login.php';
        exit();
    }

    if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
        header('Location: index.php?page=admin_login_form');
        exit();
    }
}

switch ($page) {
    // Admin
    case 'admin_dashboard':
        include '../templates/admin/dashboard.php';
        break;
    case 'admin_add_playlist':
        include '../src/admin/add_playlist.php';
        break;
    case 'admin_edit_playlist':
        include '../templates/admin/edit_playlist.php';
        break;
    case 'admin_update_playlist':
        include '../src/admin/update_playlist.php';
        break;
    case 'admin_delete_playlist':
        include '../src/admin/delete_playlist.php';
        break;
    case 'admin_manage_playlist':
        include '../templates/admin/manage_playlist.php';
        break;
    case 'admin_add_playlist_item':
        include '../src/admin/add_playlist_item.php';
        break;
    case 'admin_delete_playlist_item':
        include '../src/admin/delete_playlist_item.php';
        break;

    // User Management
    case 'register':
        include '../templates/register.php';
        break;
    case 'register_user':
        include '../src/register_user.php';
        break;
    case 'login':
        include '../templates/login.php';
        break;
    case 'login_user':
        include '../src/login_user.php';
        break;
    case 'logout':
        include '../src/logout.php';
        break;

    // Public
    case 'playlist':
        include '../templates/playlist.php';
        break;
    default:
        include '../templates/home.php';
        break;
}
?>