<?php

namespace Webkul\Installer\Http\Middleware;

class CanInstall
{

    public function handle()
    {
        if ($this->isAlreadyInstalled()) {
            return redirect()->route('shop.home.index');
        }

        return redirect()->route('installer.index');
    }

    /**
     * If application is already installed.
     *
     * @return bool
     */
    public function isAlreadyInstalled()
    {
        return file_exists(storage_path('installed')) || app('Webkul\Installer\Http\Helpers\DatabaseManager')->getEnvironment();
    }
}