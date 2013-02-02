<?php

namespace MattKirwan\TempToken;

class TempToken
{

	public $token = null;
	public $token_lifetime_secs = 3600;
	public $token_expires_on;

	private $unique_salt = null;	

	private function __clone(){}

	public function set_unique_salt($salt)
	{
		$this->unique_salt = $salt;
	}

	public function set_token_lifetime_secs($secs)
	{
		$this->token_lifetime_secs = $secs;
	}

	public function generate_token()
	{
		if(null !== $this->unique_salt)
		{
			$this->unique_salt = rand();
		}

		$this->generate_token_expiration();

		$this->token = md5(uniqid($this->unique_salt, true));
	}

	private function generate_token_expiration()
	{
		$date = new \DateTime();
		$date->add(new \DateInterval("PT{$this->token_lifetime_secs}S"));

		$this->token_expires_on = $date->format('Y-m-d H:i:s');		
	}

	public function get_token()
	{
		if( null !== $this->token )
		{
			return $this->token;
		}

		$this->generate_token();

		return $this->token;
	}

	public function get_token_expiration()
	{
		return $this->token_expires_on;
	}

}