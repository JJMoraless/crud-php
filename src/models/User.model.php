<?php

interface HttpConnect
{
    function sendRequest(string $method, string $url, $data = null);
}

class User
{
    private string $endPoint;
    private HttpConnect $httpConect;

    function __construct(string $endPoint, HttpConnect $httpConect)
    {
        $this->endPoint = $endPoint;
        $this->httpConect = $httpConect;
    }

    public function add($data)              // FUNCIONA
    {
        $query = $this->endPoint;
        return $this->httpConect->sendRequest("POST", $query, $data);
    }

    public function get_by_id($id)          // FUNCIONA                                         
    {
        $query = $this->endPoint . "/$id";
        return $this->httpConect->sendRequest("GET", $query);
    }

    public function delete_by_id($id)       // FUNCIONA
    {
        $query = $this->endPoint . "/$id";
        return $this->httpConect->sendRequest("DELETE", $query);
    }

    public function get_all()               // FUNCIONA            
    {
        $query = $this->endPoint;
        return $this->httpConect->sendRequest("GET", $query);
    }

    public function update_by_id($id, $data)  // FUNCIONA    
    {
        $query = $this->endPoint . "/$id";
        return $this->httpConect->sendRequest("PUT", $query, $data);
    }
}

class FileGetData implements HttpConnect
{
    function sendRequest(string $method, string $endPoint, $data = null)
    {
        $options = [
            'http' => [
                'header' =>  "Content-type: application/json",
                'method' => $method,
                'content' => ($data !== null)
                    ? $data
                    : null
            ]
        ];

        $context  = stream_context_create($options);
        $res = file_get_contents($endPoint, false, $context);

        if ($res === false) {
            return "Error";
        }

        return $res;
    }
}

$fetch = new FileGetData();
$user1 = new User("https://6480e401f061e6ec4d4a01cd.mockapi.io/users", $fetch);
$data_user = json_decode($user1->get_all());

print_r($data_user[0]->nombre);




