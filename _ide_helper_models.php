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
 * App\Entities\Weather
 *
 * @property string $id
 * @property float $temp
 * @property float $humidity
 * @property float $pressure
 * @property float $clouds
 * @property int $weather_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Weather whereClouds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Weather whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Weather whereHumidity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Weather whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Weather wherePressure($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Weather whereTemp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Weather whereUpdatedAt($value)
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
 * @property string $value
 * @property string|null $name
 * @property string|null $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Entities\Device $device
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\Room[] $rooms
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\DeviceLog[] $logs
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\DeviceProperty[] $properties
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Device whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Device whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Device whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Device whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Device whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Device whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Device whereUpdatedAt($value)
 */
	class Device extends \Eloquent {}
}

