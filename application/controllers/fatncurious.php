<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fatncurious extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('fatncurious_model_user');
		$this->load->model('fatncurious_model_kartu_kredit');
		$this->load->model('fatncurious_model_restaurant');
		$this->load->model('fatncurious_model_promo');
		$this->load->model('fatncurious_model_registerLogin');
		$this->load->model('fatncurious_model_menu');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('table');
		$this->load->library('form_validation');
		$this->load->helper('cookie');
		$this->load->library('session');
		$this->load->library('pagination');
	}
	//==========REGISTER============
	public function register(){
		if(isset($_SESSION['nama'])){
			$data['nama'] = $_SESSION['nama'];
		}
		if($this->input->post('btnRegister')){
			$this->form_validation->set_rules('txtEmailRegister','Email','callback_cekRegisterKosong');
			if($this->form_validation->run())
			{
				$this->form_validation->set_rules('txtEmailLogin','Email','callback_cekEmailAdaRegister');
				if($this->form_validation->run())
				{
					
					$data['kodeJU'] = 'JU002';
					$data['nama'] = $this->input->post('txtNamaRegister');
					$data['alamat'] =' '; //$this->input->post('txtAlamatRegister');
					$data['noTelp'] = $this->input->post('txtNoTelpRegister');
					//$data['tgl'] = $this->input->post('txtTglRegister');
					
					$simpanTgl = explode("/",$this->input->post('txtTglRegister'));
					//echo $simpanTgl[0].' '.$simpanTgl[1].' '.$simpanTgl[2];
					$data['tgl'] = $simpanTgl[2].'-'.$simpanTgl[0].'-'.$simpanTgl[1];
					$data['email'] = $this->input->post('txtEmailRegister');
					$data['password'] = $this->input->post('txtPasswordRegister');
					$data['report'] = 0;
					$data['ket'] = '';
					$this->fatncurious_model_registerLogin->insert($data['kodeJU'],$data['nama'],$data['alamat'],$data['noTelp'],$data['tgl'],$data['email'],$data['password'],$data['report'],$data['ket']);
					
					$data['user']='';
					$data['user'] = $this->fatncurious_model_registerLogin->select('user');
					//$this->load->view('fatncurious');
					redirect('fatncurious/index/Register_berhasil');
				}
				else
				{
					$data['user']='';
					$data['user'] = $this->fatncurious_model_registerLogin->select('user');
					redirect('fatncurious/index/Email_sudah_terpakai');
				}
				
			}
			else
			{
				$data['user']='';
				$data['user'] = $this->fatncurious_model_registerLogin->select('user');
				redirect('fatncurious/index/ada_data_yang_kosong');
			}
		}
		
	}
	//==========REGISTER============
	
	//===========VALIDASI REGISTER============
	public function cekRegisterKosong()
	{
		if($this->input->post('txtEmailRegister') == '' || $this->input->post('txtPasswordRegister') == '' || $this->input->post('txtNamaRegister') == '' || $this->input->post('txtTglRegister') == '' || $this->input->post('txtNoTelpRegister') == '')
		{
			$this->form_validation->set_message('cekRegisterKosong','Semua Field Wajib Diisi');
			return false;
		}
		else
		{
			return true;
		}
	}
	public function cekEmailAdaRegister($email)
	{
		$passwordd = $this->input->post('txtEmailRegister');
		$user = $this->fatncurious_model_registerLogin->search($email);
		$nemu=false;
		
		if($user)
		{
			$nemu=true;
		}
		if($nemu==true)
		{
			$this->form_validation->set_message('cekUsernameAdaRegister','Username sudah terpakai');
			return false;
		}
		else
		{
			return true;
		}
	}
	//===========VALIDASI REGISTER============
	
	//==========LOGIN============
	public function login(){
		if(isset($_SESSION['nama'])){
			$data['nama'] = $_SESSION['nama'];
		}
		if($this->input->post('btnLogin')){
			$this->form_validation->set_rules('txtEmailLogin','Email','callback_cekLoginKosong');
			if($this->form_validation->run())
			{
				$this->form_validation->set_rules('txtEmailLogin','Email','callback_cekEmailAdaLogin');
				if($this->form_validation->run())
				{
					$user = $this->fatncurious_model_user->selectUserByEmail($this->input->post('txtEmailLogin'));
					$this->session->set_userdata('userYangLogin',$user);
					redirect("fatncurious/index/login_Berhasil");
				}
				else
				{
					redirect('fatncurious/index/login_error');
				}
				
			}
			else
			{
				redirect('fatncurious/index/login_error');
			}
		}
		
	}
	//==========LOGIN============
	
	//==========================VALIDASI  Login=========================
	public function cekLoginKosong()
	{
		if($this->input->post('txtEmailLogin') == '' || $this->input->post('txtPasswordLogin') == '' )
		{
			$this->form_validation->set_message('cekLoginKosong','Semua Field Wajib Diisi');
			return false;
		}
		else
		{
			return true;
		}
	}
	
	public function cekEmailAdaLogin($email)
	{
		$passwordd = $this->input->post('txtPasswordLogin');
		$emaill = $this->fatncurious_model_registerLogin->search($email);
		$nemu=false;
		
		if($email)
		{
			$nemu=true;
		}
		if($nemu==true)
		{
			if($passwordd == $emaill->PASSWORD)
			{
				return true;
			}
			else
			{
				$this->form_validation->set_message('cekEmailAdaLogin','Password Salah');
				return false;
			}
		}
		else
		{
			$this->form_validation->set_message('cekEmailAdaLogin','Email tidak ditemukan');
			return false;
		}
		
	}
	//==========================VALIDASI Login=========================

	//==========================INDEX=========================
	public function index($adaError = null)
	{
		$data = [];
		if($this->session->userdata('userYangLogin')){
			$data['kodeUser'] = $this->session->userdata('userYangLogin');
		}
		if($adaError == null){
			if(isset($_SESSION['nama'])){
				$data['nama'] = $_SESSION['nama'];
			}
			$this->load->view('fastncurious',$data);
		}
		else{
			$data['adaError']=$adaError;
			$this->load->view('fastncurious',$data);
			//echo $adaError;
		}
	}
	//==========================INDEX=========================
	
	//================Profil================
	public function profilRestoran($kode)
	{
		//echo $this->session->userdata('userYangLogin')->KODE_USER;
		if($this->session->userdata('userYangLogin')){
			$pemilik = false;
			$kodeUser = $this->session->userdata('userYangLogin')->KODE_USER;
			$data['kodeResto'] = $this->fatncurious_model_restaurant->selectRestoByUser($kodeUser); 
			foreach($data['kodeResto'] as $resto){
				if($resto->KODE_RESTORAN == $kode){
					$pemilik=true;
				}
			}
			$jenisUser = $this->fatncurious_model_user->selectJenisUserByKode($kodeUser);
			if($jenisUser->KODE_JENISUSER == 'JU003' && $pemilik==true){
				$data['menu'] = $this->fatncurious_model_menu->selectMenuByResto($kode);		
				$data['resto'] = $this->fatncurious_model_restaurant->selectRestoByKlik($kode);
				$data['active1'] = '';
				$data['active2'] = '';
				$data['active3'] = 'active';
				$data['active4'] = '';
				$data['active5'] = '';
				if($data['resto']->STATUS == 0){
					$data['resto']->STATUS = 'Tutup';
				}
				else if($data['resto']->STATUS == 1){
					$data['resto']->STATUS = 'Buka';
				}
				//echo 'masuk 1';
				$this->load->view('profileRestoran',$data);
			}
			else{
				$data['promo'] = $this->fatncurious_model_restaurant->selectBiggestPromo($kode);
				//$data['menu'] = $this->fatncurious_model_menu->selectMenuByResto($kode);		
				$data['resto'] = $this->fatncurious_model_restaurant->selectRestoByKlik($kode);
				$data['active1'] = 'active';
				$data['active2'] = '';
				$data['active3'] = '';
				$data['active4'] = '';
				
				$rating = $this->fatncurious_model_restaurant->selectJumlahRatingRestoUser($kode,$kodeUser);
				if($rating==null){
					for($i=1;$i<=5;$i++){
						$data['glyphicon'.$i] = 'glyphicon-star-empty';
					}
				}
				else{
					for($i=1;$i<=5;$i++){
						if(($rating->JUMLAH_RATING) - $i >= 0){
							$data['glyphicon'.$i] = 'glyphicon-star';
						}
						else{
							$data['glyphicon'.$i] = 'glyphicon-star-empty';
						}
					}
				}
				
				
				
				if($data['resto']->STATUS == 0){
					$data['resto']->STATUS = 'Tutup';
				}
				else if($data['resto']->STATUS == 1){
					$data['resto']->STATUS = 'Buka';
				}
				//echo 'masuk 2';
				$this->load->view('restoran',$data);
			}
		}
		else{
			$data['promo'] = $this->fatncurious_model_restaurant->selectBiggestPromo($kode);
			//$data['menu'] = $this->fatncurious_model_menu->selectMenuByResto($kode);		
			$data['resto'] = $this->fatncurious_model_restaurant->selectRestoByKlik($kode);
			$data['active1'] = 'active';
			$data['active2'] = '';
			$data['active3'] = '';
			$data['active4'] = '';
			
			for($i=1;$i<=5;$i++){
				$data['glyphicon'.$i] = 'glyphicon-star-empty';
			}
			if($data['resto']->STATUS == 0){
				$data['resto']->STATUS = 'Tutup';
			}
			else if($data['resto']->STATUS == 1){
				$data['resto']->STATUS = 'Buka';
			}
			//echo 'masuk 3';
			$this->load->view('restoran',$data);
		}
	}
	
	public function profilUser()
	{
		if($this->session->userdata('userYangLogin')){
			$kodeUser = $this->session->userdata('userYangLogin')->KODE_USER;
			$data['user'] = $this->fatncurious_model_user->SEARCH($kodeUser);
			//echo $kodeUser;
			$this->load->view('profileUser',$data);
		}
		
	}
	
	public function LogOut()
	{
		if($this->session->userdata('userYangLogin')){
			$this->session->set_userdata('userYangLogin','');
			redirect('fatncurious');
		}
		
	}
	
	public function gantiPassProfilUser(){
		if($this->session->userdata('userYangLogin')){
			if($this->input->post('txtNewPassword') == $this->input->post('txtConfirmNewPassword')){
				$user = $this->fatncurious_model_user->SEARCH($this->session->userdata('userYangLogin')->KODE_USER);
				if($this->input->post('txtOldPassword') == $user->PASSWORD){
					$kode = $user->KODE_USER;
					$kodeJU = $user->KODE_JENISUSER;
					$nama = $user->NAMA_USER;
					$alamat = $user->ALAMAT_USER;
					$telp = $user->NOR_TELEPON_USER;
					$tgl = $user->TANGGAL_LAHIR_USER;
					$pos = $user->KODE_POS_USER;
					$email = $user->EMAIL_USER;
					$pass = $this->input->post('txtNewPassword');
					$report = $user->JUMLAH_REPORT_USER;
					$ket = $user->KETERANGAN_USER;
					$this->fatncurious_model_user->UPDATE($kode,$kodeJU,$nama,$alamat,$telp,$tgl,$pos,$email,$pass,$report,$ket);
					redirect('fatncurious/index/update_berhasil');
				}
				else{
					redirect('fatncurious/index/update_gagal');
				}
				
			}
			else{
				redirect('fatncurious/index/update_error');
			}
		}
		
	}
	public function updateProfilUser(){
		if($this->session->userdata('userYangLogin')){
			$kodeUser = $this->session->userdata('userYangLogin')->KODE_USER;
			$user = $this->fatncurious_model_user->SEARCH($kodeUser);
			$kode = $user->KODE_USER;
			$kodeJU = $user->KODE_JENISUSER;
			$nama = $this->input->post('txtRestoran');
			$alamat = $this->input->post('txtJalan');
			$telp = $this->input->post('txtNoTelp');
			$tgl = $user->TANGGAL_LAHIR_USER;
			$pos = $user->KODE_POS_USER;
			$email = $user->EMAIL_USER;
			$pass = $user->PASSWORD;
			$report = $user->JUMLAH_REPORT_USER;
			$ket = $user->KETERANGAN_USER;
			$aff=$this->fatncurious_model_user->UPDATE($kode,$kodeJU,$nama,$alamat,$telp,$tgl,$pos,$email,$pass,$report,$ket);
			redirect('fatncurious/index/update_berhasil');
		}
		else{
			redirect('fatncurious/index/belum_login');
		}
	}
	//================Profil================
	
	//================Filter BY================
	public function filterByPromo()
	{
		$data['promo'] = $this->fatncurious_model_promo->selectBiggestPromo();
		$this->load->view('filterByPromo',$data);
	}
	public function filterByRestoran()
	{
		$data['resto'] = $this->fatncurious_model_restaurant->selectSemuaResto(5,0);
		$config = array();
		$config['base_url'] = site_url('fatncurious/PaginationFilterByRestoran');
		$config["per_page"] = 5;
		$config["uri_segment"] = 3;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link']=false;
		$config['last_link']=false;
		$config['cur_tag_open'] = '<li> <a href="http://localhost/fatncurious/index.php/fatncurious/PaginationFilterByRestoran" data-ci-pagination-page="2"><strong>';
		$config['cur_tag_close'] = '</strong></a></li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$config['total_rows'] = sizeof($this->fatncurious_model_restaurant->selectSemuaResto(null,null));
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links();
		
		$this->load->view('filterByRestoran',$data);
	}
	public function filterByKartu()
	{
		$data['kartu'] = $this->fatncurious_model_restaurant->selectBiggestKredit(5,0);
		$config = array();
		$config['base_url'] = site_url('fatncurious/PaginationFilterByKartu');
		$config["per_page"] = 5;
		$config["uri_segment"] = 3;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link']=false;
		$config['last_link']=false;
		$config['cur_tag_open'] = '<li> <a href="http://localhost/fatncurious/index.php/fatncurious/PaginationFilterByKartu" data-ci-pagination-page="2"><strong>';
		$config['cur_tag_close'] = '</strong></a></li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$config['total_rows'] = sizeof($this->fatncurious_model_restaurant->selectBiggestKredit(null,null));
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links();
		$this->load->view('filterByKredit',$data);
	}
	public function filterByMenu()
	{
		$data['menu'] = $this->fatncurious_model_menu->selectMenu(5,0);
		
		$config = array();
		$config['base_url'] = site_url('fatncurious/PaginationFilterByMenu');
		$config["per_page"] = 5;
		$config["uri_segment"] = 3;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link']=false;
		$config['last_link']=false;
		$config['cur_tag_open'] = '<li> <a href="http://localhost/fatncurious/index.php/fatncurious/PaginationFilterByMenu" data-ci-pagination-page="2"><strong>';
		$config['cur_tag_close'] = '</strong></a></li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$config['total_rows'] = sizeof($this->fatncurious_model_menu->selectMenu(null,null));
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links();
		$this->load->view('filterByMenu',$data);
	}
	//================Filter BY================
	
	//================Sorted BY================
	public function sortByPromoProfilRestoran($kode)
	{
		$data['promo'] = $this->fatncurious_model_restaurant->selectBiggestPromo($kode);
		$data['resto'] = $this->fatncurious_model_restaurant->selectRestoByKlik($kode);
		$data['active1'] = '';
		$data['active2'] = 'active';
		$data['active3'] = '';
		$data['active4'] = '';
		$data['active5'] = '';
		if($data['resto']->STATUS == 0){
			$data['resto']->STATUS = 'Tutup';
		}
		else if($data['resto']->STATUS == 1){
			$data['resto']->STATUS = 'Buka';
		}		
		$this->load->view('profileRestoran',$data);
	}
	public function sortByMenuProfilRestoran($kode)
	{
		$data['menu'] = $this->fatncurious_model_menu->selectMenuByResto($kode);
		$data['resto'] = $this->fatncurious_model_restaurant->selectRestoByKlik($kode);
		$data['active1'] = '';
		$data['active2'] = '';
		$data['active3'] = 'active';
		$data['active4'] = '';	
		$data['active5'] = '';
		if($data['resto']->STATUS == 0){
			$data['resto']->STATUS = 'Tutup';
		}
		else if($data['resto']->STATUS == 1){
			$data['resto']->STATUS = 'Buka';
		}		
		$this->load->view('profileRestoran',$data);
	}
	public function sortByMenuRestoran($kode)
	{
		if($this->session->userdata('userYangLogin')){
			$kodeUser = $this->session->userdata('userYangLogin')->KODE_USER;
			$rating = $this->fatncurious_model_restaurant->selectJumlahRatingRestoUser($kode,$kodeUser);
			if($rating==null){
				for($i=1;$i<=5;$i++){
					$data['glyphicon'.$i] = 'glyphicon-star-empty';
				}
			}
			else{
				for($i=1;$i<=5;$i++){
					if(($rating->JUMLAH_RATING) - $i >= 0){
						$data['glyphicon'.$i] = 'glyphicon-star';
					}
					else{
						$data['glyphicon'.$i] = 'glyphicon-star-empty';
					}
				}
			}
		}
		else{
			for($i=1;$i<=5;$i++){
				$data['glyphicon'.$i] = 'glyphicon-star-empty';
			}
		}
		
		$data['menu'] = $this->fatncurious_model_menu->selectMenuByResto($kode);
		$data['resto'] = $this->fatncurious_model_restaurant->selectRestoByKlik($kode);
		$data['active1'] = '';
		$data['active2'] = '';
		$data['active3'] = 'active';
		$data['active4'] = '';		
		$this->load->view('restoran',$data);
	}
	public function sortByPromoRestoran($kode)
	{
		$kodeUser = $this->session->userdata('userYangLogin')->KODE_USER;
		$data['promo'] = $this->fatncurious_model_restaurant->selectBiggestPromo($kode);
		$data['resto'] = $this->fatncurious_model_restaurant->selectRestoByKlik($kode);
		$data['active1'] = 'active';
		$data['active2'] = '';
		$data['active3'] = '';
		$data['active4'] = '';	

		$rating = $this->fatncurious_model_restaurant->selectJumlahRatingRestoUser($kode,$kodeUser);
		if($rating==null){
			for($i=1;$i<=5;$i++){
				$data['glyphicon'.$i] = 'glyphicon-star-empty';
			}
		}
		else{
			for($i=1;$i<=5;$i++){
				if(($rating->JUMLAH_RATING) - $i >= 0){
					$data['glyphicon'.$i] = 'glyphicon-star';
				}
				else{
					$data['glyphicon'.$i] = 'glyphicon-star-empty';
				}
			}
		}
		
		$this->load->view('restoran',$data);
	}
	
	public function sortByKreditRestoran($kode)
	{
		$kodeUser = $this->session->userdata('userYangLogin')->KODE_USER;
		$data['kartu'] = $this->fatncurious_model_restaurant->selectBiggestKreditResto($kode);
		$data['resto'] = $this->fatncurious_model_restaurant->selectRestoByKlik($kode);
		$data['active1'] = '';
		$data['active2'] = 'active';
		$data['active3'] = '';
		$data['active4'] = '';		
		
		$rating = $this->fatncurious_model_restaurant->selectJumlahRatingRestoUser($kode,$kodeUser);
		if($rating==null){
			for($i=1;$i<=5;$i++){
				$data['glyphicon'.$i] = 'glyphicon-star-empty';
			}
		}
		else{
			for($i=1;$i<=5;$i++){
				if(($rating->JUMLAH_RATING) - $i >= 0){
					$data['glyphicon'.$i] = 'glyphicon-star';
				}
				else{
					$data['glyphicon'.$i] = 'glyphicon-star-empty';
				}
			}
		}
		
		$this->load->view('restoran',$data);
	}
	//================Sorted BY================
	
	//================Pagination===============
	public function PaginationFilterByRestoran()
	{
		
		$config = array();
		$config['base_url'] = site_url('fatncurious/PaginationFilterByRestoran');
		$config["per_page"] = 5;
		$config["uri_segment"] = 3;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link']=false;
		$config['last_link']=false;
		$config['cur_tag_open'] = '<li> <a href="http://localhost/fatncurious/index.php/fatncurious/PaginationFilterByRestoran" data-ci-pagination-page="2"><strong>';
		$config['cur_tag_close'] = '</strong></a></li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$config['total_rows'] = sizeof($this->fatncurious_model_restaurant->selectSemuaResto(null,null));
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links();
		$data['resto'] = $this->fatncurious_model_restaurant->selectSemuaResto(5,$page);
		$this->load->view('filterByRestoran',$data);
	}
	
	public function PaginationFilterByMenu()
	{
		
		$config = array();
		$config['base_url'] = site_url('fatncurious/PaginationFilterByMenu');
		$config["per_page"] = 5;
		$config["uri_segment"] = 3;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link']=false;
		$config['last_link']=false;
		$config['cur_tag_open'] = '<li> <a href="http://localhost/fatncurious/index.php/fatncurious/PaginationFilterByMenu" data-ci-pagination-page="2"><strong>';
		$config['cur_tag_close'] = '</strong></a></li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$config['total_rows'] = sizeof($this->fatncurious_model_menu->selectMenu(null,null));
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links();
		$data['menu'] = $this->fatncurious_model_menu->selectMenu(5,$page);
		$this->load->view('filterByMenu',$data);
	}
	
	public function PaginationFilterByKartu()
	{
		
		$config = array();
		$config['base_url'] = site_url('fatncurious/PaginationFilterByKartu');
		$config["per_page"] = 5;
		$config["uri_segment"] = 3;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link']=false;
		$config['last_link']=false;
		$config['cur_tag_open'] = '<li> <a href="http://localhost/fatncurious/index.php/fatncurious/PaginationFilterByKartu" data-ci-pagination-page="2"><strong>';
		$config['cur_tag_close'] = '</strong></a></li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$config['total_rows'] = sizeof($this->fatncurious_model_restaurant->selectBiggestKredit(null,null));
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links();
		$data['kartu'] = $this->fatncurious_model_restaurant->selectBiggestKredit(5,$page);
		$this->load->view('filterByKredit',$data);
	}
	//================Pagination===============
	
}
