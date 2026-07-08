<?php

namespace Cable8mm\AuthByKey\Console\Commands;

use Cable8mm\AuthByKey\Console\Traits\ValidatesApiKeyName;
use Cable8mm\AuthByKey\Events\ApiKeyDeleted;
use Cable8mm\AuthByKey\Models\ApiKey;
use Illuminate\Console\Command;

class DeleteApiKey extends Command
{
    use ValidatesApiKeyName;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apikey:delete {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete an API key by name';

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

        $confirmMessage = 'Are you sure you want to delete API key \''.$name.'\'?';

        if (! $this->confirm($confirmMessage)) {
            return;
        }

        $key = ApiKey::where('name', $name)->first();
        $key->delete();

        event(new ApiKeyDeleted($key));

        $this->info('Deleted key: '.$name);
    }
}
