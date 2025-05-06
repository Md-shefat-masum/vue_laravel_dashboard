<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public $model;

    public function __construct()
    {
        $this->model = User::class;
    }

    public function index()
    {
        $validator = Validator::make(request()->all(), [
            'fields' => ['array'],
            'relations' => ['array'],
            'conditions' => ['array'],
        ]);

        if ($validator->fails()) {
            return entityResponse($validator->errors(), 422, 'error', 'Validation Error');
        }

        $fields = request()->fields ?? ['id', 'name', 'email', 'photo', 'phone_number', 'slug', 'created_at', 'status'];
        // $fields = array_map('trim', explode(',', $fields));

        $relations = request()->relations ?? [];
        $conditions = request()->conditions ?? [];
        $paginate = request()->paginate ?? 10;
        $search = request()->search ?? null;
        $orderByCol = request()->orderByCol ?? 'id';
        $orderByAsc = request()->orderByAsc == 1 ? 'asc' : 'desc';

        $query = $this->model::query()->select($fields);

        if (count($conditions) > 0) {
            $query->where([
                ...$conditions
            ]);
        }

        if (count($relations) > 0) {
            $query->with([
                ...$relations
            ]);
        }

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $data = $query
            ->orderBy($orderByCol, $orderByAsc)
            ->paginate($paginate)
            ->onEachSide(0)
            ->appends(request()->all());

        return entityResponse($data);
    }

    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return entityResponse($validator->errors(), 422, 'error', 'Validation Error');
        }

        $data = $this->model::create([
            'name' => request()->name,
            'email' => request()->email,
            'photo' => request()->photo,
            'password' => Hash::make(request()->password),
        ]);

        return $data;
    }
}
