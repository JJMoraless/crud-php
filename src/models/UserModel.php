<?php

interface GetData
{
    function send_request(string $method, string $url, $data = null);
}

class User
{
    private string $endPoint;
    private GetData $httpConect;

    function __construct(string $endPoint, GetData $httpConect)
    {
        $this->endPoint = $endPoint;
        $this->httpConect = $httpConect;
    }

    public function add($data)              // FUNCIONA
    {
        $query = $this->endPoint;
        return $this->httpConect->send_request("POST", $query, $data);
    }

    public function get_by_id($id)               // FUNCIONA                                         
    {
        $query = $this->endPoint . "/$id";
        return $this->httpConect->send_request("GET", $query);
    }

    public function delete_by_id($id)           // FUNCIONA
    {
        $query = $this->endPoint . "/$id";
        return $this->httpConect->send_request("DELETE", $query);
    }

    public function get_all()                   // FUNCIONA            
    {
        $query = $this->endPoint;
        return $this->httpConect->send_request("GET", $query);
    }

    public function update_by_id($id, $data)     // FUNCIONA    
    {
        $query = $this->endPoint . "/$id";
        return $this->httpConect->send_request("PUT", $query, $data);
    }

    public function get_by_cc($cc)     // FUNCIONA    
    {
        $query = $this->endPoint . "?cedula=$cc";
        return $this->httpConect->send_request("GET", $query);
    }
}

class FileGetData implements GetData
{
    function send_request(string $method, string $endPoint, $data = null)
    {
        $options = [
            'http' => [
                'header' =>  "Content-type: application/json",
                'method' => $method,
                'content' => $data
            ]
        ];
        $context  = stream_context_create($options);
        $res = file_get_contents($endPoint, false, $context);
        if ($res === false) return "Error";
        return $res;
    }
}

$fetch = new FileGetData();
$user = new User("https://6480e401f061e6ec4d4a01cd.mockapi.io/users", $fetch);

// $data = json_encode([
//     "nombre"=> "prueba",
//     "apellido"=> "prueba",
//     "edad"=> "prueba",
//     "cc"=> "3"
// ]);

// $res = $user->add($data);
// print_r($res);
