<?php
namespace App\Http\Middleware;

use Closure;
use App\Services\VisitorTracker;
use Illuminate\Http\Request;
use Throwable;

class TrackVisits
{
    protected $visitorTracker;

    public function __construct(VisitorTracker $visitorTracker)
    {
        $this->visitorTracker = $visitorTracker;
    }

    public function handle(Request $request, Closure $next)
    {
        try{
            // Skip tracking for bots, API calls, or admin routes if needed
            if (!$this->shouldTrack($request)) {
                return $next($request);
            }

            // Record the visit
            $this->visitorTracker->recordVisit(
                $request->ip(),
                $request->userAgent()
            );
        }catch(Throwable $e)
        {
            return $next($request);
        }

        return $next($request);
    }

    protected function shouldTrack(Request $request)
    {
        // Skip API routes
        if ($request->is('api/*')) {
            return false;
        }

        // Skip admin routes
        if ($request->is('admin/*')) {
            return false;
        }
        // Skip tracking for common bot user agents
        $userAgent = $request->userAgent();
        $botPatterns = [
            'bot', 'spider', 'crawl', 'slurp', 'bingbot', 'googlebot',
            'yandex', 'baidu', 'rogerbot', 'facebookexternalhit'
        ];

        foreach ($botPatterns as $pattern) {
            if (stripos($userAgent, $pattern) !== false) {
                return false;
            }
        }

        return true;
    }
}
