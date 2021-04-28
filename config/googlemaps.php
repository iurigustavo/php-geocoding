<?php

    return [


        'start_point' => [
            'address'  => 'Avenida Dr. Gastão Vidigal, 1132 - Vila Leopoldina - 05314-010 - São Paulo - SP',
            'lat'      => -23.529032,
            'lng'      => -46.7397648,
            'place_id' => 'ChIJPW-bvLf4zpQRwIARaSxc-mM',

        ],

        /*
        |--------------------------------------------------------------------------
        | API Key
        |--------------------------------------------------------------------------
        |
        | Will be used for all web services,
        | unless overwritten bellow using 'key' parameter
        |
        |
        */
        'key'             => env('GOOGLE_KEY'),

        /*
        |--------------------------------------------------------------------------
        | Verify SSL Peer
        |--------------------------------------------------------------------------
        |
        | Will be used for all web services to verify
        | SSL peer (SSL certificate validation)
        |
         */
        'ssl_verify_peer' => FALSE,

        /*
        |--------------------------------------------------------------------------
        | Service URL
        |--------------------------------------------------------------------------
        | url - web service URL
        | type - request type POST or GET
        | key - API key, if different to API key above
        | endpoint - boolean, indicates whenever output parameter to be used in the request or not
        | responseDefaultKey - specify default field value to be returned when calling getByKey()
        | param - accepted request parameters
        |
        */

        'service' => [

            'geocoding' => [
                'url'                => 'https://maps.googleapis.com/maps/api/geocode/',
                'type'               => 'GET',
                'key'                => NULL,
                'endpoint'           => TRUE,
                'responseDefaultKey' => 'place_id',
                'param'              => [
                    'address'       => NULL,
                    'bounds'        => NULL,
                    'key'           => NULL,
                    'region'        => NULL,
                    'language'      => NULL,
                    'result_type'   => NULL,
                    'location_type' => NULL,
                    'latlng'        => NULL,
                    'place_id'      => NULL,
                    'components'    => [
                        'route'               => NULL,
                        'locality'            => NULL,
                        'administrative_area' => NULL,
                        'postal_code'         => NULL,
                        'country'             => NULL,
                    ]
                ]
            ],


            'directions' => [
                'url'                => 'https://maps.googleapis.com/maps/api/directions/',
                'type'               => 'GET',
                'key'                => NULL,
                'endpoint'           => TRUE,
                'responseDefaultKey' => 'geocoded_waypoints',
                'decodePolyline'     => TRUE, // true = decode overview_polyline.points to an array of points
                'param'              => [
                    'origin'                     => NULL, // required
                    'destination'                => NULL, //required
                    'mode'                       => NULL,
                    'waypoints'                  => NULL,
                    'place_id'                   => NULL,
                    'alternatives'               => NULL,
                    'avoid'                      => NULL,
                    'language'                   => 'pt-BR',
                    'units'                      => 'metric',
                    'region'                     => NULL,
                    'departure_time'             => NULL,
                    'arrival_time'               => NULL,
                    'transit_mode'               => NULL,
                    'transit_routing_preference' => NULL,
                ]
            ],


            'distancematrix' => [
                'url'                => 'https://maps.googleapis.com/maps/api/distancematrix/',
                'type'               => 'GET',
                'key'                => NULL,
                'endpoint'           => TRUE,
                'responseDefaultKey' => 'origin_addresses',
                'param'              => [
                    'origins'                    => NULL,
                    'destinations'               => NULL,
                    'key'                        => NULL,
                    'mode'                       => NULL,
                    'language'                   => NULL,
                    'avoid'                      => NULL,
                    'units'                      => NULL,
                    'departure_time'             => NULL,
                    'arrival_time'               => NULL,
                    'transit_mode'               => NULL,
                    'transit_routing_preference' => NULL,

                ]
            ],


            'elevation' => [
                'url'                => 'https://maps.googleapis.com/maps/api/elevation/',
                'type'               => 'GET',
                'key'                => NULL,
                'endpoint'           => TRUE,
                'responseDefaultKey' => 'elevation',
                'param'              => [
                    'locations' => NULL,
                    'path'      => NULL,
                    'samples'   => NULL,
                    'key'       => NULL,
                ]
            ],


            'geolocate' => [
                'url'                => 'https://www.googleapis.com/geolocation/v1/geolocate?',
                'type'               => 'POST',
                'key'                => NULL,
                'endpoint'           => FALSE,
                'responseDefaultKey' => 'location',
                'param'              => [
                    'homeMobileCountryCode' => NULL,
                    'homeMobileNetworkCode' => NULL,
                    'radioType'             => NULL,
                    'carrier'               => NULL,
                    'considerIp'            => NULL,
                    'cellTowers'            => [
                        'cellId'            => NULL,
                        'locationAreaCode'  => NULL,
                        'mobileCountryCode' => NULL,
                        'mobileNetworkCode' => NULL,
                        'age'               => NULL,
                        'signalStrength'    => NULL,
                        'timingAdvance'     => NULL,
                    ],
                    'wifiAccessPoints'      => [
                        'macAddress'         => NULL,
                        'signalStrength'     => NULL,
                        'age'                => NULL,
                        'channel'            => NULL,
                        'signalToNoiseRatio' => NULL,
                    ],
                ]
            ],


            'snapToRoads' => [
                'url'                => 'https://roads.googleapis.com/v1/snapToRoads?',
                'type'               => 'GET',
                'key'                => NULL,
                'endpoint'           => FALSE,
                'responseDefaultKey' => 'snappedPoints',
                'param'              => [
                    'locations' => NULL,
                    'path'      => NULL,
                    'samples'   => NULL,
                    'key'       => NULL,
                ]
            ],


            'speedLimits' => [
                'url'                => 'https://roads.googleapis.com/v1/speedLimits?',
                'type'               => 'GET',
                'key'                => NULL,
                'endpoint'           => FALSE,
                'responseDefaultKey' => 'speedLimits',
                'param'              => [
                    'path'    => NULL,
                    'placeId' => NULL,
                    'units'   => NULL,
                    'key'     => NULL,
                ]
            ],


            'timezone' => [
                'url'                => 'https://maps.googleapis.com/maps/api/timezone/',
                'type'               => 'GET',
                'key'                => NULL,
                'endpoint'           => TRUE,
                'responseDefaultKey' => 'dstOffset',
                'param'              => [
                    'location'  => NULL,
                    'timestamp' => NULL,
                    'key'       => NULL,
                    'language'  => NULL,

                ]
            ],


            'nearbysearch' => [
                'url'                => 'https://maps.googleapis.com/maps/api/place/nearbysearch/',
                'type'               => 'GET',
                'key'                => NULL,
                'endpoint'           => TRUE,
                'responseDefaultKey' => 'results',
                'param'              => [
                    'key'           => NULL,
                    'location'      => NULL,
                    'radius'        => NULL,
                    'keyword'       => NULL,
                    'language'      => NULL,
                    'minprice'      => NULL,
                    'maxprice'      => NULL,
                    'name'          => NULL,
                    'opennow'       => NULL,
                    'rankby'        => NULL,
                    'type'          => NULL, // types depricated, one type may be specified
                    'pagetoken'     => NULL,
                    'zagatselected' => NULL,
                ]
            ],


            'textsearch' => [
                'url'                => 'https://maps.googleapis.com/maps/api/place/textsearch/',
                'type'               => 'GET',
                'key'                => NULL,
                'endpoint'           => TRUE,
                'responseDefaultKey' => 'results',
                'param'              => [
                    'key'           => NULL,
                    'query'         => NULL,
                    'location'      => NULL,
                    'radius'        => NULL,
                    'language'      => NULL,
                    'minprice'      => NULL,
                    'maxprice'      => NULL,
                    'opennow'       => NULL,
                    'type'          => NULL, // types deprecated, one type may be specified
                    'pagetoken'     => NULL,
                    'zagatselected' => NULL,
                ]
            ],


            'radarsearch' => [
                'url'                => 'https://maps.googleapis.com/maps/api/place/radarsearch/',
                'type'               => 'GET',
                'key'                => NULL,
                'endpoint'           => TRUE,
                'responseDefaultKey' => 'geometry',
                'param'              => [
                    'key'           => NULL,
                    'radius'        => NULL,
                    'location'      => NULL,
                    'keyword'       => NULL,
                    'minprice'      => NULL,
                    'maxprice'      => NULL,
                    'opennow'       => NULL,
                    'name'          => NULL,
                    'type'          => NULL, // types depricated, one type may be specified
                    'zagatselected' => NULL,
                ]
            ],


            'placedetails' => [
                'url'                => 'https://maps.googleapis.com/maps/api/place/details/',
                'type'               => 'GET',
                'key'                => NULL,
                'endpoint'           => TRUE,
                'responseDefaultKey' => 'result',
                'param'              => [
                    'key'        => NULL,
                    'placeid'    => NULL,
                    'extensions' => NULL,
                    'language'   => NULL,
                ]
            ],


            'placeadd' => [
                'url'                => 'https://maps.googleapis.com/maps/api/place/add/',
                'type'               => 'POST',
                'key'                => NULL,
                'endpoint'           => TRUE,
                'responseDefaultKey' => 'place_id',
                'param'              => [
                    'key'          => NULL,
                    'accuracy'     => NULL,
                    'address'      => NULL,
                    'language'     => NULL,
                    'location'     => NULL,
                    'name'         => NULL,
                    'phone_number' => NULL,
                    'types'        => NULL,// according to docs types still required as string parameter
                    'type'         => NULL, // types deprecated, one type may be specified
                    'website'      => NULL,
                ]
            ],


            'placedelete' => [
                'url'                => 'https://maps.googleapis.com/maps/api/place/delete/',
                'type'               => 'POST',
                'key'                => NULL,
                'endpoint'           => TRUE,
                'responseDefaultKey' => 'status',
                'param'              => [
                    'key'      => NULL,
                    'place_id' => NULL,

                ]
            ],


            'placephoto' => [
                'url'                => 'https://maps.googleapis.com/maps/api/place/photo?',
                'type'               => 'GET',
                'key'                => NULL,
                'endpoint'           => FALSE,
                'responseDefaultKey' => 'image',
                'param'              => [
                    'key'            => NULL,
                    'photoreference' => NULL,
                    'maxheight'      => NULL,
                    'maxwidth'       => NULL,
                ]
            ],


            'placeautocomplete' => [
                'url'                => 'https://maps.googleapis.com/maps/api/place/autocomplete/',
                'type'               => 'GET',
                'key'                => NULL,
                'endpoint'           => TRUE,
                'responseDefaultKey' => 'predictions',
                'param'              => [
                    'key'        => NULL,
                    'input'      => NULL,
                    'offset'     => NULL,
                    'location'   => NULL,
                    'radius'     => NULL,
                    'language'   => NULL,
                    'types'      => NULL, // use string as parameter
                    'type'       => NULL, // types deprecated, one type may be specified
                    'components' => NULL,
                ]
            ],


            'placequeryautocomplete' => [
                'url'                => 'https://maps.googleapis.com/maps/api/place/queryautocomplete/',
                'type'               => 'GET',
                'key'                => NULL,
                'endpoint'           => TRUE,
                'responseDefaultKey' => 'predictions',
                'param'              => [
                    'key'      => NULL,
                    'input'    => NULL,
                    'offset'   => NULL,
                    'location' => NULL,
                    'radius'   => NULL,
                    'language' => NULL,
                ]
            ],

        ],


        /*
        |--------------------------------------------------------------------------
        | End point
        |--------------------------------------------------------------------------
        |
        |
        */

        'endpoint' => [
            'xml'  => 'xml?',
            'json' => 'json?',
        ],


    ];
