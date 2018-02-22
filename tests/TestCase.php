<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Helpers\DeviceTrait;
use Tests\Helpers\PropertyActionsTrait;
use Tests\Helpers\RommTrait;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication,
        DeviceTrait,
        RommTrait,
        PropertyActionsTrait;

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
