<?php
namespace App\Controller;

use App\Controller\AppController;
use Google\Client;
use Google\Service\Drive;

/**
 * Google Controller
 *
 *
 * @method \App\Model\Entity\Google[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GoogleController extends AppController
{
    /**
     * @return void
     */

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');

        $this->m_drive = $this->loadModel('Drive');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $upload = null;
        $query = $this->request->getQuery();
        $client = $this->m_drive->authUrl();
        $connect = $this->m_drive->Access_Token($client);
        // $send_email = $this->m_drive->SendEmail();
        $send_email = $this->m_drive->Gmail();
        if(empty($connect))
        {
            $connect = $this->m_drive->Connect($client);
        }
        else
        {
            if($this->request->is('post'))
            {
                $get_data = $this->request->getData();
                $upload = $this->m_drive->Upload($client, $get_data['images']);
            }
        }
        $this->set(compact('connect', 'client', 'upload'));
        $this->set('query', !empty($query) ? $query : '');
    }
}