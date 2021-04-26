<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Database\Eloquent\SoftDeletes;

    /**
     * App\Models\Client
     *
     * @property int                                                                       $id
     * @property string                                                                    $name
     * @property string                                                                    $email
     * @property string                                                                    $cpf
     * @property string                                                                    $birth_date
     * @property \Illuminate\Support\Carbon|null                                           $created_at
     * @property \Illuminate\Support\Carbon|null                                           $updated_at
     * @property string|null                                                               $deleted_at
     * @method static Builder|Client newModelQuery()
     * @method static Builder|Client newQuery()
     * @method static Builder|Client query()
     * @method static Builder|Client whereBirthDate($value)
     * @method static Builder|Client whereCpf($value)
     * @method static Builder|Client whereCreatedAt($value)
     * @method static Builder|Client whereDeletedAt($value)
     * @method static Builder|Client whereEmail($value)
     * @method static Builder|Client whereId($value)
     * @method static Builder|Client whereName($value)
     * @method static Builder|Client whereUpdatedAt($value)
     * @mixin \Eloquent
     * @method static \Illuminate\Database\Query\Builder|Client onlyTrashed()
     * @method static \Illuminate\Database\Query\Builder|Client withTrashed()
     * @method static \Illuminate\Database\Query\Builder|Client withoutTrashed()
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ClientAddress[] $addresses
     * @property-read int|null                                                             $addresses_count
     */
    class Client extends Model
    {
        use SoftDeletes;

        protected $fillable = ['name', 'email', 'cpf', 'birth_date'];

        public function addresses(): HasMany
        {
            return $this->hasMany(ClientAddress::class, 'client_id', 'id');
        }
    }
