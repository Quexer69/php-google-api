PHP Google API
===

Version 2.0.0

...for Google Map API v3, PHP >= 5.3.0, Yii 1.*

###Configuration
---
in your app and/or console configuration file, add these

    'components' => array(
    	'googleMapApi'   => array(
    			'class'             => 'vendor.quexer69.php-google-api.GoogleMapApi',
                /**
                 * Google Maps Image and Geocode API settings
                 */
                'staticmap_api_key' => '***************************************',
                'geocode_api_key'   => '***************************************',
                'map_type'          => 'terrain',
                'map_size'          => '520x350',
                'map_sensor'        => false,
                'map_zoom'          => 9,
                'map_scale'         => 1,
                'map_image_path'    => '/images/google_map',
                'map_marker_color   => 'red',
                'language'          => 'de',
                'quiet'             => false
    	),
		...
	),


###Usage
---

**Just type in an address string as you do on google maps!**

    $address 	  = '70180 Stuttgart, Germany';

    $filePath     = Yii::app()->googleMapApi->createImage($address,null);

**For query by latitude and longitude**

    $latlng 	  = '48.7632145,9.174027';

    $filePath     = Yii::app()->googleMapApi->createImage(null, $latlng);

**Calculate Distance between two geo points**

    $latlng_origin	  = array('48.7632145,9.174027');
    $latlng_destination	  = array('48.4525334,9.468254');
    $unit		  = 'miles' // or 'km'

    $distance		  = Yii::app()->googleMapApi->getDistance($latlng_origin, $latlng_destination, $unit);

###Public Methods
---

`public function createImage($address = null, $latlng = null, $setMarker = false)`
`public function getGeoCodeObject($address = null, $latlng = null)`
`public function getDistance($start = array(), $finish = array(), $unit = 'miles')`
`public static function getCountryByCode($short_country_code)`

