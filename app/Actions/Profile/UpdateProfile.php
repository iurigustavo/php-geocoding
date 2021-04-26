<?php


    namespace App\Actions\Profile;


    use App\Events\EmailAddressWasChanged;
    use App\Http\Requests\User\UpdateProfileRequest;
    use App\Models\User;
    use Illuminate\Support\Arr;

    class UpdateProfile
    {


        public function __construct(private User $user, private array $attributes = [])
        {
            $this->attributes = Arr::only($attributes, ['name', 'email', 'password']);
        }

        public static function fromRequest(User $user, UpdateProfileRequest $request): self
        {
            return new static(
                user: $user,
                attributes: [
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => $request->password,
            ]);
        }

        public function handle(): User
        {
            $emailAddress = $this->user->email;

            if ($this->user->password != $this->attributes['password']) {
                $this->attributes['password'] = bcrypt($this->$this->attributes['password']);
            }
            $this->user->update($this->attributes);

            if ($emailAddress !== $this->user->email) {
                $this->user->email_verified_at = NULL;
                $this->user->save();

                event(new EmailAddressWasChanged($this->user));
            }

            return $this->user;
        }

    }