<?php

namespace App\Http\Controllers;

use RouterOS\Client;
use RouterOS\Query;
use Illuminate\Http\Request;

class MikrotikController extends Controller
{
    public function index()
    {
        $client = new Client([
            'host' => '192.168.1.2',
            'user' => 'innofasa',
            'pass' => 'rahima2018',
            'port' => 8728,
        ]);
        $query = new Query('/ip/address/print');
        $response = $client->query($query)->read();
        dd($response);
    }
}
