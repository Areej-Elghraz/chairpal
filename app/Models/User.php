<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verification_code',
        'email_verification_times_sent',
        'email_verification_code_expires_at',
        'email_verified_at',
        'password',
        'password_set',
        // 'provider_id',
        // 'provider_name',
        'language',
        'role',
        // user
        'phone',
        'age',
        'follow_doctor',
        // organization
        'location',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'provider_id',
        'provider_name',
        'password_set',
        'remember_token',
        'email_verification_code',
        'email_verification_times_sent',
        'email_verification_code_expires_at',
        'provider_token',
        'provider_refresh_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at'                  => 'datetime',
            'email_verification_code_expires_at' => 'datetime',
            'password'                           => 'hashed',
            'email_verification_code'            => 'hashed',
            'language'                           => \App\Enums\LanguagePreferenceEnum::class,
        ];
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d M Y - h:i A');
    }

    public function organizations(): HasMany
    {
        return $this->hasMany(Organization::class, 'owner_id');
    }

    public function organizationRoleOrganization()
    {
        if ($this->isOrganization()) {
            return $this->organizations()->first();
        }

        return null;
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class, 'owner_id');
    }

    public function places(): HasMany
    {
        return $this->hasMany(Place::class, 'owner_id');
    }

    public function isUser(): bool
    {
        return $this->role === \App\Enums\UserRoleEnum::USER->value;
    }

    public function isOrganization(): bool
    {
        return $this->role === \App\Enums\UserRoleEnum::ORGANIZATION->value;
    }

    public function isAdmin(): bool
    {
        return $this->role === \App\Enums\UserRoleEnum::ADMIN->value;
    }

    public function getImageAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function favoritePlaces()
    {
        return $this->morphedByMany(Place::class, 'favoritable', 'favorites')->withTimestamps();
    }

    public function favoriteOrganizations()
    {
        return $this->morphedByMany(Organization::class, 'favoritable', 'favorites')->withTimestamps();
    }

    public function visitedPlaces()
    {
        return $this->morphedByMany(Place::class, 'visitable', 'visitors')->withTimestamps();
    }

    public function visitedOrganizations()
    {
        return $this->morphedByMany(Organization::class, 'visitable', 'visitors')->withTimestamps();
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function hiddenPosts()
    {
        return $this->belongsToMany(Post::class, 'hidden_posts')->withTimestamps();
    }

    public function chatSessions()
    {
        return $this->hasMany(ChatSession::class);
    }

    public function eChairs(): HasMany
    {
        return $this->hasMany(EChair::class, 'assigned_to_user_id');
    }

    public function emergencyContacts(): HasMany
    {
        return $this->hasMany(EmergencyContact::class);
    }
}
