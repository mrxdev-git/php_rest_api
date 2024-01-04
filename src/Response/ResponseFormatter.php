<?php

namespace DataEx\Response;

class ResponseFormatter
{
	public function send($data)
	{
		header('Content-Type: application/json');
		echo json_encode(['data' => $data]);
	}

	public function sendError($message, $statusCode = 400)
	{
		header('Content-Type: application/json');
		http_response_code($statusCode);
		echo json_encode(['error' => $message]);
	}
}