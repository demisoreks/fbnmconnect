<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App\AccActivity;
use App\AccLink;

use App\Charts\Distribution;

class AccessController extends Controller
{
    public function index() {
        $links = new Distribution();
        $link_titles = [0 => 'Inactive', 1 => 'General', 2 => 'Privileged'];
        $link_count = [
            0 => AccLink::where('active', false)->count(),
            1 => AccLink::where('active', true)->where('general', true)->count(),
            2 => AccLink::where('active', true)->where('general', false)->count()
        ];
        $link_color_codes = [0 => '#'.str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT), 1 => '#'.str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT), 2 => '#'.str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT)];
        $links->labels($link_titles);
        $links->dataset('Links', 'pie', $link_count)->backgroundColor($link_color_codes);
        
        return view('access.index', compact('links'));
    }
    
    static function logActivity($detail) {
        AccActivity::create([
            'employee_id' => Session::get('fbnm_user')['id'],
            'detail' => $detail,
            'source_ip' => $_SERVER['REMOTE_ADDR']
        ]);
    }
}
