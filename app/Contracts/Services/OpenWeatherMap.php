<?php

namespace App\Contracts\Services;

use Cmfcmf\OpenWeatherMap\CurrentWeather;

/**
 * @mixin \Cmfcmf\OpenWeatherMap
 */
interface OpenWeatherMap
{
    // Group 2xx: Thunderstorm
    const CODE_200 = '200';    // thunderstorm with light rain	 11d
    const CODE_201 = '201';    // thunderstorm with rain	 11d
    const CODE_202 = '202';    // thunderstorm with heavy rain	 11d
    const CODE_210 = '210';    // light thunderstorm	 11d
    const CODE_211 = '211';    // thunderstorm	 11d
    const CODE_212 = '212';    // heavy thunderstorm	 11d
    const CODE_221 = '221';    // ragged thunderstorm	 11d
    const CODE_230 = '230';    // thunderstorm with light drizzle	 11d
    const CODE_231 = '231';    // thunderstorm with drizzle	 11d
    const CODE_232 = '232';    // thunderstorm with heavy drizzle	 11d

    // Group 3xx: Drizzle
    const CODE_300 = '300';     // light intensity drizzle	 09d
    const CODE_301 = '301';     // drizzle	 09d
    const CODE_302 = '302';     // heavy intensity drizzle	 09d
    const CODE_310 = '310';     // light intensity drizzle rain	 09d
    const CODE_311 = '311';     // drizzle rain	 09d
    const CODE_312 = '312';     // heavy intensity drizzle rain	 09d
    const CODE_313 = '313';     // shower rain and drizzle	 09d
    const CODE_314 = '314';     // heavy shower rain and drizzle	 09d
    const CODE_321 = '321';     // shower drizzle

    // Group 5xx: Rain
    const CODE_500 = '500';     // light rain	 10d
    const CODE_501 = '501';     // moderate rain	 10d
    const CODE_502 = '502';     // heavy intensity rain	 10d
    const CODE_503 = '503';     // very heavy rain	 10d
    const CODE_504 = '504';     // extreme rain	 10d
    const CODE_511 = '511';     // freezing rain	 13d
    const CODE_520 = '520';     // light intensity shower rain	 09d
    const CODE_521 = '521';     // shower rain	 09d
    const CODE_522 = '522';     // heavy intensity shower rain	 09d
    const CODE_531 = '531';     // ragged shower rain	 09d

    // Group 6xx: Snow
    const CODE_600 = '600';     // light snow	 13d
    const CODE_601 = '601';     // snow	 13d
    const CODE_602 = '602';     // heavy snow	 13d
    const CODE_611 = '611';     // sleet	 13d
    const CODE_612 = '612';     // shower sleet	 13d
    const CODE_615 = '615';     // light rain and snow	 13d
    const CODE_616 = '616';     // rain and snow	 13d
    const CODE_620 = '620';     // light shower snow	 13d
    const CODE_621 = '621';     // shower snow	 13d
    const CODE_622 = '622';     // heavy shower snow	 13d

    // Group 7xx: Atmosphere
    const CODE_701 = '701';     // mist	 50d
    const CODE_711 = '711';     // smoke	 50d
    const CODE_721 = '721';     // haze	 50d
    const CODE_731 = '731';     // sand, dust whirls	 50d
    const CODE_741 = '741';     // fog	 50d
    const CODE_751 = '751';     // sand	 50d
    const CODE_761 = '761';     // dust	 50d
    const CODE_762 = '762';     // volcanic ash	 50d
    const CODE_771 = '771';     // squalls	 50d
    const CODE_781 = '781';     // tornado	 50d

    // Group 800: Clear
    const CODE_800 = '800';     // clear sky	 01d  01n

    // Group 80x: Clouds
    const CODE_801 = '801';     // few clouds	 02d  02n
    const CODE_802 = '802';     // scattered clouds	 03d  03n
    const CODE_803 = '803';     // broken clouds	 04d  04n
    const CODE_804 = '804';     // overcast clouds	 04d  04n

    // Group 90x: Extreme
    const CODE_900 = '900';     // tornado
    const CODE_901 = '901';     // tropical storm
    const CODE_902 = '902';     // hurricane
    const CODE_903 = '903';     // cold
    const CODE_904 = '904';     // hot
    const CODE_905 = '905';     // windy
    const CODE_906 = '906';     // hail

    // Group 9xx: Additional
    const CODE_951 = '951';     // calm
    const CODE_952 = '952';     // light breeze
    const CODE_953 = '953';     // gentle breeze
    const CODE_954 = '954';     // moderate breeze
    const CODE_955 = '955';     // fresh breeze
    const CODE_956 = '956';     // strong breeze
    const CODE_957 = '957';     // high wind, near gale
    const CODE_958 = '958';     // gale
    const CODE_959 = '959';     // severe gale
    const CODE_960 = '960';     // storm
    const CODE_961 = '961';     // violent storm
    const CODE_962 = '962';     // hurricane

    /**
     * @param $query
     * @param string $units
     * @param string $lang
     * @param string $appid
     * @return CurrentWeather
     */
    public function getWeather($query, $units = 'imperial', $lang = 'en', $appid = '');
}