<?php

namespace App\Services;

use GuzzleHttp\Client;

class GoogleDirectionsApi {

    private $googleApiKey = 'AIzaSyAqACoKPqvIrZ1EQp-njyExDg0oYaG_64o';
//
//    public function __construct($googleApiKey) {
//        $this->googleApiKey = $googleApiKey;
//    }

    public function getDirections($start, $destination, $via=null) {

        $client = new Client();

        $url  = 'https://maps.googleapis.com/maps/api/directions/json?';
        $url .= 'origin=' . $start;
        $url .= '&destination=' . $destination;
        $url .= '&waypoints=' . $via;
        $url .= '&units=imperial';
        $url .= '&mode=driving';
        $url .= '&key=' . $this->googleApiKey;

        $res = $client->get($url);

        //need to handle this error with a catch
        if ($res->getStatusCode() !== 200) {
            return false;
        }

        return json_decode($res->getBody()->getContents(), true);
    }

    public function getRouteDetails($start, $destination, $via=null) {
        //make our API call
        $directions = $this->getDirections($start, $destination, $via);
        // there should always only be one route but we are passed an array.
        // loop through array
        $route = [];
        $polyline = '';
        foreach ($directions['routes'] as $route) {
            $polyline = $route['overview_polyline']['points'];
            foreach ($route['legs'] as $leg) {
                $route = $leg;
                //because we are only handling one leg at the minute
                //needs sorting for when we are handling multiple legs
            }
        }
        return [$route, $polyline];
    }

    public function convertMetersToMiles($meters) {
        return round($meters * 0.000621371);
    }
}