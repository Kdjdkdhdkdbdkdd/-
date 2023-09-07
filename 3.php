<?php
date_default_timezone_set("Asia/Baghdad");
if (file_exists('madeline.php')){
    require_once 'madeline.php';
}
define('MADELINE_BRANCH', 'deprecated');
function bot($method, $datas = []){
    $token = file_get_contents("token");
    $url = "https://api.telegram.org/bot$token/" . $method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $res = curl_exec($ch);
    curl_close($ch);
    return json_decode($res, true);
}
$settings = (new \danog\MadelineProto\Settings\AppInfo) ->setApiId(13167118) ->setApiHash('6927e2eb3bfcd393358f0996811441fd');
$MadelineProto = new \danog\MadelineProto\API('3.madeline',$settings);
$MadelineProto->start();
$x= 0;
do{
    $info = json_decode(file_get_contents('in.json'),true);
$info["loop3"] = $x;
file_put_contents('in.json', json_encode($info));
$users = explode("\n",file_get_contents("u3"));
foreach($users as $user){
    $kd = strlen($user);
    if($user != ""){
    try{$MadelineProto->messages->getPeerDialogs(['peers' => [$user]]);
        $x++;
    }catch (\danog\MadelineProto\Exception | \danog\MadelineProto\RPCErrorException $e) {
                try{$MadelineProto->account->updateUsername(['username'=>$user]);
                    $videoLink = 'https://telegra.ph/file/af31cfdaa06f90868a714.mp4';
                    $caption="ᴛᴇᴀᴍ ꜱᴘᴇᴇᴅ ꫝ 🔱 ! \n - - - - - - - - - - \n ᴜsᴇʀ ⚚ -> @$user \n ᴄʟɪᴄᴋѕ𐇵 -> ❲ $x ❳ \n 𝚂𝙰𝚅𝙴🝡 -> ❲ ᵀᵁᴿᴮᴼ ᶠᴸᴼᴼᴰ ᴮᴼᵀ𖥂 ❳ ⚠️\n - - - - - - - - - - \n 𝒌𝒊𝒏𝒈𝒔🜎 🔰 -> @Y_Y_a - @Turbo_ismax 🏅";
                    bot('sendVideo', ['chat_id' => file_get_contents("ID"), 'video' => $videoLink, 'caption' => $caption,]);
                    $data = str_replace("\n".$user,"", file_get_contents("u3"));
                    file_put_contents("u3", $data);
                }catch(Exception $e){
                    echo $e->getMessage();
                    if($e->getMessage() == "USERNAME_INVALID"){
                        bot('sendMessage', ['chat_id' => file_get_contents("ID"), 'text' => "𝐍𝐮𝐦𝐛𝐞𝐫 #3 🛎\n𝐃𝐞𝐥𝐞𝐭𝐞𝐝 ❲ @$user ❳",]);
                        $data = str_replace("\n".$user,"", file_get_contents("u3"));
                        file_put_contents("u3", $data);
                    }elseif($e->getMessage() == "This peer is not present in the internal peer database"){

                    }elseif($e->getMessage() == "USERNAME_OCCUPIED"){
                        bot('sendMessage', ['chat_id' => file_get_contents("ID"), 'text' => "𝐒𝐨𝐫𝐫𝐲 #3 🛎\n𝐅𝐥𝐨𝐨𝐝 1500 » ❲ @$user ❳",]);
                        $data = str_replace("\n".$user,"", file_get_contents("u3"));
                        file_put_contents("u3", $data);
                    }else{
                        bot('sendMessage', ['chat_id' => file_get_contents("ID"), 'text' =>  "3 • Error @$user ".$e->getMessage()]);
                         $data = str_replace("\n".$user,"", file_get_contents("u3"));
                        file_put_contents("u3", $data);
                    }     
                }
            }
        } 
    }
  }while(1);
