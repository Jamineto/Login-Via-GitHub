<?php

require_once 'var.php';

//Callback Verification
if(isset($_GET['code']))
{
    try{

        $op = array(
            'client_id'     => CLIENT_ID,
            'client_secret' => CLIENT_SECRET,
            'code'          => $_GET['code']
        );

        $ch = curl_init();

        if ($ch === false) {
            throw new Exception('Failed to initialize');
        }

        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_POSTFIELDS => json_encode($op)
        ));
        curl_setopt($ch, CURLOPT_URL,"https://github.com/login/oauth/access_token");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
                "client_id=".CLIENT_ID."&client_secret=".CLIENT_SECRET."&code=".$_GET['code']."");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $result = curl_exec($ch);

        curl_close($ch);
        
        if ($result === false) {
            throw new Exception(curl_error($ch), curl_errno($ch));
        }

        parse_str($result,$query);

        if (isset($query['error_description']))
            echo $query['error_description'];
        else
        {
            $url = "https://api.github.com/user?access_token=". $query['access_token'];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Simple API Connect');
            $result = curl_exec($ch);
            $result = json_decode($result);
            session_start();
            $_SESSION['nome']   = $result->login;
            $_SESSION['foto']   = $result->avatar_url;
            $_SESSION['link']   = $result->html_url;
            $_SESSION['token']  = $query['access_token'];
            header('Location: /');
        }

        curl_close($ch);

    } catch(Exception $e) {

        echo $e->getMessage();

    }
}