<?php

namespace App\Http\Controllers\Views\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientDetailPacketController extends Controller
{
    public function detailPacket() {
        return view("pages.client.detail_paket.index");
    }
}
