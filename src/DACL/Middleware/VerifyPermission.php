<?php
namespace AleoStudio\DACL\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use AleoStudio\DACL\Exceptions\PermissionDeniedException;


class VerifyPermission
{
    /**
     * @var Guard
     */
    protected $auth;


    /**
     * Create a new filter instance.
     *
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }


    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure $next
     * @param mixed ...$permissions
     * @return mixed
     * @throws PermissionDeniedException
     */
    public function handle($request, Closure $next, ...$permissions)
    {
        $all = filter_var(array_values(array_slice($permissions, -1))[0], FILTER_VALIDATE_BOOLEAN);
        if ($this->auth->check() && $this->auth->user()->may($permissions, $all)) {
            return $next($request);
        }

        throw new PermissionDeniedException(implode(',', $permissions));
    }
}
