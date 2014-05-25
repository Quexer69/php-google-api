<?php
/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2014 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Class GoogleMapApi
 * @description for the Google Maps API v3
 * @date 2014-05-25
 * @version 1.0.0
 * @author Christopher Stebe <cstebe@iserv4u.com>
 *
 *
 * Config params to be configured:
 *
 * 'params' => array(
 *  'GOOGLE_MAP' => array(
 *      'API_KEY_IMAGE' => '*****************',     // Key for image requests
 *      'API_KEY_GEO'   => '*****************',     // Key for geo requests
 *      'TYPE'          => 'terrain',               // Map type
 *      'SIZE'          => '500x350',               // Size of the image
 *      'ZOOM'          => 9,
 *      'SENSOR'        => false,
 *      'SCALE'         => 2,
 *      'IMAGE_PATH'    => '/images/google_map',    // public path
 *      'LANGUAGE'      => 'de',                    // country code
 *  )
 * ),
 *
 */
class GoogleMapApi
{
    /**
     * @var full path to webroot
     */
    public static $webroot;

    /**
     * @var config params
     */
    public static $params;

    /**
     * @var array country codes to country names from http://pastebin.com/VSAvVng6
     */
    public static $countrycodes = array(
        'AF' => 'Afghanistan',
        'AX' => 'Åland Islands',
        'AL' => 'Albania',
        'DZ' => 'Algeria',
        'AS' => 'American Samoa',
        'AD' => 'Andorra',
        'AO' => 'Angola',
        'AI' => 'Anguilla',
        'AQ' => 'Antarctica',
        'AG' => 'Antigua and Barbuda',
        'AR' => 'Argentina',
        'AU' => 'Australia',
        'AT' => 'Österreich',
        'AZ' => 'Azerbaijan',
        'BS' => 'Bahamas',
        'BH' => 'Bahrain',
        'BD' => 'Bangladesh',
        'BB' => 'Barbados',
        'BY' => 'Belarus',
        'BE' => 'Belgium',
        'BZ' => 'Belize',
        'BJ' => 'Benin',
        'BM' => 'Bermuda',
        'BT' => 'Bhutan',
        'BO' => 'Bolivia',
        'BA' => 'Bosnia and Herzegovina',
        'BW' => 'Botswana',
        'BV' => 'Bouvet Island',
        'BR' => 'Brazil',
        'IO' => 'British Indian Ocean Territory',
        'BN' => 'Brunei Darussalam',
        'BG' => 'Bulgaria',
        'BF' => 'Burkina Faso',
        'BI' => 'Burundi',
        'KH' => 'Cambodia',
        'CM' => 'Cameroon',
        'CA' => 'Canada',
        'CV' => 'Cape Verde',
        'KY' => 'Cayman Islands',
        'CF' => 'Central African Republic',
        'TD' => 'Chad',
        'CL' => 'Chile',
        'CN' => 'China',
        'CX' => 'Christmas Island',
        'CC' => 'Cocos (Keeling) Islands',
        'CO' => 'Colombia',
        'KM' => 'Comoros',
        'CG' => 'Congo',
        'CD' => 'Zaire',
        'CK' => 'Cook Islands',
        'CR' => 'Costa Rica',
        'CI' => 'Côte D\'Ivoire',
        'HR' => 'Croatia',
        'CU' => 'Cuba',
        'CY' => 'Cyprus',
        'CZ' => 'Czech Republic',
        'DK' => 'Denmark',
        'DJ' => 'Djibouti',
        'DM' => 'Dominica',
        'DO' => 'Dominican Republic',
        'EC' => 'Ecuador',
        'EG' => 'Egypt',
        'SV' => 'El Salvador',
        'GQ' => 'Equatorial Guinea',
        'ER' => 'Eritrea',
        'EE' => 'Estonia',
        'ET' => 'Ethiopia',
        'FK' => 'Falkland Islands (Malvinas)',
        'FO' => 'Faroe Islands',
        'FJ' => 'Fiji',
        'FI' => 'Finland',
        'FR' => 'France',
        'GF' => 'French Guiana',
        'PF' => 'French Polynesia',
        'TF' => 'French Southern Territories',
        'GA' => 'Gabon',
        'GM' => 'Gambia',
        'GE' => 'Georgia',
        'DE' => 'Deutschland',
        'GH' => 'Ghana',
        'GI' => 'Gibraltar',
        'GR' => 'Greece',
        'GL' => 'Greenland',
        'GD' => 'Grenada',
        'GP' => 'Guadeloupe',
        'GU' => 'Guam',
        'GT' => 'Guatemala',
        'GG' => 'Guernsey',
        'GN' => 'Guinea',
        'GW' => 'Guinea-Bissau',
        'GY' => 'Guyana',
        'HT' => 'Haiti',
        'HM' => 'Heard Island and Mcdonald Islands',
        'VA' => 'Vatican City State',
        'HN' => 'Honduras',
        'HK' => 'Hong Kong',
        'HU' => 'Hungary',
        'IS' => 'Iceland',
        'IN' => 'India',
        'ID' => 'Indonesia',
        'IR' => 'Iran, Islamic Republic of',
        'IQ' => 'Iraq',
        'IE' => 'Ireland',
        'IM' => 'Isle of Man',
        'IL' => 'Israel',
        'IT' => 'Italy',
        'JM' => 'Jamaica',
        'JP' => 'Japan',
        'JE' => 'Jersey',
        'JO' => 'Jordan',
        'KZ' => 'Kazakhstan',
        'KE' => 'KENYA',
        'KI' => 'Kiribati',
        'KP' => 'Korea, Democratic People\'s Republic of',
        'KR' => 'Korea, Republic of',
        'KW' => 'Kuwait',
        'KG' => 'Kyrgyzstan',
        'LA' => 'Lao People\'s Democratic Republic',
        'LV' => 'Latvia',
        'LB' => 'Lebanon',
        'LS' => 'Lesotho',
        'LR' => 'Liberia',
        'LY' => 'Libyan Arab Jamahiriya',
        'LI' => 'Liechtenstein',
        'LT' => 'Lithuania',
        'LU' => 'Luxembourg',
        'MO' => 'Macao',
        'MK' => 'Macedonia, the Former Yugoslav Republic of',
        'MG' => 'Madagascar',
        'MW' => 'Malawi',
        'MY' => 'Malaysia',
        'MV' => 'Maldives',
        'ML' => 'Mali',
        'MT' => 'Malta',
        'MH' => 'Marshall Islands',
        'MQ' => 'Martinique',
        'MR' => 'Mauritania',
        'MU' => 'Mauritius',
        'YT' => 'Mayotte',
        'MX' => 'Mexico',
        'FM' => 'Micronesia, Federated States of',
        'MD' => 'Moldova, Republic of',
        'MC' => 'Monaco',
        'MN' => 'Mongolia',
        'ME' => 'Montenegro',
        'MS' => 'Montserrat',
        'MA' => 'Morocco',
        'MZ' => 'Mozambique',
        'MM' => 'Myanmar',
        'NA' => 'Namibia',
        'NR' => 'Nauru',
        'NP' => 'Nepal',
        'NL' => 'Netherlands',
        'AN' => 'Netherlands Antilles',
        'NC' => 'New Caledonia',
        'NZ' => 'New Zealand',
        'NI' => 'Nicaragua',
        'NE' => 'Niger',
        'NG' => 'Nigeria',
        'NU' => 'Niue',
        'NF' => 'Norfolk Island',
        'MP' => 'Northern Mariana Islands',
        'NO' => 'Norway',
        'OM' => 'Oman',
        'PK' => 'Pakistan',
        'PW' => 'Palau',
        'PS' => 'Palestinian Territory, Occupied',
        'PA' => 'Panama',
        'PG' => 'Papua New Guinea',
        'PY' => 'Paraguay',
        'PE' => 'Peru',
        'PH' => 'Philippines',
        'PN' => 'Pitcairn',
        'PL' => 'Poland',
        'PT' => 'Portugal',
        'PR' => 'Puerto Rico',
        'QA' => 'Qatar',
        'RE' => 'Réunion',
        'RO' => 'Romania',
        'RU' => 'Russian Federation',
        'RW' => 'Rwanda',
        'SH' => 'Saint Helena',
        'KN' => 'Saint Kitts and Nevis',
        'LC' => 'Saint Lucia',
        'PM' => 'Saint Pierre and Miquelon',
        'VC' => 'Saint Vincent and the Grenadines',
        'WS' => 'Samoa',
        'SM' => 'San Marino',
        'ST' => 'Sao Tome and Principe',
        'SA' => 'Saudi Arabia',
        'SN' => 'Senegal',
        'RS' => 'Serbia',
        'SC' => 'Seychelles',
        'SL' => 'Sierra Leone',
        'SG' => 'Singapore',
        'SK' => 'Slovakia',
        'SI' => 'Slovenia',
        'SB' => 'Solomon Islands',
        'SO' => 'Somalia',
        'ZA' => 'South Africa',
        'GS' => 'South Georgia and the South Sandwich Islands',
        'ES' => 'Spain',
        'LK' => 'Sri Lanka',
        'SD' => 'Sudan',
        'SR' => 'Suriname',
        'SJ' => 'Svalbard and Jan Mayen',
        'SZ' => 'Swaziland',
        'SE' => 'Sweden',
        'CH' => 'Schweiz',
        'SY' => 'Syrian Arab Republic',
        'TW' => 'Taiwan, Province of China',
        'TJ' => 'Tajikistan',
        'TZ' => 'Tanzania, United Republic of',
        'TH' => 'Thailand',
        'TL' => 'Timor-Leste',
        'TG' => 'Togo',
        'TK' => 'Tokelau',
        'TO' => 'Tonga',
        'TT' => 'Trinidad and Tobago',
        'TN' => 'Tunisia',
        'TR' => 'Turkey',
        'TM' => 'Turkmenistan',
        'TC' => 'Turks and Caicos Islands',
        'TV' => 'Tuvalu',
        'UG' => 'Uganda',
        'UA' => 'Ukraine',
        'AE' => 'United Arab Emirates',
        'GB' => 'United Kingdom',
        'US' => 'United States',
        'UM' => 'United States Minor Outlying Islands',
        'UY' => 'Uruguay',
        'UZ' => 'Uzbekistan',
        'VU' => 'Vanuatu',
        'VE' => 'Venezuela',
        'VN' => 'Viet Nam',
        'VG' => 'Virgin Islands, British',
        'VI' => 'Virgin Islands, U.S.',
        'WF' => 'Wallis and Futuna',
        'EH' => 'Western Sahara',
        'YE' => 'Yemen',
        'ZM' => 'Zambia',
        'ZW' => 'Zimbabwe',
    );

    /**
     * @param null $address
     * @param null $latlng
     *
     * @return string
     */
    public static function createImage($address = null, $latlng = null)
    {
        self::$params  = Yii::app()->getParams();
        self::$webroot = realpath(Yii::getPathOfAlias('webroot'));

        // get oogle geocde object
        switch (true) {
            case $address !== null :
                $geoObject   = self::getGeoCodeObject($address, null);
                $querystring = $geoObject->geometry->location->lat . ',' . $geoObject->geometry->location->lng;
                break;
            case $latlng !== null :
                $geoObject   = self::getGeoCodeObject(null, $latlng);
                $querystring = str_replace(' ', '', $latlng);
                break;
            default:
                $querystring = false;
                break;
        }

        // generate google maps image
        $imageRequestUrl = 'http://maps.googleapis.com/maps/api/staticmap'
            . '?center=' . $querystring
            . '&zoom=' . self::$params['GOOGLE_MAP']['ZOOM']
            . '&size=' . self::$params['GOOGLE_MAP']['SIZE']
            . '&maptype=' . self::$params['GOOGLE_MAP']['TYPE']
            . '&sensor=' . self::$params['GOOGLE_MAP']['SENSOR']
            . '&scale=' . self::$params['GOOGLE_MAP']['SCALE']
            . '&language=' . self::$params['GOOGLE_MAP']['LANGUAGE']
            . '&key=' . self::$params['GOOGLE_MAP']['API_KEY_IMAGE'];

        // fullpath and filename before save image
        $address     = self::getAddressComponents($geoObject);
        $relFilePath = self::$params['GOOGLE_MAP']['IMAGE_PATH'] . '/';
        $relFilePath .= self::createImageFilename(
            array($address['postal_code'], $address['locality'], $address['country']),
            'png'
        );
        $fullFilePath = self::$webroot . $relFilePath;

        // Request the google map image
        $handler = curl_init($imageRequestUrl);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($handler, CURLOPT_PROXYPORT, 3128);
        curl_setopt($handler, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($handler, CURLOPT_SSL_VERIFYPEER, 0);
        $googleImage = curl_exec($handler);

        //if the img did not come back
        if (curl_errno($handler)) {
            $return = 'Curl error: ' . curl_error(
                    $handler
                ) . 'Your client has issued a malformed or illegal request. That’s all we know.';

            // Close handle
            curl_close($handler);

            return $return;
        } else {
            @ini_set('allow_url_fopen', 1);
            file_put_contents($fullFilePath, $googleImage);
            @ini_set('allow_url_fopen', 0);

            echo "\n -> Image: " . $relFilePath;

            // Close handle
            curl_close($handler);

            return $relFilePath;
        }
    }

    /**
     * @param array $attributes Input an array of attributes to create a filename from
     * @param string $type type of the file
     *
     * @return string a nice slugged filename
     */
    public static function createImageFilename($attributes = array(), $type = 'png')
    {
        $rawFilename = null;
        if (is_array($attributes) && sizeof($attributes) > 0) {

            foreach ($attributes as $attribute) {
                $rawFilename .= $attribute . '_';
            }

            $rawFilename = substr($rawFilename, 0, sizeof($rawFilename) - 2);

            return utf8_decode(PhInflector::slug($rawFilename)) . '.' . $type;
        }
    }

    /**
     * generate google maps geocode request
     *
     * if address is set, query by address, else by latlng
     *
     * @param null $address
     * @param null $latlng
     *
     * @return JSON decoded array with all location information for this address | false
     */
    public static function getGeoCodeObject($address = null, $latlng = null)
    {
        self::$params = Yii::app()->params;

        if ($address !== null || $latlng !== null) {

            switch (true) {
                case $address !== null:
                    $querystring = '?address=' . urlencode($address);
                    break;
                case $latlng !== null:
                    $querystring = '?latlng=' . $latlng;
                    break;
                default:
                    $querystring = '';
            }

            // concat query string
            $querystring = str_replace(' ', '%20', $querystring);

            // query by address string
            $geoCodeUrl = 'https://maps.googleapis.com/maps/api/geocode/json'
                . $querystring
                . '&language=' . self::$params['GOOGLE_MAP']['LANGUAGE']
                . '&key=' . self::$params['GOOGLE_MAP']['API_KEY_GEO'];

            // get geocode object
            $ch = curl_init($geoCodeUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            $response = curl_exec($ch);
            curl_close($ch);

            // json decode response
            $response_a = json_decode($response);

            if (isset($response_a->results[0])) {
                return $response_a->results[0];
            } else {
                return false;
            }
        } else {
            echo 'getGeoCodeObject() -> no input params given.';
        }
    }

    /**
     * @param array $address
     *
     * @return null|string address from Array as String
     */
    public static function stringifyAddress($address = array())
    {
        if (is_array($address)) {

            $address_string = '';
            foreach ($address as $component) {

                if ($component !== null) {
                    $address_string .= $component . ',';
                }
            }
            return substr($address_string, 0, sizeof($address_string) - 2);

        } else {
            return null;
        }
    }

    /**
     * @param $geoObject
     * @param bool $string set to true to get the address components as string
     *
     * @return array|string|null
     */
    public static function getAddressComponents($geoObject, $string = false)
    {
        if (is_object($geoObject) && isset($geoObject->address_components)) {

            foreach ($geoObject->address_components as $address_component) {

                switch ($address_component->types[0]) {
                    case 'postal_code':
                        $postal_code = $address_component->short_name;
                        break;
                    case 'locality':
                        $locality = $address_component->long_name;
                        break;
                    case 'country':
                        $country      = $address_component->long_name;
                        $country_code = $address_component->short_name;
                        break;
                }
            }

            /**
             * build array with address components.
             * There are some more that can be added if needed
             */
            $address_array = array(
                'postal_code'  => (isset($postal_code) ? $postal_code : null),
                'locality'     => (isset($locality) ? $locality : null),
                'country_code' => (isset($country_code) ? $country_code : null),
                'country'      => (isset($country) ? $country : null)
            );

            if ($string === true) {
                return self::stringifyAddress($address_array);
            } else {
                return $address_array;
            }
        } else {
            return null;
        }
    }

    /**
     * @param $short_country_code
     *
     * @return null|string
     */
    public static function getCountryByCode($short_country_code)
    {
        foreach (self::$countrycodes as $code => $country) {
            if (strtoupper($short_country_code) === $code) {
                return $country;
            }
        }
        return null;
    }
}
