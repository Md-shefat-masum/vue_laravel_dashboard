<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingGroup extends Model
{
    public function sub_group()
    {
        return $this->hasMany(SettingSubGroup::class, 'setting_group_id');
    }
}
