<?php
 
class Pizza extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
	}
	function index()
	{
		$data['title']='Kodmerkezi.net Pizza Sipariş Sayfası';
		$data['header']='<h1>Siparişler</h1>';
 
		$this->load->model('pizza_model');//pizza_model classımızı projemize yüklüyoruz.
		$data['orders']=$this->pizza_model->get_all_orders();//get_all_orders fonksiyonunu çağırıyoruz ve sonucu $data değişkenimize atıyoruz.
 
		$this->load->view('pizza_view',$data);
	}
	function get_method($name='',$unit='')
	{
		$data['title']='Kodmerkezi.net Pizza Sipariş Sayfası';
		$data['header']='<h1>Siparişler</h1>';
		if(!$name || !$unit)
		{
			$data['orders']='Sipariş Yok';
		}
		else
		{
			$data['orders']='Adı: '.$name.' Adedi: '.$unit;
		}
 
		$this->load->view('pizza_view',$data);
 
	}
 
}
?>