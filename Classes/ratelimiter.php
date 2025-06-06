<?php
/*
This is a really simple plug and play rate limiter class meant to be used with APIs.

Using sessions means we can throw this into any PHP API quickly.

$token can be anything to uniquely identify a user, either an IP address, an API key, a JWT token, anything that is unique to a single user.

$prefix can be whatever you want, we default it to "rate"

On init, we create a md5 hash of our $prefix and our $token, this becomes the prefix throughout the class.

We then append a timestamp to this prefix
*/
<<<<<<< HEAD
class RateExceededException extends Exception
{
}

class RateLimiter
{
	private $prefix;
	public function __construct($token, $prefix = "rate")
	{
		$this->prefix = md5($prefix . $token);

		if (!isset($_SESSION["cache"])) {
			$_SESSION["cache"] = array();
		}

		if (!isset($_SESSION["expiries"])) {
			$_SESSION["expiries"] = array();
		} else {
=======
class RateExceededException extends Exception {}

class RateLimiter {
	private $prefix;
	public function __construct($token, $prefix = "rate") {
		$this->prefix = md5($prefix . $token);

		if( !isset($_SESSION["cache"]) ){
			$_SESSION["cache"] = array();
		}

		if( !isset($_SESSION["expiries"]) ){
			$_SESSION["expiries"] = array();
		}else{
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
			$this->expireSessionKeys();
		}
	}

<<<<<<< HEAD
	public function limitRequestsInMinutes($allowedRequests, $minutes)
	{
=======
	public function limitRequestsInMinutes($allowedRequests, $minutes) {
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
		$this->expireSessionKeys();
		$requests = 0;

		foreach ($this->getKeys($minutes) as $key) {
			$requestsInCurrentMinute = $this->getSessionKey($key);
<<<<<<< HEAD
			if (false !== $requestsInCurrentMinute)
				$requests += $requestsInCurrentMinute;
		}

		if (false === $requestsInCurrentMinute) {
			$this->setSessionKey($key, 1, ($minutes * 60 + 1));
		} else {
			$this->increment($key, 1);
		}
		if ($requests > $allowedRequests)
			throw new RateExceededException;
	}

	private function getKeys($minutes)
	{
=======
			if (false !== $requestsInCurrentMinute) $requests += $requestsInCurrentMinute;
		}

		if (false === $requestsInCurrentMinute) {
			$this->setSessionKey( $key, 1, ($minutes * 60 + 1) );
		} else {
			$this->increment($key, 1);
		}
		if ($requests > $allowedRequests) throw new RateExceededException;
	}

	private function getKeys($minutes) {
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
		$keys = array();
		$now = time();
		for ($time = $now - $minutes * 60; $time <= $now; $time += 60) {
			$keys[] = $this->prefix . date("dHi", $time);
		}
		return $keys;
	}

<<<<<<< HEAD
	private function increment($key, $inc)
	{
		$cnt = 0;
		if (isset($_SESSION['cache'][$key])) {
=======
	private function increment( $key, $inc){
		$cnt = 0;
		if( isset($_SESSION['cache'][$key]) ){
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
			$cnt = $_SESSION['cache'][$key];
		}
		$_SESSION['cache'][$key] = $cnt + $inc;
	}

<<<<<<< HEAD
	private function setSessionKey($key, $val, $expiry)
	{
		$_SESSION["expiries"][$key] = time() + $expiry;
		$_SESSION['cache'][$key] = $val;
	}

	private function getSessionKey($key)
	{
		return isset($_SESSION['cache'][$key]) ? $_SESSION['cache'][$key] : false;
	}

	private function expireSessionKeys()
	{
		foreach ($_SESSION["expiries"] as $key => $value) {
			if (time() > $value) {
=======
	private function setSessionKey( $key, $val, $expiry ){
		$_SESSION["expiries"][$key] = time() + $expiry;
		$_SESSION['cache'][$key] = $val;
	}
	
	private function getSessionKey( $key ){
		return isset($_SESSION['cache'][$key]) ? $_SESSION['cache'][$key] : false;
	}

	private function expireSessionKeys() {
		foreach ($_SESSION["expiries"] as $key => $value) {
			if (time() > $value) { 
>>>>>>> e785962b7354eaca9514f02e1a70eaa4f37a2bd3
				unset($_SESSION['cache'][$key]);
				unset($_SESSION["expiries"][$key]);
			}
		}
	}
}