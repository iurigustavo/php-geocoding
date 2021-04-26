<?php

    namespace App\Models;

    use Auth;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;
    use OwenIt\Auditing\Auditable;

    use Spatie\Permission\Models\Role;
    use Spatie\Permission\Traits\HasRoles;

    /**
     * App\Models\User
     *
     * @property int                                                                                                            $id
     * @property string                                                                                                         $name
     * @property string                                                                                                         $email
     * @property \Illuminate\Support\Carbon|null                                                                                $email_verified_at
     * @property string                                                                                                         $password
     * @property int                                                                                                            $enabled
     * @property string|null                                                                                                    $last_access
     * @property int|null                                                                                                       $last_role_id
     * @property string|null                                                                                                    $remember_token
     * @property \Illuminate\Support\Carbon|null                                                                                $created_at
     * @property \Illuminate\Support\Carbon|null                                                                                $updated_at
     * @property-read \Illuminate\Database\Eloquent\Collection|\OwenIt\Auditing\Models\Audit[]                                  $audits
     * @property-read int|null                                                                                                  $audits_count
     * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
     * @property-read int|null                                                                                                  $notifications_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[]                           $permissions
     * @property-read int|null                                                                                                  $permissions_count
     * @property-read \Illuminate\Database\Eloquent\Collection|Role[]                                                           $roles
     * @property-read int|null                                                                                                  $roles_count
     * @method static Builder|User newModelQuery()
     * @method static Builder|User newQuery()
     * @method static Builder|User permission($permissions)
     * @method static Builder|User query()
     * @method static Builder|User role($roles, $guard = NULL)
     * @method static Builder|User whereCreatedAt($value)
     * @method static Builder|User whereEmail($value)
     * @method static Builder|User whereEmailVerifiedAt($value)
     * @method static Builder|User whereEnabled($value)
     * @method static Builder|User whereId($value)
     * @method static Builder|User whereLastAccess($value)
     * @method static Builder|User whereLastRoleId($value)
     * @method static Builder|User whereName($value)
     * @method static Builder|User wherePassword($value)
     * @method static Builder|User whereRememberToken($value)
     * @method static Builder|User whereUpdatedAt($value)
     * @mixin \Eloquent
     */
    class User extends Authenticatable
    {
        use HasRoles, Notifiable;


        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'name',
            'email',
            'password',
            'enabled',
            'last_access',
            'last_role_id'
        ];

        /**
         * The attributes that should be hidden for arrays.
         *
         * @var array
         */
        protected $hidden = [
            'password',
            'remember_token',
            'last_access',
            'last_role_id',
        ];

        /**
         * The attributes that should be cast to native types.
         *
         * @var array
         */
        protected $casts = [
            'email_verified_at' => 'datetime',
        ];

        public function lastRole(): BelongsTo
        {
            if ($this->last_role_id == NULL) {
                $this->last_role_id = $this->roles()->first()->id;
                $this->save();
                $this->refresh();
            }

            return $this->belongsTo(Role::class, 'last_role_id', 'id');

        }

        public function changeRole($role_id)
        {
            $this->last_role_id = $role_id;
            $this->save();
            Auth::user()->refresh();
        }

    }
