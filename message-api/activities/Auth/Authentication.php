<?php

namespace Activities\Auth;
use Activities\Admin\Admin;
use Database\Database;
class Authentication
{
    protected function redirect($url)
    {
        header("Location: " . trim(CURRENT_DOMAIN, '/ ') . '/' . trim($url, '/ '));
        exit;
    }
    public function logout()
    {
        if (isset($_SESSION['admin_id_s'])) {
            unset($_SESSION['admin_id_s']);
            session_destroy();
        }
        $this->redirect('register');
    }
    public function checkAdmin()
    {
        if (isset($_SESSION['admin_id_s'])) {
            $db = new Database();
            $user = $db->select("SELECT * FROM admins WHERE id = ?", [$_SESSION['admin_id_s']])->fetch();
            if ($user != null) {
                if ($user['type'] != 'admin') {
                    $this->redirect('register');
                }
            } else {
                $this->redirect('register');
            }
        } else {
            $this->redirect('register');
        }
    }
    public function login()
    {
         require_once BASE_PATH . '/template/auth/login.php';
    }
    public function storeLogin($request)
    {
        
        if (empty($request['email']) || empty($request['password'])) {
            flash('login_error', 'تمامی فیلد ها الزامی میباشند');
            $this->redirect('login');
        } else {
                $db = new Database();
                $user = $db->select('SELECT * FROM admins WHERE `email` = ?', [$request['email']])->fetch();
                if($user != null){
                    if(password_verify($request['password'], $user['password']) && $request['email'] == $user['email']){ 
                        $_SESSION['admin_id_s'] = $user['id'];
                        $this->redirect('admin/content/message');
                    }else {
                        flash('login_error', 'رمز عبور یا ایمیل نامعتبر است');
                        $this->redirect('login');
                    }
                }else {
                    flash('login_error', 'رمز عبور یا ایمیل نامعتبر است');
                    $this->redirect('login');
                }   
        }
    }
}