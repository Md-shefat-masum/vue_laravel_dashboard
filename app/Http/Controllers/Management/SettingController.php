<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\SettingGroup;
use App\Models\SettingSubgroupValue;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function fields()
    {
        $data = SettingGroup::with(['sub_group'])->get();
        return entityResponse($data);
    }

    public function values($group_id, $sub_group_id)
    {
        $data = SettingSubgroupValue::where([
            'setting_group_id' => $group_id,
            'setting_sub_group_id' => $sub_group_id,
        ])
            ->get();

        return entityResponse($data);
    }

    public function update()
    {
        $validator = Validator::make(request()->all(), [
            'fields' => 'required|array',
        ]);

        if ($validator->fails()) {
            return entityResponse($validator->errors(), 422, 'error', 'Validation Error');
        }

        $fields = request()->fields;
        foreach ($fields as $key => $value) {
            SettingSubgroupValue::where('id', $key)->update([
                'value' => $value['value']
            ]);
        }

        return entityResponse([]);
    }
}
