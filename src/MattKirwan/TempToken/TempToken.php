<?php

namespace MattKirwan\TempToken;

class TempToken
{
	public $token = null;
	public $token_lifetime_secs = 3600;
	public $token_expires_on;

	private $unique_salt = null;	

	private $date_format = 'Y-m-d H:i:s';

	private function __clone(){}

	public function set_unique_salt($salt = null)
	{
		$this->unique_salt = $salt;
	}

	public function set_token_lifetime_secs($secs = null)
	{
		if(null !== $secs)
		{
			$this->token_lifetime_secs = $secs;
		}		
	}

	public function set_date_format($date_format = null)
	{
		if(null !== $date_format)
		{
			$this->date_format = $date_format;
		}
	}

	public function generate_token()
	{
		if(null === $this->unique_salt)
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

		$this->token_expires_on = $date->format($this->date_format);		
	}

	public function get_token()
	{
		if(null === $this->token)
		{
			$this->generate_token();
		}

		return $this->token;
	}

	public function get_token_expiration()
	{
		return $this->token_expires_on;
	}
}
