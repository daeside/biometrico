<?php

class Http
{
    public static function Get($uri, $settings = null)
    {
        $response = Http::Request($uri, $settings, "GET");
        return $response;
    }

    public static function Post($uri, $data, $settings = null)
    {
        $response = Http::Request($uri, $settings, "POST", json_encode($data));
        return $response;
    }

    private static function Request($uri, $settings, $method, $data = null)
    {
        $response = null;

        try
        {
            $client = curl_init();
            $client = Http::SetRequestSettings($client, $uri, $data, $method, $settings);
            $response = curl_exec($client);
            curl_close($client);
        }
        catch(exception $ex)
        {}
        return $response;
    }

    private static function SetRequestSettings($client, $uri, $data, $method, $settings)
    {
        curl_setopt($client, CURLOPT_URL, $uri);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($client, CURLOPT_SSLVERSION, 6); // TLS v1.2

        if (!empty($settings))
        {
            curl_setopt($client, CURLOPT_HTTPHEADER, $settings);
        }
        $client = Http::SetHttpMethod($client, $method, $data);
        return $client;
    }

    private static function SetHttpMethod($client, $method, $data)
    {
        switch ($method)
        {
            case 'GET':
                curl_setopt($client, CURLOPT_CUSTOMREQUEST, "GET");
                break;
            case 'POST':
                curl_setopt($client, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($client, CURLOPT_POSTFIELDS, $data);
                break;
        }
        return $client;
    }
}

?>