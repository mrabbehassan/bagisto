<?php

namespace Webkul\Installer\Http\Controllers;

class InstallerController extends Controller
{

    /**
     * Installer View Root Page
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('installer::installer.installer');
    }


    public function storeEnvironment() {

    }
}