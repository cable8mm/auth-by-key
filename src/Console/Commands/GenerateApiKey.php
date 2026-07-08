<?php

namespace Cable8mm\AuthByKey\Console\Commands;

use Cable8mm\AuthByKey\Console\Traits\ValidatesApiKeyName;
use Cable8mm\AuthByKey\Events\ApiKeyCreated;
use Cable8mm\AuthByKey\Models\ApiKey;
use Illuminate\Console\Command;

class GenerateApiKey extends Command
{
    use ValidatesApiKeyName;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apikey:generate {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new API key';

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

        $apiKey = new ApiKey;
        $apiKey->name = $name;
        $apiKey->key = ApiKey::generate();
        $apiKey->save();

        event(new ApiKeyCreated($apiKey));

        $this->info('API key created');
        $this->info('Name: '.$apiKey->name);
        $this->info('Key: '.$apiKey->key);
    }
}
