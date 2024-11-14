<?php

namespace Activities\Auth;
use Database\Database;
class Register
{
    protected function redirectBack()
    {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
    private function hash($password)
    {
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        return $hashPassword;
    }
    public function register()
    {
         require_once BASE_PATH . '/template/auth/register.php';
    }
    protected function redirect($url)
    {
        header("Location: " . trim(CURRENT_DOMAIN, '/ ') . '/' . trim($url, '/ '));
        exit;
    }
    public function storeRegister($request) {
        if (empty($request['first_name']) || empty($request['last_name']) || empty($request['email']) || empty($request['password'])) {
            flash('register_error', 'تمامی فیلد ها الزامی میباشند');
            $this->redirectBack();
        } 
        $db = new Database();
        $admins = $db->select('SELECT * FROM admins WHERE email = ?', [$request['email']])->fetch();
        if($admins != null){
            flash('register_error', 'ایمیل وارد شده تکراری میباشد');
            $this->redirectBack();
        }
        else{
            if(true) {
                $request['password'] = $this->hash($request['password']);
                $db->insert('admins', array_keys($request), $request);
                $user = $db->select('SELECT * FROM admins WHERE `email` = ?', [$request['email']])->fetch();
                $_SESSION['admin_id_s'] = $user['id'];
                $this->redirect('admin/content/message');
            } 
            else {
            flash('register_error', 'فرایند ارسال ایمیل با خطا مواجه شد');
            $this->redirectBack();
            }
        }
    }

}