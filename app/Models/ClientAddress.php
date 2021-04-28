<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    /**
 * App\Models\ClientAddress
 *
 * @method static Builder|ClientAddress newModelQuery()
 * @method static Builder|ClientAddress newQuery()
 * @method static Builder|ClientAddress query()
 * @mixin \Eloquent
 * @property int                             $id
 * @property string                          $street_address
 * @property string|null                     $number
 * @property string|null                     $complement
 * @property string|null                     $neighborhood
 * @property string                          $zipcode
 * @property string                          $city
 * @property string                          $state
 * @property int                             $client_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Query\Builder|ClientAddress onlyTrashed()
 * @method static Builder|ClientAddress whereCity($value)
 * @method static Builder|ClientAddress whereClientId($value)
 * @method static Builder|ClientAddress whereComplement($value)
 * @method static Builder|ClientAddress whereCreatedAt($value)
 * @method static Builder|ClientAddress whereDeletedAt($value)
 * @method static Builder|ClientAddress whereId($value)
 * @method static Builder|ClientAddress whereNeighborhood($value)
 * @method static Builder|ClientAddress whereNumber($value)
 * @method static Builder|ClientAddress whereState($value)
 * @method static Builder|ClientAddress whereStreetAddress($value)
 * @method static Builder|ClientAddress whereUpdatedAt($value)
 * @method static Builder|ClientAddress whereZipcode($value)
 * @method static \Illuminate\Database\Query\Builder|ClientAddress withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ClientAddress withoutTrashed()
 * @property-read \App\Models\Client         $client
 * @property float|null                      $lat
 * @property float|null                      $lng
 * @property string|null                     $place_id
 * @method static Builder|ClientAddress whereLat($value)
 * @method static Builder|ClientAddress whereLng($value)
 * @method static Builder|ClientAddress wherePlaceId($value)
 * @property-read mixed $full_address
 */
    class ClientAddress extends Model
    {
        use SoftDeletes;

        protected $table    = 'clients_addresses';
        protected $fillable = ['street_address', 'number', 'complement', 'neighborhood', 'zipcode', 'city', 'state', 'lat', 'lng', 'place_id', 'client_id'];
        protected $appends = ['full_address'];

        public function client()
        {
            return $this->belongsTo(Client::class, 'client_id', 'id');
        }

        public function getFullAddressAttribute()
        {
            return str_replace("  ", " ", "{$this->street_address}, {$this->number} {$this->complement} - {$this->neighborhood} - {$this->city} - {$this->state} - $this->zipcode");

        }

    }
