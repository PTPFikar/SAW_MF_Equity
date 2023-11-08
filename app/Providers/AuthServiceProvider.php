<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Products;
use App\Models\Risks;
use App\Policies\CriteriaPolicy;
use Illuminate\Support\Facades\Gate;
use App\Policies\ProductsPolicy;
use App\Policies\RisksPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
  /**
   * The policy mappings for the application.
   *
   * @var array<class-string, class-string>
   */
  protected $policies = [
    Products::class => ProductsPolicy::class,
    Criteria::class => CriteriaPolicy::class,
    Risks::class => RisksPolicy::class,
    User::class => UserPolicy::class,
  ];

  /**
   * Register any authentication / authorization services.
   *
   * @return void
   */
  public function boot()
  {
    $this->registerPolicies();

    Gate::define('admin', function (User $user) {
      return ($user->level === 'SUPERADMIN' || $user->level === 'ADMIN');
    });
  }
}
