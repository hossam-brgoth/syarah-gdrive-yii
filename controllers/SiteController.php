<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use Google_Client;

class SiteController extends Controller
{
    private $clientID = '420401711986-1m6fsiqjq4fa90bg3qot18bh4drm4kop.apps.googleusercontent.com';
    private $clientSecret = 'LYeYfgYQ3XCxXL8LonNjKIj8';
    private $redirectUri = 'http://localhost:8888/index.php?r=site%2Ffiles';

    public function actionIndex()
    {
        $client = new Google_Client();
        $client->setClientId($this->clientID);
        $client->setClientSecret($this->clientSecret);
        $client->setRedirectUri($this->redirectUri);
        $client->addScope("email");
        $client->addScope(['https://www.googleapis.com/auth/drive']);
        $client->addScope("profile");

        $result = "<a class='btn btn-primary btn-lg' href='" . $client->createAuthUrl() . "'>Google Login</a>";

        return $this->render('index', ["result" => $result]);
    }

    public function actionFiles()
    {
        $client = new Google_Client();
        $client->setClientId($this->clientID);
        $client->setClientSecret($this->clientSecret);
        $client->setRedirectUri($this->redirectUri);
        $client->addScope("email");
        $client->addScope(['https://www.googleapis.com/auth/drive']);
        $client->addScope("profile");

        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

        $files = $this->get_gdrive_files($token['access_token']);

        return $this->render('files', ["files" => $files]);
    }

    public static function get_gdrive_files($token)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://www.googleapis.com/drive/v2/files",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "authorization: Bearer $token",
                "cache-control: no-cache",
                "postman-token: 6dc517ad-f470-23c3-ea7e-5a3079fc7bea"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return $files = json_decode($response, true);
        }
    }
}
