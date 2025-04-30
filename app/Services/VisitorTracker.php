<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;

class VisitorTracker
{
    /**
     * Log file path
     */
    protected $logFile;

    /**
     * Daily count file path
     */
    protected $countFile;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->logFile = storage_path('logs/visitors.log');
        $this->countFile = storage_path('logs/visitor_counts.json');

        // Ensure the log directory exists
        $logDir = dirname($this->logFile);
        if (!File::exists($logDir)) {
            File::makeDirectory($logDir, 0755, true);
        }

        // Create count file if it doesn't exist
        if (!File::exists($this->countFile)) {
            File::put($this->countFile, json_encode([]));
        }
    }

    /**
     * Record a visitor
     */
    public function recordVisit($ip, $userAgent)
    {
        $today = Carbon::now()->toDateString();
        $visitorKey = md5($ip . $userAgent);

        // Get today's visitors
        $dailyLogFile = storage_path("logs/visitors_{$today}.log");

        // Check if this visitor has already been logged today
        if (File::exists($dailyLogFile)) {
            $visitors = explode("\n", File::get($dailyLogFile));
            if (in_array($visitorKey, $visitors)) {
                return; // Already logged today
            }
        }

        // Log the visitor
        File::append($dailyLogFile, $visitorKey . "\n");

        // Log detailed info for debugging if needed
        $logData = [
            'date' => $today,
            'time' => Carbon::now()->toTimeString(),
            'ip' => $ip,
            'ua' => $userAgent,
            'key' => $visitorKey
        ];

        File::append($this->logFile, json_encode($logData) . "\n");

        // Update the count file
        $this->updateCount($today);
    }

    /**
     * Update visitor count for a given date
     */
    protected function updateCount($date)
    {
        $counts = json_decode(File::get($this->countFile), true);

        $dailyLogFile = storage_path("logs/visitors_{$date}.log");
        if (File::exists($dailyLogFile)) {
            $visitors = explode("\n", File::get($dailyLogFile));
            $visitorCount = count(array_filter($visitors));
            $counts[$date] = $visitorCount;
        } else {
            $counts[$date] = 0;
        }

        File::put($this->countFile, json_encode($counts));
    }

    /**
     * Get total unique visitor count
     */
    public function getTotalVisitorCount()
    {
        $counts = json_decode(File::get($this->countFile), true);
        return array_sum($counts);
    }

    /**
     * Get visitor count for a specific date
     */
    public function getVisitorCountForDate($date)
    {
        $counts = json_decode(File::get($this->countFile), true);
        return $counts[$date] ?? 0;
    }

    /**
     * Get visitor counts for a date range
     */
    public function getVisitorCountsByDateRange($days = 7)
    {
        $counts = json_decode(File::get($this->countFile), true);
        $result = [];

        $endDate = Carbon::now();
        $startDate = Carbon::now()->subDays($days - 1);

        while ($startDate->lte($endDate)) {
            $date = $startDate->toDateString();
            $result[$date] = $counts[$date] ?? 0;
            $startDate->addDay();
        }

        return $result;
    }
}
