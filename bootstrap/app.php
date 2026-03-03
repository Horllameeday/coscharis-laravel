<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->statefulApi();

        // Middleware Aliases
        $middleware->alias([
            'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
            'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
            'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
            'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
            'phone.verified' => \App\Http\Middleware\EnsurePhoneNumberIsVerified::class,
            'token.decrypt' => \App\Http\Middleware\DecryptBearerToken::class,
            'abilities' => \Laravel\Sanctum\Http\Middleware\CheckAbilities::class,
            'ability' => \Laravel\Sanctum\Http\Middleware\CheckForAnyAbility::class,
            'admin.token' => \App\Http\Middleware\EnsureAdminToken::class,
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);

        // Middleware Priority
        $middleware->priority([
            \App\Http\Middleware\ForceJsonResponse::class,
            \App\Http\Middleware\DecryptBearerToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Always return JSON for API routes
        $exceptions->shouldRenderJsonWhen(function (Request $request, Throwable $e) {
            return $request->is('api/*');
        });

        // 401 - Unauthenticated (no token or invalid token)
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json(['message' => 'Unauthenticated. Please log in.'], 401);
            }
        });

        // $exceptions->renderable(function (\Illuminate\Auth\AuthenticationException $ex, $request) {
        //     \Illuminate\Support\Facades\Log::warning('Exception: Authentication Error', [
        //         'exception' => get_class($ex),
        //         'message' => $ex->getMessage(),
        //         'route' => $request->path(),
        //     ]);

        //     return response()->json($ex->getMessage() ?? 'Authentication Failed', \Illuminate\Http\Response::HTTP_FORBIDDEN);
        // });

        // 404 - Route not found
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json(['message' => 'Resource not found'], 404);
            }
        });

        // 405 - Method not allowed
        $exceptions->render(function (MethodNotAllowedHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json(['message' => 'Method not allowed'], 405);
            }
        });
    })->create();
