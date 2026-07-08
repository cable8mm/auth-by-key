<?php

namespace Cable8mm\AuthByKey\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ApiKey extends Model
{
    use SoftDeletes;

    public const EVENT_NAME_CREATED = 'created';

    public const EVENT_NAME_ACTIVATED = 'activated';

    public const EVENT_NAME_DEACTIVATED = 'deactivated';

    public const EVENT_NAME_DELETED = 'deleted';

    protected static $nameRegex = '/^[a-z0-9-]{1,255}$/';

    protected $table = 'api_keys';

    protected $fillable = [
        'name',
        'key',
        'active',
    ];

    /**
     * Generate a secure unique API key
     */
    public static function generate(): string
    {
        $keyLength = config('auth-by-key.key_length', 64);

        do {
            $key = Str::random($keyLength);
        } while (self::keyExists($key));

        return $key;
    }

    /**
     * Get ApiKey record by key value
     *
     * @return static|null
     */
    public static function getByKey(string $key): ?self
    {
        return self::where([
            'key' => $key,
            'active' => 1,
        ])->first();
    }

    /**
     * Check if key is valid
     */
    public static function isValidKey(string $key): bool
    {
        return self::getByKey($key) instanceof self;
    }

    /**
     * Check if name is valid format
     */
    public static function isValidName(string $name): bool
    {
        return (bool) preg_match(self::$nameRegex, $name);
    }

    /**
     * Check if a key already exists
     *
     * Includes soft deleted records
     */
    public static function keyExists(string $key): bool
    {
        return self::where('key', $key)->withTrashed()->first() instanceof self;
    }

    /**
     * Check if a name already exists
     *
     * Does not include soft deleted records
     */
    public static function nameExists(string $name): bool
    {
        return self::where('name', $name)->first() instanceof self;
    }
}
