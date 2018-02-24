<?php

namespace Tests\Unit\Scenario;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ValidatorTest extends TestCase
{
    use RefreshDatabase;

    function test_property_can_be_validate()
    {
        $property = $this->createDeviceProperty();

        $json = [
            'rules' => [
                [
                    'id' => 1,
                    'type' => 'integer',
                    'field' => null,
                    'operator' => 'equal',
                    'input' => 'radio',
                    'value' => 10
                ]
            ]
        ];
    }
}
