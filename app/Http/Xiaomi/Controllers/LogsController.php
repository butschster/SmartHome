<?php

namespace SmartHome\Http\Xiaomi\Controllers;

use SmartHome\App\Http\Controller;
use SmartHome\Domain\Xiaomi\Entities\XiaomiLog;
use SmartHome\Http\Xiaomi\Resources\LogCollection;

class LogsController extends Controller
{
    /**
     * @return LogCollection
     */
    public function index(): LogCollection
    {
        return new LogCollection(
            XiaomiLog::latest()->paginate()
        );
    }
}
