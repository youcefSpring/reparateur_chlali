<?php

namespace App\Http\Controllers;

use App\Enums\DateFormat;
use App\Http\Requests\GeneralSettingsRequest;
use App\Http\Requests\MailSettingRequest;
use App\Models\GeneralSetting;
use App\Repositories\CurrencyRepository;
use App\Repositories\GeneralSettingRepository;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function generalSettings()
    {
        $generalSettings = GeneralSettingRepository::query()->whereNull('shop_id')->latest()->first();
        $currencies = CurrencyRepository::query()->whereNull('shop_id')->get();
        if ($this->mainShop()) {
            $generalSettings = GeneralSettingRepository::query()->where('shop_id', $this->mainShop()->id)->first();
            $currencies = CurrencyRepository::query()->where('shop_id', $this->mainShop()->id)->get();
        }

        $dateFormats = DateFormat::cases();

        $zones = array();
        $timestamp = time();
        foreach (timezone_identifiers_list() as $key => $zone) {
            date_default_timezone_set($zone);
            $zones[$key]['zone'] = $zone;
            $zones[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
        }
        return view('settings.general', compact('generalSettings', 'zones', 'currencies', 'dateFormats'));
    }

    public function store(GeneralSettingsRequest $request, GeneralSetting $generalSetting)
    {
        if (app()->environment('local')) {
            return back()->with('error', 'This section is not available for demo version!');
        }
        GeneralSettingRepository::updateByRequest($request, $generalSetting);
        if (env('APP_TIMEZONE') != $request->timezone) {
            $this->setEnv('APP_TIMEZONE', $request->timezone);
        }

        return back()->with('success', 'Settings updated successfully!');
    }

    public function mailSettings()
    {
        return view('settings.mail');
    }

    public function mailSettingsStore(MailSettingRequest $request)
    {
        cache()->flush();
        $environmentSet = array(
            'MAIL_MAILER' => 'smtp',
            'MAIL_HOST' => $request->host,
            'MAIL_PORT' => $request->port,
            'MAIL_FROM_ADDRESS' => $request->email_from,
            'MAIL_FROM_NAME' => $request->from_name,
            'MAIL_ENCRYPTION' => $request->encryption,
            'MAIL_USERNAME' => $request->username,
            'MAIL_PASSWORD' => $request->password,
        );

        foreach ($environmentSet as $key => $value) {
            $this->setEnv($key, $value);
        }

        return back()->with('success', 'Mail settings uploaded successfully');
    }

    public function databaseBackup()
    {
        $host = env('DB_HOST');
        $port = env('DB_PORT');
        $database = env('DB_DATABASE');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');

        // Backup database using mysqldump command
        $backupFileName = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
        if(!Storage::disk('local')->exists('backups')){
            Storage::disk('local')->makeDirectory('backups');
        }
        $backupPath = storage_path('app/backups/' . $backupFileName);
        $command = "mysqldump -h {$host} -P {$port} -u {$username} -p{$password} {$database} > {$backupPath}";

        exec($command);

        // Store the backup file in storage
        Storage::disk('local')->put('backups/' . $backupFileName, file_get_contents($backupPath));

        // Return the backup file as a downloadable response
        return response()->download($backupPath)->deleteFileAfterSend(true);
    }

    protected function setEnv($key, $value): bool
    {
        try {
            $envFile = app()->environmentFilePath();
            $str = file_get_contents($envFile);

            // Check if the key exists in the .env file
            if (strpos($str, "{$key}=") === false) {
                $str .= "{$key}=\"{$value}\"\n";
            } else {
                $str = preg_replace("/{$key}=.*/", "{$key}=\"{$value}\"", $str);
            }

            // Trim both key and value to remove leading/trailing whitespaces
            $str = rtrim($str) . "\n";

            // Update the .env file
            file_put_contents($envFile, $str);

            return true;
        } catch (Exception $e) {
            // Log or report the exception
            Log::error("Error updating environment variable: {$e->getMessage()}");
            return false;
        }
    }
}
