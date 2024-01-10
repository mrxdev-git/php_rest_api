<?php

namespace DataEx\Response;

class ResponseFormatter
{
	public function sendSuccess($data)
	{
		$this->send(['data' => $data]);
	}

	public function sendError($message, $statusCode = 400)
	{
		$this->send(['error' => $message], $statusCode);
	}

	protected function send($data, $statusCode = 200)
	{
		header('Content-Type: application/json; charset=UTF-8');
		if ($statusCode){
			http_response_code($statusCode);
		}
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}

}