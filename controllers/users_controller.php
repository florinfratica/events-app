<?php

class UsersController
{
    public function index()
    {
        // Allow access only for admins
        if (!isset($_SESSION['auth_id']) || $_SESSION['auth']['admin'] != 'Y') {
            redirect();
        }
        $users = User::all();
        require_once 'views/users/index.php';
    }

    public function create()
    {
        $fields = ['username', 'password', 'confirm_password', 'email', 'first_name', 'last_name'];
        $old = $errors = array_fill_keys($fields, null);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            foreach ($_POST as $field => $value) {
                if (array_key_exists($field, $old)) {
                    $old[$field] = trim($value);
                }
            }
            $errors['username'] = field_is_empty($old['username']) ?: $errors['username'];
            $errors['username'] = User::countWhere('username', $old['username']) > 0 ? field_in_database() : $errors['username'];
            $errors['password'] = field_is_empty($old['password']) ?: $errors['password'];
            if (!$errors['password']) {
                $errors['confirm_password'] = fields_dont_match($old['confirm_password'], $old['password']) ?: $errors['confirm_password'];
                $errors['confirm_password'] = field_is_empty($old['confirm_password']) ?: $errors['confirm_password'];
            }
            $errors['email'] = field_is_empty($old['email']) ?: $errors['email'];
            $errors['email'] = field_isnt_email($old['email']) ?: $errors['email'];
            $errors['email'] = User::countWhere('email', $old['email']) > 0 ? field_in_database() : $errors['email'];
            $errors['first_name'] = field_is_empty($old['first_name']) ?: $errors['first_name'];
            $errors['last_name'] = field_is_empty($old['last_name']) ?: $errors['last_name'];
            if (form_is_valid($errors)) {
                User::insert($old);
                $_SESSION['flash'] = ['class' => 'success', 'message' => 'Contul tău a fost creat cu succes. Acum te poți conecta în aplicație.'];
                redirect();
            }
        }
        require_once 'views/users/create.php';
    }

    public function update()
    {
        // Allow access only for admins and require id
        if (!isset($_SESSION['auth_id']) || $_SESSION['auth']['admin'] != 'Y' || !isset($_GET['id'])) {
            redirect();
        }
        $fields = ['admin', 'speaker'];
        $errors = array_fill_keys($fields, null);
        $old = User::find($_GET['id']);
        if (!$old) {
            redirect('?page=users&action=index');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $old['admin'] = $old['speaker'] = 'N';
            foreach ($_POST as $field => $value) {
                if (array_key_exists($field, $old)) {
                    $old[$field] = trim($value);
                }
            }
            if (form_is_valid($errors)) {
                User::update_roles($old);
                $_SESSION['flash'] = ['class' => 'success', 'message' => 'Rolurile utilizatorului au fost editate cu succes.'];
                redirect('?page=users&action=index');
            }
        }
        require_once 'views/users/update.php';
    }

    public function profile()
    {
        // Allow access only for users
        if (!isset($_SESSION['auth_id'])) {
            redirect();
        }
        $fields = ['job_title', 'avatar'];
        $errors = array_fill_keys($fields, null);
        $old = User::find($_SESSION['auth_id']);
        $user_avatar = $old['avatar'];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            foreach ($_POST as $field => $value) {
                if (array_key_exists($field, $old)) {
                    $old[$field] = trim($value);
                }
            }
            $old['avatar'] = $_FILES['avatar']['tmp_name'];
            $errors['avatar'] = image_size($old['avatar'], 200, 200) ?: $errors['avatar'];
            $errors['avatar'] = file_not_image($old['avatar']) ?: $errors['avatar'];
            if (form_is_valid($errors)) {
                if (file_exists($old['avatar'])) {
                    $temp = explode(".", $_FILES["avatar"]["name"]);
                    $new_file_name = round(microtime(true)) . '.' . end($temp);
                    move_uploaded_file($old['avatar'], ROOT . "/uploads/avatars/$new_file_name");
                    unset($old['avatar']);
                    $old['avatar'] = $new_file_name;
                } else {
                    $old['avatar'] = $user_avatar;
                }
                User::update_profile($old);
                $_SESSION['flash'] = ['class' => 'success', 'message' => 'Profilul tău a fost actualizat cu succes.'];
                redirect('?page=users&action=profile');
            }
        }
        require_once 'views/users/profile.php';
    }

    public function login()
    {
        $fields = ['username', 'password'];
        $old = $errors = array_fill_keys($fields, null);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            foreach ($_POST as $field => $value) {
                if (array_key_exists($field, $old)) {
                    $old[$field] = trim($value);
                }
            }
            $auth_id = User::authenticate($old);
            if ($auth_id) {
                $_SESSION['auth_id'] = $auth_id;
                $_SESSION['auth'] = User::find($auth_id);
            } else {
                $_SESSION['flash'] = ['class' => 'danger', 'message' => 'Datele de conectare introduse de tine nu sunt valide.'];
            }
            redirect();
        } else {
            call('pages', 'error');
        }
    }

    public function logout()
    {
        unset($_SESSION['auth_id'], $_SESSION['auth']);
        redirect();
    }

}
