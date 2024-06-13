<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class PassportInstallController extends Controller
{
    public function index()
    {
        try {
            shell_exec('php ../artisan passport:install');
            Artisan::call('storage:link');
            return back()->with('success', 'Passport installed successfully.');
        } catch (\Throwable $th) {

            return back()->with('error', 'Passport not installed beacause' . $th->getMessage());
        }
    }
    public function seederRun()
    {
        try {
            Artisan::call('migrate:fresh --seed --force');
            Artisan::call('storage:link');
            return back()->with('success', 'Successfully restored is necessary data.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Seeder not runed beacause ' . $th->getMessage());
        }
    }
    public function storageInstall()
    {
        try {
            Artisan::call('storage:link');
            return back()->with('success', 'Storage linked is successfully.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Storage not linked beacause ' . $th->getMessage());
        }
    }
}
