<?php
namespace AleoStudio\DACL\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use AleoStudio\DACL\Exceptions\RoleDeniedException;


class VerifyRole
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
     * @param array $roles
     * @return mixed
     * @throws RoleDeniedException
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $all = filter_var(array_values(array_slice($roles, -1))[0], FILTER_VALIDATE_BOOLEAN);
        if ($this->auth->check() && $this->auth->user()->roleIs($roles, $all)) {
            return $next($request);
        }

        throw new RoleDeniedException(implode(',', $roles));
    }
}
