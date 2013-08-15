<?php
class eternityApiError
{
	public $err_num=0;
	public $err_desc='';
}
class eternityApi
{
	public function aboutuser($user)
	{
		$data=file_get_contents('http://api.eternityincurakai.com/aboutuser/'.$user);
		$data=rawurldecode($data);
		if($this->errorcheck($data))
		{
			return FALSE;
		}
		return $data;
	}
	public function authenticate($username,$password)
	{
		$data=file_get_contents('http://api.eternityincurakai.com/authenticate/'.$username.'/'.$password);
		$data = rawurldecode($data);
		if($this->errorcheck($data))
		{
			return FALSE;
		}
		if($data==='false')
		{
			return FALSE;
		}
		$new_data = array();
		$new_data = explode(":", $data);
		$final_data['id']=intval(array_shift($new_data));
		$final_data['username']=array_shift($new_data);
		$final_data['ep']=intval(array_shift($new_data));
		$final_data['banned']=('yes'==array_shift($new_data));
		return $final_data;
	}
	public function avatar($username)
	{
		return '<img src="http://api.eternityincurakai.com/avatar/'.$username.'">';
	}
	private function errorcheck($value)
	{
		if(strpos($value,'<b>')===FALSE)
		{
			return FALSE; // We have no error
		}
		// We have an error.
		$error_text_with_end_array=explode('<b>',$value);
		$error_text_with_end=$error_text_with_end_array[1];
		$error_text_array=explode('</b>',$error_text_with_end);
		$error_text=$error_text_array[0];
		$error_num=intval(substr($error_text,7));
		$error_desc_with_end_array=explode('</b>',$value);
		$error_desc_with_end=$error_desc_with_end_array[1];
		$error_desc_array=explode('<br />',$error_desc_with_end);
		$error_desc_plus=$error_desc_array[0];
		$error_desc=substr($error_desc_plus,1);
		global $ei_error;
		$ei_error=new EternityApiError;
		$ei_error->err_num=$error_num;
		$ei_error->err_desc=$error_desc;
		return TRUE;
	}
	public function getallusers()
	{
		$data=file_get_contents('http://api.eternityincurakai.com/getallusers');
		$data = rawurldecode($data);
		if($this->errorcheck($data))
		{
			return $error;
		}
		$new_data = array();
 		$new_data = explode(":", $data);
		return $new_data;
	}
	public function getnumberofusers()
	{
		$data=file_get_contents('http://api.eternityincurakai.com/getnumberofusers');
		$data = rawurldecode($data);
		if($this->errorcheck($data))
		{
			return FALSE;
		}
		$newdata=intval($data);
		return $newdata;
	}
	public function getuserinfo($username)
	{
		$data=file_get_contents('http://api.eternityincurakai.com/getuserinfo/'.$username);
		$data = rawurldecode($data);
		if($this->errorcheck($data))
		{
			return FALSE;
		}
		$new_data = array();
		$new_data = explode(":", $data);
		$final_data['id']=intval(array_shift($new_data));
		$final_data['username']=array_shift($new_data);
		$final_data['ep']=intval(array_shift($new_data));
		$final_data['banned']=('yes'==array_shift($new_data));
		return $final_data;
	}
	public function latestnews()
	{
		$data=file_get_contents('http://api.eternityincurakai.com/latestnews');
		$data=rawurldecode($data);
		if($this->errorcheck($data))
		{
			return FALSE;
		}
		return $data;
	}
	public function status($user)
	{
		$data=file_get_contents('http://api.eternityincurakai.com/status/'.$user);
		$data=rawurldecode($data);
		if($this->errorcheck($data))
		{
			return FALSE;
		}
		return $data;
	}
	public function statusimage($user)
	{
		return '<img src="http://api.eternityincurakai.com/status-image/'.$user.'">'.$this->status($user).'</img>';
	}
}
?>
