<?php

namespace Cable8mm\AuthByKey\Console\Commands;

use Cable8mm\AuthByKey\Console\Traits\ValidatesApiKeyName;
use Cable8mm\AuthByKey\Events\ApiKeyDeactivated;
use Cable8mm\AuthByKey\Models\ApiKey;
use Illuminate\Console\Command;

class DeactivateApiKey extends Command
{
    use ValidatesApiKeyName;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apikey:deactivate {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deactivate an API key by name';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $name = $this->argument('name');

        $error = $this->validateName($name);

        if ($error) {
            $this->error($error);

            return;
        }

        $key = ApiKey::where('name', $name)->first();

        if (! $key->active) {
            $this->info('Key "'.$name.'" is already deactivated');

            return;
        }

        $key->active = 0;
        $key->save();

        event(new ApiKeyDeactivated($key));

        $this->info('Deactivated key: '.$name);
    }
}
