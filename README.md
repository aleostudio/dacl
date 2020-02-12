# Dynamic access control list for Laravel 6

After several years playing with roles and permissions with Laravel 5 and 6, 
I decided to write a new package mixing the best ideas from the other 
existing packages, in particular the old (and deprecated) 
**RBAC Package for Laravel 5.1 by DCNinja** and **Laravel-permissions by spatie**.

Soon the complete README with all the methods (it still is under construction)...

---

- If you want to install the package, run:
~~~
composer install aleostudio/dacl
~~~


- Add in your **config/app.php** the service provider under **providers**:
~~~
'providers' => [
    Illuminate\Foundation\Providers\ArtisanServiceProvider::class,
    Illuminate\Auth\AuthServiceProvider::class,
    ...

    AleoStudio\DACL\DACLServiceProvider::class
],
~~~


- Publish the config and the migrations with:
~~~
php artisan vendor:publish --provider="AleoStudio\DACL\DACLServiceProvider" --tag=config
php artisan vendor:publish --provider="AleoStudio\DACL\DACLServiceProvider" --tag=migrations
~~~


- Last thing to do, add these lines and traits to your **User model**:
~~~
...
use AleoStudio\DACL\Traits\HasRoleAndPermission;
use AleoStudio\DACL\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract, HasRoleAndPermissionContract
{
    use Authenticatable, CanResetPassword, HasRoleAndPermission;
~~~ 


- And finally, you can run the migrations with:
~~~
php artisan migrate
~~~

# 
 

If you want to use the master version to customize locally, run:
~~~
git clone git@github.com:aleostudio/dacl.git
~~~

Then, add in your Laravel **composer.json** the local repository, by specifying the right path, and the dev-master package:
~~~
"require": {
    "php": "^7.2",
    ...
    "aleostudio/dacl": "dev-master",
},
"repositories": [
    ...
    {
        "type": "path",
        "url": "../your/DACL/path"
    }
]
~~~

Now you can run **composer install** and follow the instructions above.

Enjoy!