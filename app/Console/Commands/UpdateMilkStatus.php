<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Milk;
use Carbon\Carbon;

class UpdateMilkStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'milk:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update milk_Status based on stage start/end datetimes (runs from scheduler).';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        $milks = Milk::all();
        $updated = 0;

        foreach ($milks as $milk) {
            // Helper closure to parse date+time into Carbon or null
            $makeDT = function ($date, $time) {
                if (!$date || !$time) return null;
                try {
                    $t = strlen($time) === 5 ? $time . ':00' : $time;
                    return Carbon::parse($date . ' ' . $t);
                } catch (\Exception $e) {
                    return null;
                }
            };

            // Stage 3 (Distributing)
            $s3 = $makeDT($milk->milk_stage3StartDate, $milk->milk_stage3StartTime);
            $e3 = $makeDT($milk->milk_stage3EndDate, $milk->milk_stage3EndTime);

            if ($s3 || $e3) {
                // If both start and end exist
                if ($s3 && $e3) {
                    if ($now->lt($s3)) {
                        // Not started yet: do not overwrite previous status here
                    } elseif ($now->between($s3, $e3, false)) {
                        if ($milk->milk_Status !== 'Distributing') {
                            $milk->update(['milk_Status' => 'Distributing']);
                            $updated++;
                        }
                    } elseif ($now->gte($e3)) {
                        if ($milk->milk_Status !== 'Distributing Completed') {
                            $milk->update(['milk_Status' => 'Distributing Completed']);
                            $updated++;
                        }
                    }
                    continue; // stage 3 takes precedence
                }

                // If start exists but no end, and now >= start => in-progress
                if ($s3 && !$e3 && $now->gte($s3)) {
                    if ($milk->milk_Status !== 'Distributing') {
                        $milk->update(['milk_Status' => 'Distributing']);
                        $updated++;
                    }
                    continue;
                }
            }

            // Stage 2 (Labelling) - only if stage3 not present/handled
            $s2 = $makeDT($milk->milk_stage2StartDate, $milk->milk_stage2StartTime);
            $e2 = $makeDT($milk->milk_stage2EndDate, $milk->milk_stage2EndTime);

            if ($s2 || $e2) {
                if ($s2 && $e2) {
                    if ($now->lt($s2)) {
                        // not started
                    } elseif ($now->between($s2, $e2, false)) {
                        if ($milk->milk_Status !== 'Labelling') {
                            $milk->update(['milk_Status' => 'Labelling']);
                            $updated++;
                        }
                    } elseif ($now->gte($e2)) {
                        if ($milk->milk_Status !== 'Labelling Completed') {
                            $milk->update(['milk_Status' => 'Labelling Completed']);
                            $updated++;
                        }
                    }
                    continue;
                }

                if ($s2 && !$e2 && $now->gte($s2)) {
                    if ($milk->milk_Status !== 'Labelling') {
                        $milk->update(['milk_Status' => 'Labelling']);
                        $updated++;
                    }
                    continue;
                }
            }

            // Stage 1 (Screening) - fallback
            $s1 = $makeDT($milk->milk_stage1StartDate, $milk->milk_stage1StartTime);
            $e1 = $makeDT($milk->milk_stage1EndDate, $milk->milk_stage1EndTime);

            if ($s1 || $e1) {
                if ($s1 && $e1) {
                    if ($now->lt($s1)) {
                        // not started
                    } elseif ($now->between($s1, $e1, false)) {
                        if ($milk->milk_Status !== 'Screening') {
                            $milk->update(['milk_Status' => 'Screening']);
                            $updated++;
                        }
                    } elseif ($now->gte($e1)) {
                        if ($milk->milk_Status !== 'Screening Completed') {
                            $milk->update(['milk_Status' => 'Screening Completed']);
                            $updated++;
                        }
                    }
                    continue;
                }

                if ($s1 && !$e1 && $now->gte($s1)) {
                    if ($milk->milk_Status !== 'Screening') {
                        $milk->update(['milk_Status' => 'Screening']);
                        $updated++;
                    }
                    continue;
                }
            }
        }

        $this->info("milk:update-status finished — updated {$updated} records.");
        return 0;
    }
}
