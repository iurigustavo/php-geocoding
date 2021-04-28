<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    /**
     * App\Models\RouteAddress
     *
     * @method static Builder|RouteAddress newModelQuery()
     * @method static Builder|RouteAddress newQuery()
     * @method static Builder|RouteAddress query()
     * @mixin \Eloquent
     * @property int                             $id
     * @property int                             $route_id
     * @property int                             $client_address_id
     * @property float|null                      $distance
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @method static Builder|RouteAddress whereClientAddressId($value)
     * @method static Builder|RouteAddress whereCreatedAt($value)
     * @method static Builder|RouteAddress whereDistance($value)
     * @method static Builder|RouteAddress whereId($value)
     * @method static Builder|RouteAddress whereRouteId($value)
     * @method static Builder|RouteAddress whereUpdatedAt($value)
     * @property-read \App\Models\ClientAddress  $clientAddress
     */
    class RouteAddress extends Model
    {
        use HasFactory;

        protected $table    = 'routes_addresses';
        protected $fillable = ['route_id', 'client_address_id', 'distance'];

        public function clientAddress()
        {
            return $this->belongsTo(ClientAddress::class, 'client_address_id', 'id');
        }
    }
