<?php
require_once __DIR__ . '/../vendor/autoload.php';
$dataBase=new \Illuminate\Database\Capsule\Manager();
$services = include('config/config.php');
$dataBase->addConnection([
    "driver"=>'mysql',
    "host"=>'db_mysql',
    "database"=>'base',
    "username"=>'doctor',
    "password"=>'pass4doctor',
]);
$dataBase->bootEloquent();
$prefix = "vily/";
$max_length_Url = 10;
echo '*******************' . PHP_EOL;
echo 'Hi. Start of program...' . PHP_EOL;
echo 'Choose form of DB system among available list:'. PHP_EOL;
$last=array_key_last($services);
foreach ($services as $key=>$value)
{
    if($value===$services[$last]){
        echo $key.'.';
    }else{
        echo $key.',';}
}
echo PHP_EOL;
echo 'Choose your option: ';
$option=readline();
$container =new Container($services);
echo 'Write what do you want to do with your URL' . PHP_EOL;
try{
    $open_db=$container->get($option);
    $url_array=$open_db->getArrayOfUrl();
    $action = trim(strtolower(readline('CODE or DECODE: ')), ' ');
    switch ($action) {
        case 'code':
            $code = trim(readline('Enter long URL in format https://....   '), " \n");
            if (!trim($code, ' ')) {
                echo 'Empty field, enter Long URL' . PHP_EOL;
            } else {
                if (str_contains($code, "https://$prefix")) {
                    echo 'Incorrect long URL, probably you entered short URL, check it please' . PHP_EOL;
                } else {
                    $check_in_DB_presence_url = new CheckUrl();
                    $position_url_in_array = $check_in_DB_presence_url->search($url_array, $code);
                    if ($position_url_in_array >= 0) {
                        echo 'Short URL exists for this site in our DB, here it is:' . PHP_EOL;
                        echo $url_array[$position_url_in_array - 1].PHP_EOL;
                    } elseif ($position_url_in_array === -1) {
                        echo 'Short URL not exists in our DB. We are checking what we could do......' . PHP_EOL;
                        try {
                            $new_short_url = new Enter();
                            $new_short_url->setter($prefix, $max_length_Url);
                            $value_new_short_url = $new_short_url->encode($code);
                            $full_short_url = "https://" . $prefix . $value_new_short_url . PHP_EOL;
                            $url_array[] = $full_short_url;
                            echo 'New generated short URL: ' . $full_short_url;
                        } catch (Exception $e) {
                            echo $e->getMessage();
                            exit('Exit of program' . PHP_EOL);
                        }
                        $url_array[] = $code . PHP_EOL;
                        try {
                            $check_exist_in_web = new Exist($code);
                            if ($check_exist_in_web->exist($code)) {
                                echo "The site exists in Web. Server response: " . $check_exist_in_web->exist($code) . PHP_EOL;
                            };
                        } catch (Exception $e) {
                            echo $e->getMessage();
                        }

                        $write_file_with_url = $open_db->saveNewUrl($url_array);
                    }
                    break;
                }
            }
            break;
        case 'decode':
            $decode = trim(readline('Enter sort URL in format https://....    '), " \n");
            if (!trim($decode, ' ')) {
                echo 'Empty field, enter Short URL' . PHP_EOL;
            } else {
                if (str_contains($decode, "https://$prefix")) {
                    try {
                        $validate_short = new OutPut();
                    } catch (Exception $e) {
                        echo $e->getMessage();
                        exit('Exit of program' . PHP_EOL);
                    }
                    $validate_short->setter($url_array);
                    echo 'Long URL: ' . $validate_short->decode($decode) . "which correspond to short ULR: $decode" . PHP_EOL;
                } else {
                    echo 'Incorrect short URL, maybe you entered Long URL' . PHP_EOL;
                }

            }
            break;
        default:
            echo 'We do not understand your request, make sure you provide correct info, choose CODE or DECODE' . PHP_EOL;
    }
    echo 'Finish of program.' . PHP_EOL;
    echo '*******************' . PHP_EOL;
}catch (NotFoundServiceException $e) {
    echo $e->getMessage();
};

