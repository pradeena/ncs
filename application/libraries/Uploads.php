<?php
defined("BASEPATH") or die("No direct script allowed");
class Uploads
{
	public static function uploadFileName($name, $fileName)
	{
		$name=$name;
		$ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); 
		$name=str_replace(' ', '-', $name);
		$name=preg_replace('/[^A-Za-z0-9\-]/', '', $name);
		return time().$name.'.'.$ext; 
	}
	public static function uploadImage($realfile,$path,$file)
	{
		$CI =   &get_instance();
		$config['upload_path']=$path;
		$config["allowed_types"]='gif|GIF|jpg|JPG|jpeg|JPEG|png|PNG';
		$config["max_size"]=100;
		$config["max_width"]=1024;
		$config["max_height"]=768;  
		$config['file_name'] = $realfile; 
		//var_dump($config); die();
		$CI->load->library("upload",$config);
		if($CI->upload->do_upload($file))
		{
			$data = array('upload_data' => $CI->upload->data());
			return 'true';
		}
		else
		{
			return '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button> <h4><i class="icon fa fa-warning"></i>'.$CI->upload->display_errors().'</h4></div>';
		}
	}
	public static function uploadFile()
	{
		return true;
	}
}
?>