<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('main');
    }

    private function _get_data_curl($method, $url)
    {
        $curl = curl_init();
        if ($method === "GET") {
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_URL => $url,
                CURLOPT_CONNECTTIMEOUT => 120,
                CURLOPT_CUSTOMREQUEST   => $method,
                CURLOPT_TIMEOUT => 120,
                CURLOPT_MAXREDIRS => 1,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_HTTPHEADER => array('Content-Type:application/json')
            ));
        }
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }

    public function get_json()
    {
        $json = $this->_get_data_curl('GET', 'http://103.226.55.159/json/data_rekrutmen.json');
        $query = json_decode($json, true);
        // echo var_dump($data);
        // die;
        $data   = array();
        $no     = $this->input->post('start', true);
        foreach ($query as $key => $value) {
            foreach ($value as $vl) {
                $no++;
                $UserData = array();
                $UserData[] = "<div align='center'>" . $no . "</div>";
                $UserData[] = $vl['nama'];
                $UserData[] = $vl['nip'];
                $UserData[] = '<div align="center"><div class="btn-group"><a href="' . base_url('main/detail/' . base64_encode($this->encrypt->encode($vl['id']))) . '" class="btn btn-success btn-sm">Detail</a></div></div>';

                $data[] = $UserData;
            }
        }

        $json_data = array(
            "draw"              => $this->input->post('draw', true),
            "recordsTotal"      => $no,
            "recordsFiltered"   => $no,
            "data"              => $data,
        );
        echo json_encode($json_data);
    }

    public function detail($id)
    {
        //decode ID dan cek apakah ID valid
        $id = $this->encrypt->decode(base64_decode($id));
        if (!$id) {
            die('Invalid ID');
        } else {
            $json = $this->_get_data_curl('GET', 'http://103.226.55.159/json/data_rekrutmen.json');
            $data = json_decode($json, true);
            $arr = array();
            foreach ($data as $key => $value) {
                foreach ($value as $vl) {
                    if ($id == $vl['id']) {
                        $arr = $vl;
                    }
                }
            }
        }

        $arr['id'] = base64_encode($this->encrypt->encode($arr['id']));

        $this->load->view('detail', ['arr' => $arr]);
    }

    public function get_atribut($id)
    {
        $id = $this->encrypt->decode(base64_decode($id));
        if (!$id) {
            die('Invalid ID');
        } else {
            $json = $this->_get_data_curl('GET', 'http://103.226.55.159/json/data_attribut.json');
            $query = json_decode($json, true);
            // echo var_dump($query);
            // die;
            $data   = array();
            $no     = $this->input->post('start', true);
            foreach ($query as $key) {
                if ($id == $key['id_pendaftar']) {
                    $no++;
                    $UserData = array();
                    $UserData[] = "<div align='center'>" . $no . "</div>";
                    $UserData[] = $key['jenis_attr'];
                    if ($key['jenis_attr'] == 'url_file') {
                        $UserData[] = '<a href="' . $key['value'] . '" target=_blank>' . $key['value'] . '</a>';
                    } else {
                        if ($key['value'] == '') {
                            $UserData[] = '-Tidak Ada Data-';
                        } else {
                            $UserData[] = $key['value'];
                        }
                    }

                    $data[] = $UserData;
                }
            }

            $json_data = array(
                "draw"              => $this->input->post('draw', true),
                "recordsTotal"      => $no,
                "recordsFiltered"   => $no,
                "data"              => $data,
            );
            echo json_encode($json_data);
        }
    }

    public function form_data($id = false)
    {
        if ($id) {
            $json = $this->_get_data_curl('GET', false, $id);
            $data = json_decode($json, true);
            $arr = array();
            foreach ($data as $key => $value) {
                $arr = $value;
            }
        } else {
            $arr = array();
        }
        $this->load->view('form', array("arr" => array_values($arr)));
    }

    public function post_json($id = '')
    {
        if ($id) {
            $post = $this->_get_data_curl('PUT', array(
                "id" => $id,
                "description" => $this->input->post('description'),
                "image-url" => $this->input->post('image-url')
            ));
        } else {
            $post = $this->_get_data_curl('POST', array(
                "description" => $this->input->post('description'),
                "image-url" => $_FILES['image-url']
            ));
        }
        if ($post) {
            echo $post;
        } else {
            echo 'Gagal CURL';
        }
    }

    public function delete_json()
    {
        $delete = null;
        if ($this->input->post('id')) {
            $delete = $this->_get_data_curl('DELETE', array(
                "id" => $this->input->post('id')
            ));
        }
        if ($delete) {
            echo $delete;
        } else {
            echo 'Gagal';
        }
    }
}
