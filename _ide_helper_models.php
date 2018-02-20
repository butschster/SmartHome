<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Entities{
/**
 * App\Entities\DevicePropertyLog
 *
 * @property string $device_property_id
 * @property string|null $value
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Entities\DeviceProperty $property
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\DevicePropertyLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\DevicePropertyLog whereDevicePropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\DevicePropertyLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\DevicePropertyLog whereValue($value)
 */
	class DevicePropertyLog extends \Eloquent {}
}

namespace App\Entities{
/**
 * App\Entities\Weather
 *
 * @property string $id
 * @property string $icon
 * @property float $temp
 * @property float $humidity
 * @property float $pressure
 * @property float $clouds
 * @property string $clouds_description
 * @property int $weather_id
 * @property string $weather_description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Weather whereClouds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Weather whereCloudsDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Weather whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Weather whereHumidity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Weather whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Weather whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Weather wherePressure($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Weather whereTemp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Weather whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Weather whereWeatherDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Weather whereWeatherId($value)
 */
	class Weather extends \Eloquent {}
}

namespace App\Entities{
/**
 * App\Entities\Room
 *
 * @property string $id
 * @property string $name
 * @property string|null $description
 * @property int $position
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\DeviceProperty[] $deviceProperties
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Room whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Room whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Room whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Room whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Room wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Room whereUpdatedAt($value)
 */
	class Room extends \Eloquent {}
}

namespace App\Entities{
/**
 * App\Entities\MqttLog
 *
 * @property string $id
 * @property string $topic
 * @property string $message
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\MqttLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\MqttLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\MqttLog whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\MqttLog whereTopic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\MqttLog whereUpdatedAt($value)
 */
	class MqttLog extends \Eloquent {}
}

namespace App\Entities{
/**
 * App\Entities\Model
 *
 * @mixin \Illuminate\Database\Query\Builder
 */
	class Model extends \Eloquent {}
}

namespace App\Entities{
/**
 * App\Entities\User
 *
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Entities{
/**
 * App\Entities\DeviceProperty
 *
 * @property string $id
 * @property string $device_id
 * @property string $key
 * @property string|null $value
 * @property string|null $name
 * @property string|null $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Entities\Device $device
 * @property-read array $meta
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\DevicePropertyLog[] $logs
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\Room[] $rooms
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\Scenario[] $scenarios
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\DeviceProperty whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\DeviceProperty whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\DeviceProperty whereDeviceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\DeviceProperty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\DeviceProperty whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\DeviceProperty whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\DeviceProperty whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\DeviceProperty whereValue($value)
 */
	class DeviceProperty extends \Eloquent {}
}

namespace App\Entities{
/**
 * App\Entities\ScenarioTrigger
 *
 * @property string $id
 * @property string $device_property_id
 * @property string $name
 * @property string|null $description
 * @property mixed $condition
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Entities\DeviceProperty $deviceProperty
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\ScenarioTrigger whereCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\ScenarioTrigger whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\ScenarioTrigger whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\ScenarioTrigger whereDevicePropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\ScenarioTrigger whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\ScenarioTrigger whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\ScenarioTrigger whereUpdatedAt($value)
 */
	class ScenarioTrigger extends \Eloquent {}
}

namespace App\Entities{
/**
 * App\Entities\DeviceLog
 *
 * @property string $device_id
 * @property string|null $message
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Entities\Device $device
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\DeviceLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\DeviceLog whereDeviceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\DeviceLog whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\DeviceLog whereUpdatedAt($value)
 */
	class DeviceLog extends \Eloquent {}
}

namespace App\Entities{
/**
 * App\Entities\Device
 *
 * @property string $id
 * @property string $key
 * @property string $type
 * @property string|null $name
 * @property string|null $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $last_activity
 * @property-read string|null $formatted_last_activity
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\DeviceLog[] $logs
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\DeviceProperty[] $properties
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Device whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Device whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Device whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Device whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Device whereLastActivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Device whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Device whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Device whereUpdatedAt($value)
 */
	class Device extends \Eloquent {}
}

namespace App\Entities{
/**
 * App\Entities\ScenarioAction
 *
 * @property string $id
 * @property string $device_property_id
 * @property string $name
 * @property string|null $description
 * @property mixed $action
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Entities\DeviceProperty $deviceProperty
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\ScenarioAction whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\ScenarioAction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\ScenarioAction whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\ScenarioAction whereDevicePropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\ScenarioAction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\ScenarioAction whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\ScenarioAction whereUpdatedAt($value)
 */
	class ScenarioAction extends \Eloquent {}
}

namespace App\Entities{
/**
 * App\Entities\Scenario
 *
 * @property string $id
 * @property string $name
 * @property string|null $description
 * @property int $priority
 * @property string|null $cron_expression
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\ScenarioAction[] $actions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\ScenarioTrigger[] $triggers
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Scenario whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Scenario whereCronExpression($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Scenario whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Scenario whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Scenario whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Scenario wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Scenario whereUpdatedAt($value)
 */
	class Scenario extends \Eloquent {}
}

