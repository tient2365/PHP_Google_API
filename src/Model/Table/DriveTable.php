<?php
namespace App\Model\Table;

use Cake\ORM\Locator\TableLocator;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Firebase\JWT\JWT;
use Cake\ORM\Rule\IsUnique;
use Cake\Datasource\ConnectionManager;
use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use Google\Http\MediaFileUpload;
use Google_Client;
use Google_Service_Oauth2;
use Cake\Mailer\Email;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'D:\Website_Project\CakePhP\google_drive_api\vendor\phpmailer\phpmailer\src\Exception.php';
require 'D:\Website_Project\CakePhP\google_drive_api\vendor\phpmailer\phpmailer\src\PHPMailer.php';
require 'D:\Website_Project\CakePhP\google_drive_api\vendor\phpmailer\phpmailer\src\SMTP.php';
session_start();

/**
 * Assign Model
 *
 * @property \App\Model\Table\DeviceTable&\Cake\ORM\Association\BelongsTo $Devices
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\MachineStatusesTable&\Cake\ORM\Association\BelongsTo $MachineStatuses
 *
 * @method \App\Model\Entity\Assign get($primaryKey, $options = [])
 * @method \App\Model\Entity\Assign newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Assign[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Assign|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Assign saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Assign patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Assign[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Assign findOrCreate($search, callable $callback = null, $options = [])
 */
class DriveTable extends Table
{
    const TABLE_NAME = 'google_drive_token';
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */

    public function initialize(array $config)
    {
        parent::initialize($config);
//        $connection = ConnectionManager::get(env('DB_DATABASE', 'timesheet_device'));

        $this->setTable(env('DB_DATABASE', 'tien_google_drive_api') . '.' . self::TABLE_NAME);
        $this->setDisplayField('id');

        $this->setPrimaryKey('id');
    }



    public function authUrl()
    {
        $client = new Client();
        $client->setApplicationName('Google Drive API PHP Quickstart');
        $client->setScopes([
            Drive::DRIVE, 
            'https://www.googleapis.com/auth/plus.login',
            'https://www.googleapis.com/auth/userinfo.email', 
            'https://www.googleapis.com/auth/userinfo.profile', 
            'https://www.googleapis.com/auth/plus.me'
        ]);
        $client->setAuthConfig(__DIR__.'/client_secret.json');
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');
        $authUrl = $client->createAuthUrl();
        
        return $client;
    }
    public function Connect($client)
    {
        if(isset($_GET['code']))
        {
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            $client->setAccessToken($token);
            $user_info = $client->verifyIdToken();
            $new_token = $this->newEntity();

            $new_token->given_name = $user_info['given_name'];
            $new_token->family_name = $user_info['family_name'];
            $new_token->email = $user_info['email'];
            $new_token->scope = $token['scope'];
            $new_token->expires_in = $token['expires_in'];
            $new_token->token_type = $token['token_type'];
            $new_token->access_token = $token['access_token'];
            $new_token->refresh_token = $token['refresh_token'];
            $new_token->created = $token['created'];
            
            if($this->save($new_token))
            {
                $this->Access_Token($client);
                return $new_token;
            }
        }
    }

    public function Access_Token($client)
    {
        $get_token = $this->find()->where(['active' => 1])->last();
        if(!empty($get_token))
        {
            $token = [
                'scope' => $get_token['scope'],
                'expires_in' => $get_token['expires_in'],
                'token_type' => $get_token['token_type'],
                'access_token' => $get_token['access_token'],
                'refresh_token' => $get_token['refresh_token'],
                'created' => $get_token['created'],
            ];
            $client->setAccessToken($token);
            return $get_token;
        }
    }

    public function Upload($client = [], $images = [])
    {
        $folder_id = '12V_GWYUBotkzJCb4TD1OI0dP_lXHAZNx';
        $driveService = new Drive($client);
        $id_images =[];
        $content = null;
        foreach($images as $key => $image)
        {
            $content = file_get_contents($image['tmp_name']);
            $fileMetadata = new Drive\DriveFile(array(
                'name' => $image['name'],
                'parents' => array($folder_id)
                ));
                
            $file = $driveService->files->create($fileMetadata, array([
                'data' => $content,
                'mimeType' => 'image/jpeg',
                'uploadType' => 'multipart',
                'fields' => 'id',
            ]));
            $id_images[]=$file->id;
        }
        return $id_images;
    }
    public function Gmail()
    {
        $Email = new Email('gmail');
        $Email->setEmailFormat('html'); 
        $Email->setTo('tientphp2001@gmail.com');
        $Email->setSubject('Testing the emails');
        
        $Email->setViewVars(array('first_name'=>'John Doe' ));//variable will be replaced from template
        // dd($Email);
        $Email->send('Hi did you receive the mail');
    }
    public function SendEmail()
    {
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                        //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'tient2365@gmail.com';                     //SMTP username
        $mail->Password   = 'tlfifvwizfxciues';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ),
            'tls' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );    
        //Recipients
        $mail->setFrom('tient2365@gmail.com', 'Mailer');
        $mail->addAddress('tientphp2001@gmail.com', 'Joe User');     //Add a recipient
        $mail->addAddress('tientphp2001@gmail.com');               //Name is optional
        $mail->addReplyTo('tient2365@gmail.com', 'Information');

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';

        $mail->send();
    }

}