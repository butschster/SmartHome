<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace SmartHome\Domain\Users\Entities{
/**
 * SmartHome\Domain\Users\Entities\User
 *
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Users\Entities\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Users\Entities\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Users\Entities\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Users\Entities\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Users\Entities\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Users\Entities\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Users\Entities\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace SmartHome\Domain\Devices\Entities{
/**
 * SmartHome\Domain\Devices\Entities\DevicePropertyLog
 *
 * @property string $device_property_id
 * @property string|null $value
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \SmartHome\Domain\Devices\Entities\DeviceProperty $property
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Devices\Entities\DevicePropertyLog last24Hours()
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Devices\Entities\DevicePropertyLog lastMonth()
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Devices\Entities\DevicePropertyLog lastYear()
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Devices\Entities\DevicePropertyLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Devices\Entities\DevicePropertyLog whereDevicePropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Devices\Entities\DevicePropertyLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Devices\Entities\DevicePropertyLog whereValue($value)
 */
	class DevicePropertyLog extends \Eloquent {}
}

namespace SmartHome\Domain\Devices\Entities{
/**
 * SmartHome\Domain\Devices\Entities\DeviceProperty
 *
 * @property string $id
 * @property string $device_id
 * @property string $key
 * @property string|null $value
 * @property int $position
 * @property string|null $name
 * @property string|null $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \SmartHome\Domain\Devices\Entities\Device $device
 * @property-read array $meta
 * @property-read null|string $prev_value
 * @property-read \Illuminate\Database\Eloquent\Collection|\SmartHome\Domain\Devices\Entities\DevicePropertyLog[] $logs
 * @property-read \Illuminate\Database\Eloquent\Collection|\SmartHome\Domain\Rooms\Entities\Room[] $rooms
 * @property-read \Illuminate\Database\Eloquent\Collection|\SmartHome\Domain\Scenario\Entities\Scenario[] $scenarios
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Devices\Entities\DeviceProperty whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Devices\Entities\DeviceProperty whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Devices\Entities\DeviceProperty whereDeviceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Devices\Entities\DeviceProperty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Devices\Entities\DeviceProperty whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Devices\Entities\DeviceProperty whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Devices\Entities\DeviceProperty wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Devices\Entities\DeviceProperty whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Devices\Entities\DeviceProperty whereValue($value)
 */
	class DeviceProperty extends \Eloquent {}
}

namespace SmartHome\Domain\Devices\Entities{
/**
 * SmartHome\Domain\Devices\Entities\DeviceLog
 *
 * @property string $device_id
 * @property string|null $message
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \SmartHome\Domain\Devices\Entities\Device $device
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Devices\Entities\DeviceLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Devices\Entities\DeviceLog whereDeviceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Devices\Entities\DeviceLog whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Devices\Entities\DeviceLog whereUpdatedAt($value)
 */
	class DeviceLog extends \Eloquent {}
}

namespace SmartHome\Domain\Devices\Entities{
/**
 * SmartHome\Domain\Devices\Entities\Device
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\SmartHome\Domain\Devices\Entities\DeviceLog[] $logs
 * @property-read \Illuminate\Database\Eloquent\Collection|\SmartHome\Domain\Devices\Entities\DeviceProperty[] $properties
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Devices\Entities\Device whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Devices\Entities\Device whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Devices\Entities\Device whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Devices\Entities\Device whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Devices\Entities\Device whereLastActivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Devices\Entities\Device whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Devices\Entities\Device whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Devices\Entities\Device whereUpdatedAt($value)
 */
	class Device extends \Eloquent {}
}

namespace SmartHome\Domain\Xiaomi\Entities{
/**
 * SmartHome\Domain\Xiaomi\Entities\XiaomiLog
 *
 * @property string $id
 * @property string $ip
 * @property string $cmd
 * @property string|null $model
 * @property string $message
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Xiaomi\Entities\XiaomiLog whereCmd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Xiaomi\Entities\XiaomiLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Xiaomi\Entities\XiaomiLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Xiaomi\Entities\XiaomiLog whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Xiaomi\Entities\XiaomiLog whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Xiaomi\Entities\XiaomiLog whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Xiaomi\Entities\XiaomiLog whereUpdatedAt($value)
 */
	class XiaomiLog extends \Eloquent {}
}

namespace SmartHome\Domain\Xiaomi\Entities{
/**
 * SmartHome\Domain\Xiaomi\Entities\Gateway
 *
 * @property string $id
 * @property string $ip
 * @property string|null $token
 * @property string $sid
 * @property string|null $name
 * @property string|null $description
 * @property string|null $password
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\SmartHome\Domain\Devices\Entities\Device[] $devices
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Xiaomi\Entities\Gateway whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Xiaomi\Entities\Gateway whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Xiaomi\Entities\Gateway whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Xiaomi\Entities\Gateway whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Xiaomi\Entities\Gateway whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Xiaomi\Entities\Gateway wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Xiaomi\Entities\Gateway whereSid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Xiaomi\Entities\Gateway whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Xiaomi\Entities\Gateway whereUpdatedAt($value)
 */
	class Gateway extends \Eloquent {}
}

namespace SmartHome\Domain\Scenario\Entities{
/**
 * SmartHome\Domain\Scenario\Entities\ScenarioTrigger
 *
 * @property string $id
 * @property string $device_property_id
 * @property string $name
 * @property string|null $description
 * @property string $condition
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \SmartHome\Domain\Devices\Entities\DeviceProperty $deviceProperty
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Scenario\Entities\ScenarioTrigger whereCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Scenario\Entities\ScenarioTrigger whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Scenario\Entities\ScenarioTrigger whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Scenario\Entities\ScenarioTrigger whereDevicePropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Scenario\Entities\ScenarioTrigger whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Scenario\Entities\ScenarioTrigger whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Scenario\Entities\ScenarioTrigger whereUpdatedAt($value)
 */
	class ScenarioTrigger extends \Eloquent {}
}

namespace SmartHome\Domain\Scenario\Entities{
/**
 * SmartHome\Domain\Scenario\Entities\ScenarioAction
 *
 * @property string $id
 * @property string $device_property_id
 * @property string $name
 * @property string|null $description
 * @property string $action
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \SmartHome\Domain\Devices\Entities\DeviceProperty $deviceProperty
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Scenario\Entities\ScenarioAction whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Scenario\Entities\ScenarioAction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Scenario\Entities\ScenarioAction whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Scenario\Entities\ScenarioAction whereDevicePropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Scenario\Entities\ScenarioAction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Scenario\Entities\ScenarioAction whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Scenario\Entities\ScenarioAction whereUpdatedAt($value)
 */
	class ScenarioAction extends \Eloquent {}
}

namespace SmartHome\Domain\Scenario\Entities{
/**
 * SmartHome\Domain\Scenario\Entities\Scenario
 *
 * @property string $id
 * @property string $name
 * @property string|null $description
 * @property int $priority
 * @property string|null $cron_expression
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\SmartHome\Domain\Scenario\Entities\ScenarioAction[] $actions
 * @property-read \Illuminate\Database\Eloquent\Collection|\SmartHome\Domain\Scenario\Entities\ScenarioTrigger[] $triggers
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Scenario\Entities\Scenario whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Scenario\Entities\Scenario whereCronExpression($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Scenario\Entities\Scenario whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Scenario\Entities\Scenario whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Scenario\Entities\Scenario whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Scenario\Entities\Scenario wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Scenario\Entities\Scenario whereUpdatedAt($value)
 */
	class Scenario extends \Eloquent {}
}

namespace SmartHome\Domain\Rooms\Entities{
/**
 * SmartHome\Domain\Rooms\Entities\Room
 *
 * @property string $id
 * @property string $name
 * @property string|null $description
 * @property int $position
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\SmartHome\Domain\Devices\Entities\DeviceProperty[] $deviceProperties
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Rooms\Entities\Room whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Rooms\Entities\Room whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Rooms\Entities\Room whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Rooms\Entities\Room whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Rooms\Entities\Room wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Rooms\Entities\Room whereUpdatedAt($value)
 */
	class Room extends \Eloquent {}
}

namespace SmartHome\Domain\Weather{
/**
 * SmartHome\Domain\Weather\Weather
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
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Weather\Weather whereClouds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Weather\Weather whereCloudsDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Weather\Weather whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Weather\Weather whereHumidity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Weather\Weather whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Weather\Weather whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Weather\Weather wherePressure($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Weather\Weather whereTemp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Weather\Weather whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Weather\Weather whereWeatherDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Weather\Weather whereWeatherId($value)
 */
	class Weather extends \Eloquent {}
}

namespace SmartHome\Domain\Mqtt{
/**
 * SmartHome\Domain\Mqtt\MqttLog
 *
 * @property string $id
 * @property string $topic
 * @property string $message
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Mqtt\MqttLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Mqtt\MqttLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Mqtt\MqttLog whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Mqtt\MqttLog whereTopic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SmartHome\Domain\Mqtt\MqttLog whereUpdatedAt($value)
 */
	class MqttLog extends \Eloquent {}
}

