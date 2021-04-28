<?php


    namespace App\Actions\Routes;


    use App\Classes\GeoLocation;
    use App\Models\ClientAddress;
    use App\Models\Route;
    use App\Models\RouteAddress;
    use JetBrains\PhpStorm\Pure;
    use Ramsey\Uuid\Uuid;

    class CreateRoute
    {
        /**
         * CreateRoute constructor.
         *
         * @param  \App\Models\RouteAddress[]  $addresses
         */
        public function __construct(
            private array $addresses
        ) {
        }


        #[Pure] public static function fromArray(array $addresses): self
        {
            return new static(
                addresses: $addresses,
            );
        }

        public function handle(): Route
        {

            $clientsAddresses = ClientAddress::whereIn('id', $this->addresses)->get();

            foreach ($clientsAddresses as $clientsAddress) {
                $distance[$clientsAddress->id] = [
                    'distance' => GeoLocation::vincentyGreatCircleDistance(config('googlemaps.start_point.lat'), config('googlemaps.start_point.lng'), $clientsAddress->lat, $clientsAddress->lng),
                    'address'  => $clientsAddress->toArray()
                ];
            }
            $colDistance = collect($distance)->sortBy('distance');
            $wayPoints   = [];

            $routes           = [];
            $routes['origin'] = [
                'lat' => config('googlemaps.start_point.lat'),
                'lng' => config('googlemaps.start_point.lng')
            ];

            $routes['destination'] = [
                'address_id' => $colDistance->last()['address']['id'],
                'lat'        => $colDistance->last()['address']['lat'],
                'lng'        => $colDistance->last()['address']['lng']
            ];

            foreach ($colDistance as &$item) {
                if ($item['address']['place_id'] == $colDistance->last()['address']['place_id']) {
                    unset($item);
                    continue;
                }
                $wayPoints[] = [
                    'address_id' => $item['address']['id'],
                    'lat'        => $item['address']['lat'],
                    'lng'        => $item['address']['lng']
                ];
            }

            $routes['waypoints'] = $wayPoints;

            $route = new Route([
                'uuid'  => Uuid::uuid4(),
                'route' => $routes,
            ]);

            $route->save();
            foreach ($clientsAddresses as $clientsAddress) {
                $routeAddress                    = new RouteAddress();
                $routeAddress->route_id          = $route->id;
                $routeAddress->client_address_id = $clientsAddress->id;
                $routeAddress->distance          = GeoLocation::vincentyGreatCircleDistance(config('googlemaps.start_point.lat'), config('googlemaps.start_point.lng'), $clientsAddress->lat, $clientsAddress->lng);
                $routeAddress->save();
            }

            return $route;
        }
    }