<?php
if (isset($_SESSION['allowed_menu']) && is_array($_SESSION['allowed_menu'])) {
    $allowed_menu = $_SESSION['allowed_menu'];
    if (!in_array(67, $allowed_menu)) {
        header('Location: ' . $path_um . 'index.php');
        exit();
    }
} else {
    header('Location: ' . $path_um . 'login.php');
    exit();
}
