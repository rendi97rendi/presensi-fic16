<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

date_default_timezone_set('Asia/Jakarta');

class DocumentController extends Controller
{
    public function images($fileName, $folder)
    {
        return response()->file(storage_path('/app/public/' . $folder . '/' . $fileName));
    }
}
