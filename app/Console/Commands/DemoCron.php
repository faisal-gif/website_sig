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
            $dt = '';
            if (!$notif) {
                if ($d->status === '1') {
                    $dt = 'Kerjasa Sama Sedang Berjalan';
                } elseif ($d->status === '2') {
                    $dt = 'Kerjasa Tidak Memiliki Jangka Wakti';
                } else {
                    $dt = 'Masa Berlaku Kerjasama Sudah Berakhir';
                }
                Notif::create([
                    'kerjasama' => $d->id,
                    'data' => $dt
                ]);
            }


        }
        \Log::info("Cron job Berhasil di jalankan " . date('Y-m-d H:i:s'));

    }
}
