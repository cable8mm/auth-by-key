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
     * Encrypt API key for storage
     */
    private static function encryptKey(string $key): string
    {
        return encrypt($key);
    }

    /**
     * Decrypt API key from storage
     */
    private static function decryptKey(string $encryptedKey): string
    {
        return decrypt($encryptedKey);
    }

    /**
     * Generate a secure unique API key
     */
    public static function generate(): string
    {
        $keyLength = config('auth-by-key.key_length', 64);
        $maxAttempts = 10;

        for ($i = 0; $i < $maxAttempts; $i++) {
            $key = Str::random($keyLength);
            $encryptedKey = self::encryptKey($key);

            if (! self::keyExists($encryptedKey)) {
                return $key;
            }
        }

        throw new \RuntimeException('Unable to generate unique API key after '.$maxAttempts.' attempts');
    }

    /**
     * Get ApiKey record by key value
     *
     * @return static|null
     */
    public static function getByKey(string $key): ?self
    {
        $encryptedKey = self::encryptKey($key);

        return self::where([
            'key' => $encryptedKey,
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
        $encryptedKey = self::encryptKey($key);

        return self::where('key', $encryptedKey)->withTrashed()->first() instanceof self;
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
