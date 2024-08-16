<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proyek extends CI_Controller {

    private $api_url = "http://127.0.0.1:8080/";

    public function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    public function index() {

        $data['proyek'] = $this->get_data('proyek');
        $data['lokasi'] = $this->get_data('lokasi');


        $this->load->view('index', $data);
    }

    private function get_data($endpoint) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->api_url . $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);
        if(curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
            return false;
        }
        curl_close($ch);

        return json_decode($response, true);
    }

    public function create() {

        $lokasiResponse = $this->get_data('lokasi');
        $data['lokasi'] = $lokasiResponse['data'] ?? [];
        $this->load->view('proyek_form',$data);
    }

    public function store() {
        $postData = $this->input->post();
    
        // Validasi input
        $this->form_validation->set_rules('proyek[namaProyek]', 'Nama Proyek', 'required');
        $this->form_validation->set_rules('proyek[client]', 'Client', 'required');
        $this->form_validation->set_rules('proyek[tglMulai]', 'Tanggal Mulai', 'required');
        $this->form_validation->set_rules('proyek[tglSelesai]', 'Tanggal Selesai', 'required');
        $this->form_validation->set_rules('proyek[pimpinanProyek]', 'Pimpinan Proyek', 'required');
        $this->form_validation->set_rules('proyek[keterangan]', 'Keterangan', 'required');

    
        if ($this->form_validation->run() === FALSE) {
            
            $this->load->view('proyek_form');
        } else {
            
            $proyekData = [
                'namaProyek' => $postData['proyek']['namaProyek'],
                'client' => $postData['proyek']['client'],
                'tglMulai' => $postData['proyek']['tglMulai'],
                'tglSelesai' => $postData['proyek']['tglSelesai'],
                'pimpinanProyek' => $postData['proyek']['pimpinanProyek'],
                'keterangan' => $postData['proyek']['keterangan'],
                'lokasi' => array_map(function($id) {
                    return ['id' => $id];
                }, $postData['lokasi'])
            ];
    

    
            $response = $this->send_post_request('proyek', $proyekData);
    

    
          
            redirect('proyek');
        }
    }
    
    
    
    
    private function send_post_request($endpoint, $data) {
        $ch = curl_init($this->api_url . $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    
        $response = curl_exec($ch);
    
        if(curl_errno($ch)) {
            log_message('error', 'Curl error: ' . curl_error($ch));
            return false;
        }
    
        curl_close($ch);
    
        return json_decode($response, true); 
    }
    

    public function edit($id) {
     
        $proyekResponse = $this->get_data("proyek/{$id}");
        $data['proyek'] = $proyekResponse['data'] ?? [];
    
        $lokasiResponse = $this->get_data('lokasi');
        $data['lokasi'] = $lokasiResponse['data'] ?? [];

        $this->load->view('proyek_edit_form', $data);
    }
    
    
    public function update($id) {
        $postData = $this->input->post();
        
        // Validasi input
        $this->form_validation->set_rules('proyek[namaProyek]', 'Nama Proyek', 'required');
        $this->form_validation->set_rules('proyek[client]', 'Client', 'required');
        $this->form_validation->set_rules('proyek[tglMulai]', 'Tanggal Mulai', 'required');
        $this->form_validation->set_rules('proyek[tglSelesai]', 'Tanggal Selesai', 'required');
        $this->form_validation->set_rules('proyek[pimpinanProyek]', 'Pimpinan Proyek', 'required');
        $this->form_validation->set_rules('proyek[keterangan]', 'Keterangan', 'required');
    
        if ($this->form_validation->run() === FALSE) {
            
            $data['proyek'] = $postData;
            $data['lokasi'] = $this->get_data('lokasi'); 
            $this->load->view('proyek_edit_form', $data);
        } else {
          
            $proyekData = [
                'namaProyek' => $postData['proyek']['namaProyek'],
                'client' => $postData['proyek']['client'],
                'tglMulai' => $postData['proyek']['tglMulai'],
                'tglSelesai' => $postData['proyek']['tglSelesai'],
                'pimpinanProyek' => $postData['proyek']['pimpinanProyek'],
                'keterangan' => $postData['proyek']['keterangan'],
                'lokasi' => array_map(function($id) {
                    return ['id' => $id];
                }, $postData['lokasi'])
            ];

    
            $response = $this->send_put_request("proyek/{$id}", $proyekData);
    
            if ($response) {
                redirect('proyek');
            } else {
                $data['proyek'] = $postData;
                $data['lokasi'] = $this->get_data('lokasi');
                $this->load->view('proyek_edit_form', $data);
            }
        }
    }
    
    

    private function send_put_request($endpoint, $data) {
        $ch = curl_init($this->api_url . $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);
        if(curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
            return false;
        }
        curl_close($ch);

        return $response;
    }
    

    public function delete($id) {
        
        $this->send_delete_request("lokasi/{$id}");
        $this->send_delete_request("proyek/{$id}");

       
        redirect('proyek');
    }

    private function send_delete_request($endpoint) {
        $ch = curl_init($this->api_url . $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

        $response = curl_exec($ch);
        if(curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
            return false;
        }
        curl_close($ch);

        return $response;
    }
}
