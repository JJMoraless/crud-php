<?php

interface HttpConnect
{
    function sendRequest(string $method, string $url, $data = null);
}

class user
{
    private string $endPoint;
    private HttpConnect $httpConect;

    function __construct(string $endPoint, HttpConnect $httpConect)
    {
        $this->endPoint = $endPoint;
        $this->httpConect = $httpConect;
    }
    public function add_user($data)
    {
        $query = $this->endPoint;
        return $this->httpConect->sendRequest("POST", $query, $data);
    }
    public function get_by_id($id)
    {
        $query = $this->endPoint . "/$id";
        return $this->httpConect->sendRequest("GET", $query);
    }
    public function delete_by_id($id){
        $query = $this->endPoint. "/$id";
        return $this->httpConect->sendRequest("DELETE", $query);
    }
    public function get_all()
    {
        $query = $this->endPoint;
        return $this->httpConect->sendRequest("GET", $query);
    }
}

class FileGetData implements HttpConnect
{
    function sendRequest(string $method, string $endPoint, $data = null)
    {
        $data = json_encode([
            "cc" => 1,
            "nombre" => "yureimis",
            "apellido" => "apllidous",
            "edad" => "12"
        ]);

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






// $url = "https://6480e401f061e6ec4d4a01cd.mockapi.io/users";
// $opciones = [
//     'http' => [
//         'header' =>  "Content-type: application/json",
//         'method' => $method,
//         'content' => http_build_query($data)
//     ]
// ];

// $contexto = stream_context_create($opciones);
// $data = file_get_contents($url, false, $contexto);
// print_r($data);


// $url = 'http://server.com/path';
// $data = array('key1' => 'value1', 'key2' => 'value2');

// // use key 'http' even if you send the request to https://...
// $options = array(
//     'http' => array(
//         'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
//         'method'  => 'POST',
//         'content' => http_build_query($data)
//     )
// );
// $context  = stream_context_create($options);
// $result = file_get_contents($url, false, $context);
// if ($result === FALSE) { /* Handle error */
// }

// var_dump($result);
