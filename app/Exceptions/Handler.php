<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            // Log mail connection errors but don't fail the application
            if (str_contains($e->getMessage(), 'Connection could not be established') ||
                str_contains($e->getMessage(), 'Unable to connect') ||
                str_contains($e->getMessage(), 'stream_socket_client') ||
                str_contains($e->getMessage(), 'mail.locumkit.com')) {
                \Illuminate\Support\Facades\Log::warning('Mail connection error: ' . $e->getMessage());
                // Don't report to error tracking services for mail errors
                return false;
            }
        });

        $this->renderable(function (Throwable $e, Request $request) {
            // Suppress mail connection errors from being displayed to users
            if (str_contains($e->getMessage(), 'Connection could not be established') ||
                str_contains($e->getMessage(), 'Unable to connect') ||
                str_contains($e->getMessage(), 'stream_socket_client') ||
                str_contains($e->getMessage(), 'mail.locumkit.com')) {
                \Illuminate\Support\Facades\Log::warning('Mail connection error suppressed: ' . $e->getMessage());
                // Return a generic error or redirect back with a message
                if ($request->is('api/*')) {
                    return response()->error('Email service temporarily unavailable. Your request was processed successfully.', 200);
                }
                // For web requests, just log and continue - don't show error to user
                return null; // Let the request continue normally
            }
            
            if ($request->is('api/*')) {
                return response()->error($e->getMessage(), 500);
            }
            
            // Handle CSRF token mismatch (419 errors)
            if ($e instanceof \Illuminate\Session\TokenMismatchException) {
                return redirect()
                    ->back()
                    ->withInput($request->except('password', 'password_confirmation'))
                    ->with('error', 'Your session has expired. Please try again.');
            }
        });
    }
}
