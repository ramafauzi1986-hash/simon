<?php
use Illuminate\Support\Facades\Artisan;
Artisan::command('simon:status', function () { $this->info('SIMON-SETWAN siap dijalankan.'); })->purpose('Check SIMON application status');
