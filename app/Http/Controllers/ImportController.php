<?php

namespace App\Http\Controllers;

use App\Integrations\Ebay\Ebay;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    /**
     * Import product
     *
     */
    public function store(Request $request)
    {
        app(Ebay::class)->import()->product($request->all());
    }
}
