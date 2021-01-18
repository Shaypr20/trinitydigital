<?php

class curlQuery
{
	public function get($link, $array = [])
	{
		return $this->send_Query($link, $type = "get", $array);
	}

	public function post($link, $array = [])
	{
		return $this->send_Query($link, $type = "post", $array);
	}

	public function put($link, $array = [])
	{
		return $this->send_Query($link, $type = "put", $array);
	}

	private function send_Query($link, $type = "get", $array = [])
	{
		$type = mb_strtolower($type);

		$head = $array['head'];
		$data = $array['data'];
		$auth = $array['auth'][0] . ":" . $array['auth'][1];

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $link);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		switch ($type) {
			case "put":
				curl_setopt($ch, CURLOPT_PUT, 1);
				break;

			case "post":
				curl_setopt($ch, CURLOPT_POST, 1);
				break;
		}

		if ($auth) curl_setopt($ch, CURLOPT_USERPWD, $auth);
		if ($head) curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
		if ($data) curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

		$request = curl_exec($ch);
		curl_close($ch);

		return $request;
	}
}