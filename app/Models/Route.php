<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    /**
     * App\Models\Routes
     *
     * @property int                                                                      $id
     * @property string                                                                   $uuid
     * @property mixed                                                                    $route
     * @property \Illuminate\Support\Carbon|null                                          $created_at
     * @property \Illuminate\Support\Carbon|null                                          $updated_at
     * @property string|null                                                              $deleted_at
     * @method static Builder|Route newModelQuery()
     * @method static Builder|Route newQuery()
     * @method static Builder|Route query()
     * @method static Builder|Route whereCreatedAt($value)
     * @method static Builder|Route whereDeletedAt($value)
     * @method static Builder|Route whereId($value)
     * @method static Builder|Route whereRoute($value)
     * @method static Builder|Route whereUpdatedAt($value)
     * @method static Builder|Route whereUuid($value)
     * @mixin \Eloquent
     * @method static \Illuminate\Database\Query\Builder|Route onlyTrashed()
     * @method static \Illuminate\Database\Query\Builder|Route withTrashed()
     * @method static \Illuminate\Database\Query\Builder|Route withoutTrashed()
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RouteAddress[] $addresses
     * @property-read int|null                                                            $addresses_count
     */
    class Route extends Model
    {
        use HasFactory;
        use SoftDeletes;

        protected $casts    = [
            'route' => 'array'
        ];
        protected $fillable = ['uuid', 'route'];

        public function addresses()
        {
            return $this->hasMany(RouteAddress::class, 'route_id', 'id')->orderBy('distance', 'asc');
        }
    }
