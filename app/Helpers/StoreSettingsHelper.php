<?php

namespace App\Helpers;

use App\StoreSettings;

class StoreSettingsHelper
{
    public function getSettings()
    {
        return StoreSettings::limit(1)->get();
    }

    public function saveSettings($data)
    {
        return StoreSettings::create($data);
    }
}
