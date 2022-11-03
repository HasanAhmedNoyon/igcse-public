<?php
use App\Models\SystemInfo;

function system_info()
{
    $info = SystemInfo::first();
    return $info;
}