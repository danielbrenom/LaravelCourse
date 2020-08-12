<?php

namespace App\Http\Middleware;

use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Response;
use Illuminate\Routing\Middleware\ThrottleRequests;

class Throttle extends ThrottleRequests
{
    /**
     * Create a 'too many attempts' exception.
     *
     * @param  string  $key
     * @param  int  $maxAttempts
     * @return ThrottleRequestsException
     */
    protected function buildException($key, $maxAttempts)
    {
        $retryAfter = $this->getTimeUntilNextRetry($key);

        $headers = $this->getHeaders(
            $maxAttempts,
            $this->calculateRemainingAttempts($key, $maxAttempts, $retryAfter),
            $retryAfter
        );

        return new ThrottleRequestsException(
            'Too Many Attempts.', null, $headers, Response::HTTP_TOO_MANY_REQUESTS
        );
    }
}
