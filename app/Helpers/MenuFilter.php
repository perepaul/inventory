<?php

namespace App\Helpers;

use App\User;
use Laratrust\Laratrust;
use JeroenNoten\LaravelAdminLte\Menu\Builder;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;

class MenuFilter implements FilterInterface
{
    public function transform($item, Builder $builder)
    {
        $user = User::findOrFail(auth()->user()->id);
        if (isset($item['can']) && !$user->hasPermission($item['can'])) {
            // $item['restricted'] = true;
            return false;
        }

        return $item;
    }
}
