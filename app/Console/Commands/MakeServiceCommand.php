<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeServiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command Make Service Class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get the name of the service class from the command argument
        $serviceName = $this->argument('name');

        // Check if the Helpers directory exists, if not, create it
        $helpersPath = app_path('Helpers');
        if (!file_exists($helpersPath)) {
            mkdir($helpersPath, 0777, true);
        }

        // Check if the helpers.php file exists, if not, create it
        $helpersFilePath = $helpersPath . '/helpers.php';
        if (!file_exists($helpersFilePath)) {
            file_put_contents($helpersFilePath, '<?php' . PHP_EOL . PHP_EOL);
        }

        // Generate helper function for the service class and add it to helpers.php
        $this->generateServiceHelperFunction($serviceName, $helpersFilePath);

        // Check if the Services directory exists, if not, create it
        $servicesPath = app_path('Services');
        if (!file_exists($servicesPath)) {
            mkdir($servicesPath, 0777, true);
        }

        // Check if the service class already exists
        $serviceClassPath = $servicesPath . '/' . $serviceName . '.php';
        if (file_exists($serviceClassPath)) {
            $this->error('Service class already exists!');
            return 1;
        }

        // Create the service class
        file_put_contents($serviceClassPath, '<?php' . PHP_EOL . 'namespace App\Services;' . PHP_EOL . PHP_EOL . 'class ' . $serviceName . PHP_EOL . '{' . PHP_EOL . '    // Add your service class methods here' . PHP_EOL . '}');

        $this->info('Service class created successfully!');

        return 0;
    }

    private function generateServiceHelperFunction(string $serviceName, string $helpersFilePath)
    {
        $helperName = Str::camel($serviceName);

        // Check if the helper function already exists in helpers.php
        $helperFunction = <<<PHP
if (!function_exists('{$helperName}')) {
    /**
     * Get an instance of the {$serviceName} service class.
     *
     * @return \\App\Services\\{$serviceName}
     */
    function {$helperName}()
    {
        return app(\\App\Services\\{$serviceName}::class);
    }
}

PHP;

        $fileContents = file_get_contents($helpersFilePath);
        if (strpos($fileContents, $helperName) === false) {
            file_put_contents($helpersFilePath, $helperFunction, FILE_APPEND);
        }

        // Optional: You can reload the Composer autoload files to make the helper function immediately available
//        exec('composer dump-autoload');
    }
}
