<?php


namespace App\Services;


class ServiceResponse
{
    public bool $success = false;
    public string $message = "";
    public $data;
    public array $error;

    public function toArray()
    {
        return [
            "success" => $this->success,
            "message" => $this->message,
            "data" => $this->data ?? null,
            "error" => $this->error ?? null
        ];
    }
}
