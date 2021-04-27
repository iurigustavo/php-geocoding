<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    /**
     * App\Models\Import
     *
     * @property int                             $id
     * @property string                          $path
     * @property int                             $total_rows
     * @property int                             $processed
     * @property int                             $user_id
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @method static Builder|Import newModelQuery()
     * @method static Builder|Import newQuery()
     * @method static Builder|Import query()
     * @method static Builder|Import whereCreatedAt($value)
     * @method static Builder|Import whereId($value)
     * @method static Builder|Import wherePath($value)
     * @method static Builder|Import whereProcessed($value)
     * @method static Builder|Import whereTotalRows($value)
     * @method static Builder|Import whereUpdatedAt($value)
     * @method static Builder|Import whereUserId($value)
     * @mixin \Eloquent
     * @method static Builder|Import notProcessed()
     */
    class Import extends Model
    {
        use HasFactory;

        protected $fillable = ['path', 'total_rows', 'processed', 'user_id'];

        public function scopeNotProcessed(Builder $query)
        {
            return $this->where('processed', '=', FALSE);
        }
    }
