<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main_model extends CI_Model {


	public function add_user_details($data){
		if(!empty($data)){
			if(isset($_POST['user_id'])){ 
				$this->db->where('user_id',$_POST['user_id']);
				$this->db->update('user_tbl',$data);
				return true;
			}else{
				$this->db->insert('user_tbl',$data);
				return true;
			}
			
		}else{
			return false;
		}
	}

	public function get_user_details(){
		$data=array();
		$res=$this->db->query("SELECT * FROM user_tbl where status=1");
		foreach ($res->result_array() as $key => $value) {
			$data[$value['user_id']]=$value['user_name'];
		}
		return $data;
	}

	public function get_user_all_details(){
		$data=array();
		$cond="";
		if(isset($_GET['id'])){
			$cond=" and user_id=".$_GET['id'];
		}
		$res=$this->db->query("SELECT * FROM user_tbl where status=1 $cond");
		if($res->num_rows()>0){
			$data=$res->result_array();
		}
		return $data;
	}

	public function add_item_details($data){
		if(!empty($data)){
			if(isset($_POST['item_id'])){ 
				$this->db->where('item_id',$_POST['item_id']);
				$this->db->update('item_tbl',$data);
				return true;
			}else{
				$this->db->insert('item_tbl',$data);
				return true;
			}
		}else{
			return false;
		}
	}

	public function get_expense_details(){
		$data=array();
		$cond="";
		if(isset($_GET['id'])){
			$cond=" AND  i.item_id=".$_GET['id'];
		}
		$first_day_this_month = date('01-m-Y'); // hard-coded '01' for first day
		$last_day_this_month  = date('t-m-Y');
		$first_day_this_month=date('Y-m-d',strtotime($first_day_this_month));
		$last_day_this_month=date('Y-m-d',strtotime($last_day_this_month));	
		$res=$this->db->query("SELECT i.*,u.user_name FROM item_tbl i,user_tbl u WHERE i.status=1 and u.status=1 and i.user_id=u.user_id $cond AND i.created_date between '$first_day_this_month' AND '$last_day_this_month'");
		if($res->num_rows()>0){
			$data=$res->result_array();
		}
		return $data;
	}
}