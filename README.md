PHP Google API
===

*Version 3.2.0*

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
                'map_marker_color'  => 'red',
                'map_iframe_width'  => '100%',
                'map_iframe_height' => '500', // in px
                'language'          => 'de',
                'quiet'             => false
    	),
		...
	),


###Usage
---

**Just type in an address string as you do on google maps!**

    $address 	          = '70180 Stuttgart, Germany';
    $filePath             = Yii::app()->googleMapApi->createImage($address,null);

**For query by latitude and longitude**

    $latlng 	          = '48.7632145,9.174027';
    $filePath             = Yii::app()->googleMapApi->createImage(null, $latlng);

**Calculate Distance between two geo points**

    $latlng_origin	      = array('48.7632145,9.174027');
    $latlng_destination	  = array('48.4525334,9.468254');
    $unit		          = 'miles' // or 'km'

    $distance		      = Yii::app()->googleMapApi->getDistance($latlng_origin, $latlng_destination, $unit);

###Public Methods
---

`public function getGoogleMapIframe($address, $latlng, $iFrameWidth, $iFrameHeight)`

`public function createImage($address, $latlng, $setMarker)`

`public function getGeoCodeObject($address, $latlng)`

`public function getDistance($start, $finish, $unit)`

`public static function getCountryByCode($short_country_code)`



