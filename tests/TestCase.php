<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Helpers\DeviceTrait;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication,
        DeviceTrait;



    /**
     * Boot the testing helper traits.
     *
     * @return array
     */
    protected function setUpTraits()
    {
        $uses = parent::setUpTraits();

        if (isset($uses[DeviceTrait::class])) {
            $this->registerTestDeviceConfig();
        }

        return $uses;
    }
}
