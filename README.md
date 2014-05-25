PHP Google API
===

...for Google API v3, PHP >= 5, Yii 1.*

###Configuration
---
in your app and/or console configuration file, add these 'params'

	'params' => array(
	    'Google_MAP' => array(
	    	'API_KEY_IMAGE' => '**********************', // Required
	    	'API_KEY_GEO'   => '**********************', // Required
	    	'TYPE'  		=> 'terrain',                // Required
	    	'SIZE'  		=> '500x350',
	    	'ZOOM'  		=> 9,
	    	'SENSOR'		=> false,
	    	'SCALE' 		=> 2,
	    	'IMAGE_PATH'	=> '/images/google_map',     // Required. Directory must exist
	    	'LANGUAGE'	    => 'de',                     // default: en
	    ),
		...
	),

###Usage
---

**Just type in an address string as you do on google maps!**

    $address = '70180 Stuttgart, Germany';

    GoogleMapApi::createImage($address,null);

**For query by latitude and longitude**

    $latlng = '48.7632145,9.174027';

    GoogleMapApi::createImage(null, $latlng);


###Method descriptions
---

TBD.
