<?php

namespace App\Http\Controllers\SmsTools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use TCG\Voyager\Facades\Voyager;


class IndexController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $category = Voyager::model('Category')->count();
        return view('tool.content.tools');
    }
}
