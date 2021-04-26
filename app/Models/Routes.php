<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    /**
     * App\Models\Routes
     *
     * @property int                             $id
     * @property string                          $uuid
     * @property mixed                           $route
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property string|null                     $deleted_at
     * @method static Builder|Routes newModelQuery()
     * @method static Builder|Routes newQuery()
     * @method static Builder|Routes query()
     * @method static Builder|Routes whereCreatedAt($value)
     * @method static Builder|Routes whereDeletedAt($value)
     * @method static Builder|Routes whereId($value)
     * @method static Builder|Routes whereRoute($value)
     * @method static Builder|Routes whereUpdatedAt($value)
     * @method static Builder|Routes whereUuid($value)
     * @mixin \Eloquent
     */
    class Routes extends Model
    {
        use HasFactory;
        use SoftDeletes;

        protected $fillable = ['uuid', 'route'];
    }
