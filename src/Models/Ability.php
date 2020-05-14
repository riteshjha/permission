<?php

namespace Rkj\Permission\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ability extends Model
{
    public const LEVEL_OWNER = 1;
    public const LEVEL_ACCOUNT = 2;

    public const GROUP_SYSTEM = 1;
    public const GROUP_ACCOUNT = 2;

    /**
     * Get all of the roles that are assigned this ability.
     */
    public function roles()
    {
        $role = config('permission.model.role');

        return $this->morphedByMany($role, 'abilitable')->withTimestamps()->withPivot('level');
    }

    /**
     * Get all of the users that are assigned this ability.
     */
    public function users()
    {
        $user = config('permission.model.user');

        return $this->morphedByMany($user, 'abilitable')->withTimestamps()->withPivot('level');
    }

    /**
     * Check is system group ability
     *
     * @return boolean
     */
    public function isSystemGroup()
    {
        return $this->group == self::GROUP_SYSTEM;
    }

    /**
     * Check is system group ability
     *
     * @return boolean
     */
    public function isAccountGroup()
    {
        return $this->group == self::GROUP_ACCOUNT;
    }

    /**
     * Check the ability is field ability
     *
     * @return boolean
     */
    public function isFieldAbility()
    {
        return Str::of($this->name)->contains(':');
    }
}