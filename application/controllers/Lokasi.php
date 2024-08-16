<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasi extends CI_Controller {

    private $api_url = "http://127.0.0.1:8080/";

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    private function get_data($endpoint) {
        $ch = curl_init($this->api_url . $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $response = curl_exec($ch);
    
        if(curl_errno($ch)) {
            log_message('error', 'Curl error: ' . curl_error($ch));
            return false;
        }
    
        curl_close($ch);
    
        return json_decode($response, true);
    }
    

    public function create() {
        $lokasiResponse = $this->get_data('lokasi');
        $data['lokasi'] = $lokasiResponse['data'] ?? [];
        $this->load->view('lokasi_form',$data);
    }

    public function store() {
        $postData = $this->input->post();
        
        //validasi
        $this->form_validation->set_rules('lokasi[namaLokasi]', 'Nama Lokasi', 'required');
        $this->form_validation->set_rules('lokasi[negara]', 'Negara', 'required');
        $this->form_validation->set_rules('lokasi[provinsi]', 'provinsi', 'required');
        $this->form_validation->set_rules('lokasi[kota]', 'kota', 'required');
    
        if ($this->form_validation->run() === FALSE) {
            
            $this->load->view('lokasi_form');
        } else {
            
            $lokasiData = [
                'namaLokasi' => $postData['lokasi']['namaLokasi'],
                'negara' => $postData['lokasi']['negara'],
                'provinsi' => $postData['lokasi']['provinsi'],
                'kota' => $postData['lokasi']['kota']
            ];
        
            $response = $this->send_post_request('lokasi', $lokasiData);

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
        $lokasiResponse = $this->get_data("lokasi/{$id}");
        $data['lokasi'] = $lokasiResponse['data'] ?? [];
        
        $this->load->view('lokasi_edit_form', $data);
    }
    
    
    public function update($id) {
        $postData = $this->input->post();
        
        // Validasi input
        $this->form_validation->set_rules('lokasi[namaLokasi]', 'Nama Lokasi', 'required');
        $this->form_validation->set_rules('lokasi[negara]', 'Negara', 'required');
        $this->form_validation->set_rules('lokasi[provinsi]', 'provinsi', 'required');
        $this->form_validation->set_rules('lokasi[kota]', 'kota', 'required');
    
        if ($this->form_validation->run() === FALSE) {
           
            $data['lokasi'] = $postData;
            $this->load->view('lokasi_edit_form', $data);
        } else {

            $lokasiData = [
                'namaLokasi' => $postData['lokasi']['namaLokasi'],
                'negara' => $postData['lokasi']['negara'],
                'provinsi' => $postData['lokasi']['provinsi'],
                'kota' => $postData['lokasi']['kota']
            ];
    
            $response = $this->send_put_request("lokasi/{$id}", $lokasiData);
    
            if ($response) {
                redirect('proyek');
            } else {
                $data['lokasi'] = $postData;
                $this->load->view('lokasi_edit_form', $data);
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



?>