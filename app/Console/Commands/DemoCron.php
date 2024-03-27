<?php

namespace App\Console\Commands;

use App\Models\DuDi;
use App\Models\Kerjasama;
use App\Models\Notif;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {


        $expired = Carbon::now();
        $dudi = Kerjasama::where('selesai_pks', '<=', $expired)->get();
        foreach ($dudi as $d) {
            $d->status = 'selesai';
            $d->save();
            $notif = Notif::where('kerjasama', $d->id)->first();
            if (!$notif) {
                Notif::create([
                    'kerjasama' => $d->id,
                    'data' => 'Masa Berlaku Kerjasama Sudah Berakhir'
                ]);
            }


        }
        \Log::info("Cron job Berhasil di jalankan " . date('Y-m-d H:i:s'));

    }
}
