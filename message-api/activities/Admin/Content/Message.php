<?php

namespace Activities\Admin\Content;

use Activities\Admin\Admin;
use Database\Database;


class Message extends Admin
{
    public function index()
    {
        $db = new Database();
        //$messages = $db->select("select m.*,a.first_name,a.last_name from messages m LEFT JOIN admins a ON m.admin_id = a.id")->fetchAll();
        $admin=$_SESSION['admin_id_s'];
        $messages = $db->select('select m.*,a.first_name,a.last_name from messages m LEFT JOIN admins a ON m.admin_id = a.id WHERE `admin_id` = ?', [$admin])->fetchAll();
        //dd($messages);
        //dd($_SESSION['admin_id_s']);
        require_once BASE_PATH . '/template/admin/content/message/index.php';
    }
    
    public function create()
    {
        require_once BASE_PATH . '/template/admin/content/message/create.php';
    }

    public function store($request)
    {
        
        $db = new Database();
        $request['admin_id']=$_SESSION['admin_id_s'];
        if (empty($request['text']) || empty($_SESSION['admin_id_s'])){
            $this->redirectBack();
        }
        $db->insert('messages', array_keys($request), $request);
        $this->redirect('admin/content/message');
    }

    public function delete($id)
    {
        $db = new Database();
        $messages = $db->select("SELECT * FROM `messages` WHERE id = ?", [$id])->fetch();
        if($_SESSION['admin_id_s'] == $messages['admin_id']){
        $db->delete('messages', $id);
        }
        $this->redirectBack();
    }

    public function sendApi($id)
    {
        $db = new Database();
        $messages = $db->select("SELECT * FROM `messages` WHERE id = ?", [$id])->fetch();
        $sending=$messages['text'];
        $data = json_encode(['message' => $sending]);
        
        $apiUrl = 'http://localhost/message-api/api_endpoint.php';

        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($ch);
        curl_close($ch);
        //echo $response;

        if ($response !== false) {
            $decodedResponse = json_decode($response, true);        
            if ($decodedResponse && $decodedResponse['status'] === 'success') {
                $randomNumber = $decodedResponse['random_number'];
                //$inputMessage = $decodedResponse['input_message'];
                $request=array('random'=>$randomNumber);
                $db->update('messages', $id, array_keys($request), $request);
                $this->redirect('admin/content/message');
            } else {
                //testing
                echo "خطا: " . $decodedResponse['message'];
            }
        } else {
            //testing
            echo "خطا در دریافت پاسخ از سرور";
        }
    }
}
