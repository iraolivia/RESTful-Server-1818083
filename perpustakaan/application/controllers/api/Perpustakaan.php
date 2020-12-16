<?php 
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Perpustakaan extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Perpustakaan_model','perpustakaan');
    }

    public function index_get()
    {
        
        $id_pengunjung->get('id_pengunjung');
        if ($id_pengunjung === null) {
            $perpustakaan = $this->perpustakaan->getPerpustakaan();
        } else {
            $perpustakaan = $this->perpustakaan->getPerpustakaan($id_pengunjung); 
        }
        
        if($perpustakaan){
            $this->response([
                'status' => true,
                'data' => $perpustakaan
            ], REST_Controller::HTTP_OK);
           } else {
            $this->response([
                'status' => false,
                'message' => 'id not found'
            ], REST_Controller::HTTP_NOT_FOUND);
           }
    }

    public function index_delete ()
    {
        $id_pengunjung = $this->delete(id_pengunjung);

        if ($id_pengunjung === null) {
            $this->response([
                'status' => false,
                'message' => 'provide an id!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->perpustakaan->deletePerpustakaan($id_pengunjung) > 0){
                //ok
                $this->response([
                    'status' => true,
                    'id' => $id_pengunjung,
                    'message' => 'deleted.'
                ], REST_Controller::HTTP_NO_CONTENT);
            } else {
                //id not found
                $this->response([
                    'status' => false,
                    'message' => 'id not found'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function index_post ()
    {
        $data = [
            'nama_pengunjung' => $this->post('nama_pengunjung'),
            'alamat_pengunjung' => $this->post('alamat_pengunjung'),
            'tanggal_mengunjungi' => $this->post('tanggal_mengunjungi')
        ];

        if ($this->perpustakaan->createPerpustakaan($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'new pengunjung has been created.'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to create new data!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $id_pengunjung = $this->put('id_pengunjung');
        $data = [
            'nama_pengunjung' => $this->put('nama_pengunjung'),
            'alamat_pengunjung' => $this->put('alamat_pengunjung'),
            'tanggal_mengunjungi' => $this->put('tanggal_mengunjungi')
        ];

        if ($this->perpustakaan->updatePerpustakaan($data, $id_pengunjung) > 0) {
            $this->response([
                'status' => true,
                'message' => 'data pengunjung has been updated.'
            ], REST_Controller::HTTP_NO_CONTENT);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to update data!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}