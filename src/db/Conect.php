<?php 

interface HttpConnect
{
    function sendRequest(string $method, string $url, $data = null);
}
