<?php

define('CLIENT_ID',"d1eef707a6568ef48440");
define('CLIENT_SECRET',"25117acf19e012ed8053f94e42993980f4c06862");

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
            throw new Exception('failed to initialize');
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
        if ($result === false) {
            throw new Exception(curl_error($ch), curl_errno($ch));
        }
        parse_str($result,$query);
        if (isset($query['error_description']))
            echo $query['error_description'];
        else
        {
            var_dump($query);
            $url = "https://api.github.com/user?access_token=". $query['access_token'];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Jamineto');
            $result = curl_exec($ch);
            var_dump(json_decode($result));
            //"Authorization: token OAUTH-TOKEN"
        }
        //access_token
        curl_close($ch);

    } catch(Exception $e) {

        echo $e->getMessage();
        echo PHP_VERSION;
        echo PHP_EOL;
    }
}
    
else
    echo "Code não encontrado";

    // object(stdClass)[1]
    // public 'login' => string 'Jamineto' (length=8)
    // public 'id' => int 44280061
    // public 'node_id' => string 'MDQ6VXNlcjQ0MjgwMDYx' (length=20)
    // public 'avatar_url' => string 'https://avatars1.githubusercontent.com/u/44280061?v=4' (length=53)
    // public 'gravatar_id' => string '' (length=0)
    // public 'url' => string 'https://api.github.com/users/Jamineto' (length=37)
    // public 'html_url' => string 'https://github.com/Jamineto' (length=27)
    // public 'followers_url' => string 'https://api.github.com/users/Jamineto/followers' (length=47)
    // public 'following_url' => string 'https://api.github.com/users/Jamineto/following{/other_user}' (length=60)
    // public 'gists_url' => string 'https://api.github.com/users/Jamineto/gists{/gist_id}' (length=53)
    // public 'starred_url' => string 'https://api.github.com/users/Jamineto/starred{/owner}{/repo}' (length=60)
    // public 'subscriptions_url' => string 'https://api.github.com/users/Jamineto/subscriptions' (length=51)
    // public 'organizations_url' => string 'https://api.github.com/users/Jamineto/orgs' (length=42)
    // public 'repos_url' => string 'https://api.github.com/users/Jamineto/repos' (length=43)
    // public 'events_url' => string 'https://api.github.com/users/Jamineto/events{/privacy}' (length=54)
    // public 'received_events_url' => string 'https://api.github.com/users/Jamineto/received_events' (length=53)
    // public 'type' => string 'User' (length=4)
    // public 'site_admin' => boolean false
    // public 'name' => string 'jnt0' (length=4)
    // public 'company' => null
    // public 'blog' => string '' (length=0)
    // public 'location' => null
    // public 'email' => null
    // public 'hireable' => null
    // public 'bio' => null
    // public 'twitter_username' => string 'eiijamil' (length=8)
    // public 'public_repos' => int 1
    // public 'public_gists' => int 0
    // public 'followers' => int 0
    // public 'following' => int 0
    // public 'created_at' => string '2018-10-19T00:57:04Z' (length=20)
    // public 'updated_at' => string '2020-09-15T10:24:45Z' (length=20)