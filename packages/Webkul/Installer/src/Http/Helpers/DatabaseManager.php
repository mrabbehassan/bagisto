<?php

namespace Webkul\Installer\Http\Helpers;

use Exception;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\BufferedOutput;

class DatabaseManager
{
    /**
     * Migrate and seed the database.
     *
     * @return array
     */
    public function migrateAndSeed()
    {
        $outputLog = new BufferedOutput;

        $this->sqlite($outputLog);

        return $this->migrate($outputLog);
    }

    // public function getEnvironment($params = [])
    // {
    //     dd(env("DB_HOST"));
    //     $connection = [
    //         'DB_HOST' => $params['DB_HOST'] ?? env("DB_HOST"),
    //         'DB_DATABASE' => $params['DB_DATABASE'] ?? env("DB_DATABASE"),
    //         'DB_USERNAME' => $params['DB_USERNAME'] ?? env("DB_USERNAME"),
    //         'DB_PASSWORD' => $params['DB_PASSWORD'] ?? env("DB_PASSWORD"),
    //         'DB_CONNECTION' => $params['DB_CONNECTION'] ?? env("DB_CONNECTION"),
    //         'DB_PORT' => $params['DB_PORT'] ?? env("DB_PORT"),
    //         'DB_PREFIX' => $params['DB_PREFIX'] ?? env("DB_PREFIX")
    //     ];

    //     dd($connection);


    //     try {
    //         $database = DB::connection()->getDatabaseName();
    //         if (! file_exists($database)) {
    //             touch($database);
    //             DB::reconnect(Config::get('database.default'));

    //             return $connection;
    //         }
    //     } catch (\Throwable $th) {
    //         dd($th);
    //     }
    // }
    
    // use Illuminate\Support\Facades\DB;
    public function getEnvironment($params = [])
    {

        try {
            DB::connection()->getPdo();
            if (DB::connection()->getDatabaseName()) {
                echo "Database connection established successfully.";
            } else {
                echo "Database not found.";
            }
        } catch (\Exception $e) {
        }

        // $defaultEnv = [
        //     'DB_HOST' => env('DB_HOST'),
        //     'DB_DATABASE' => env('DB_DATABASE'),
        //     'DB_USERNAME' => env('DB_USERNAME'),
        //     'DB_PASSWORD' => env('DB_PASSWORD'),
        //     'DB_CONNECTION' => env('DB_CONNECTION'),
        //     'DB_PORT' => env('DB_PORT'),
        //     'DB_PREFIX' => env('DB_PREFIX'),
        // ];

        // $connection = array_merge($defaultEnv, $params);

        // try {
        //     $database = DB::connection()->getDatabaseName();
        //     if (! file_exists($database)) {
        //         DB::reconnect(Config::get('database.default'));
        //     }
        // } catch (\Throwable $th) {
        //     dd($th);
        // }
        // dd($connection);

        // return $connection;
    }


    /**
     * Run the migration and call the seeder.
     *
     * @param \Symfony\Component\Console\Output\BufferedOutput $outputLog
     * @return array
     */
    private function migrate(BufferedOutput $outputLog)
    {
        try {
            Artisan::call('migrate', ['--force'=> true], $outputLog);
        } catch (Exception $e) {
            return $this->response($e->getMessage(), 'error', $outputLog);
        }

        return $this->seed($outputLog);
    }

    /**
     * Seed the database.
     *
     * @param \Symfony\Component\Console\Output\BufferedOutput $outputLog
     * @return array
     */
    private function seed(BufferedOutput $outputLog)
    {
        try {
            Artisan::call('db:seed', ['--force' => true], $outputLog);
        } catch (Exception $e) {
            return $this->response($e->getMessage(), 'error', $outputLog);
        }

        return $this->response(trans('installer_messages.final.finished'), 'success', $outputLog);
    }

    /**
     * Return a formatted error messages.
     *
     * @param string $message
     * @param string $status
     * @param \Symfony\Component\Console\Output\BufferedOutput $outputLog
     * @return array
     */
    private function response($message, $status, BufferedOutput $outputLog)
    {
        return [
            'status' => $status,
            'message' => $message,
            'dbOutputLog' => $outputLog->fetch(),
        ];
    }

    /**
     * Check database type. If SQLite, then create the database file.
     *
     * @param \Symfony\Component\Console\Output\BufferedOutput $outputLog
     */
    private function sqlite(BufferedOutput $outputLog)
    {
        if (DB::connection() instanceof SQLiteConnection) {
            $database = DB::connection()->getDatabaseName();
            if (! file_exists($database)) {
                touch($database);
                DB::reconnect(Config::get('database.default'));
            }
            $outputLog->write('Using SqlLite database: '.$database, 1);
        }
    }
}