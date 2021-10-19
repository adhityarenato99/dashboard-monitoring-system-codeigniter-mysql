<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tests extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Tests_model','test_m');
	}

	public function index()
	{
		$this->load->helper('url');
		$this->load->helper('form');
		
        /*
		$countries = $this->test_m->get_list_countries();

		$opt = array('' => 'All Country');
		foreach ($countries as $country) {
			$opt[$country] = $country;
		}

		$data['form_country'] = form_dropdown('',$opt,'','id="country" class="form-control"'); 
		$this->load->view('test_m_view', $data); */
        $this->load->view('test_view');
	}

	public function ajax_list()
	{
		$list = $this->test_m->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $test_m) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $test_m->callId;
			$row[] = $test_m->coachId;
			$row[] = $test_m->clientId;
			$row[] = $test_m->ts;
			$row[] = $test_m->ets;

            $end = strtotime($test_m->ets);
            $start = strtotime($test_m->ts);
            $minutes = round(abs($end - $start) / 60,2);
            $duration = $minutes;
            //$duration = 'testing';
            $row[] = $duration;

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->test_m->count_all(),
						"recordsFiltered" => $this->test_m->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

    public function get_data($rowno=0) {
        
        //$config['base_url'] = site_url('Tests/get_data');

        $filter_coach = $this->input->post('filter_coach');

        if ($filter_coach == 1) {
            $filter_coach = 'coach1';
        } else if ($filter_coach == 2) {
            $filter_coach = 'coach2';
        }

        /*
        $this->db->select('*');
        $this->db->from('tbl_calls');
        $this->db->like('coachId', $filter_coach);
        $allcount = $this->db->get()->num_rows();

        $this->db->select('*');
        $this->db->from('tbl_calls');
        $this->db->like('coachId', ) */

        // === get TOTAL DATA 
        $this->db->select('COUNT(callId) AS total');
        $this->db->from('tbl_calls');
        $this->db->where('coachId', $filter_coach);
        $this->db->where('ets !=', null);
        $get_data = $this->db->get()->result_array();

        foreach($get_data AS $row) {
            $total_data = $row['total'];
        }
        // ====================

        // === get TOTAL CLIENT
        $this->db->select('COUNT(DISTINCT(clientId)) AS client');
        $this->db->from('tbl_calls');
        $this->db->where('coachId', $filter_coach);
        $get_client = $this->db->get()->result_array();

        foreach($get_client AS $row) {
            $total_client = $row['client'];
        }
        // ====================

        // === get TOTAL HOURS FOR CALLS
        $this->db->select('SUM(TIMEDIFF(ets, ts))/3600 AS hours');
        $this->db->from('tbl_calls');
        $this->db->where('coachId', $filter_coach);
        $get_hours = $this->db->get()->result_array();

        foreach($get_hours AS $row) {
            $total_hour = $row['hours'];
        }

        $data['all_data'] = $total_data;
        $data['total_client'] = $total_client;
        $data['total_hour'] = $total_hour;
        echo json_encode($data);
    }

    public function get_chart_initial() {
        $coach_graph = $this->input->post('coach_graph');

        // Testing only
        $query = $this->db->query("SELECT count(callid) as total_call, callid, coachid, clientid, ts as tgl_call, ets FROM tbl_calls WHERE coachId = '$coach_graph' AND ets IS NOT NULL GROUP BY DATE(ts) ORDER BY DATE(ts) ASC");

        $data['total'] = $query;
        $data['total_call'] = array_column($query->result(), 'total_call');
        $data['tgl_call'] = array_column($query->result(), 'tgl_call');

        echo json_encode($data, JSON_NUMERIC_CHECK);
        
    }

    public function get_chart() {
        $coach_graph = $this->input->post('coach_graph');
        $time_graph = $this->input->post('time_graph');

        // filtering by coach
        if ($coach_graph == 1) {
            $coach_graph = 'coach1';

            if ($time_graph == 1) {
                $query = $this->db->query("SELECT count(callid) as total_call, callid, coachid, clientid, ts as tgl_call, ets FROM tbl_calls WHERE coachId = '$coach_graph' AND ets IS NOT NULL GROUP BY DATE(ts) ORDER BY DATE(ts) ASC");
            } else if ($time_graph == 2) {
                $query = $this->db->query("SELECT count(callid) as total_call, callid, coachid, clientid, ts as tgl_call, ets FROM tbl_calls WHERE coachId = '$coach_graph' AND ets IS NOT NULL GROUP BY WEEK(ts) ORDER BY WEEK(ts) ASC");
            } else if ($time_graph == 3) {
                $query = $this->db->query("SELECT count(callid) as total_call, callid, coachid, clientid, ts as tgl_call, ets FROM tbl_calls WHERE coachId = '$coach_graph' AND ets IS NOT NULL GROUP BY MONTH(ts) ORDER BY MONTH(ts) ASC");
            } 

        } else if ($coach_graph == 2) {
            $coach_graph = 'coach2';

            if ($time_graph == 1) {
                $query = $this->db->query("SELECT count(callid) as total_call, callid, coachid, clientid, ts as tgl_call, ets FROM tbl_calls WHERE coachId = '$coach_graph' AND ets IS NOT NULL GROUP BY DATE(ts) ORDER BY DATE(ts) ASC");
            } else if ($time_graph == 2) {
                $query = $this->db->query("SELECT count(callid) as total_call, callid, coachid, clientid, ts as tgl_call, ets FROM tbl_calls WHERE coachId = '$coach_graph' AND ets IS NOT NULL GROUP BY WEEK(ts) ORDER BY WEEK(ts) ASC");
            } else if ($time_graph == 3) {
                $query = $this->db->query("SELECT count(callid) as total_call, callid, coachid, clientid, ts as tgl_call, ets FROM tbl_calls WHERE coachId = '$coach_graph' AND ets IS NOT NULL GROUP BY MONTH(ts) ORDER BY MONTH(ts) ASC");
            } 

        }

        // Testing only
        //$query = $this->db->query("SELECT count(callid) as total_call, callid, coachid, clientid, ts as tgl_call, ets FROM tbl_calls WHERE coachId = '$coach_graph' AND ets IS NOT NULL GROUP BY DATE(ts) ORDER BY DATE(ts) ASC");

        $data['total'] = $query;
        $data['total_call'] = array_column($query->result(), 'total_call');
        $data['tgl_call'] = array_column($query->result(), 'tgl_call');

        echo json_encode($data, JSON_NUMERIC_CHECK);
        
    }
}