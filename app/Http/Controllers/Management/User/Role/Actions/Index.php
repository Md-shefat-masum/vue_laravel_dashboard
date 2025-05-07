<?php
namespace App\Http\Controllers\Management\User\Role\Actions;

Class Index{
    public function execute($model)
    {
        $fields = request()->fields ?? ['id', 'title', 'status', 'slug', 'created_at'];
        // $fields = array_map('trim', explode(',', $fields));

        $relations = request()->relations ?? [];
        $conditions = request()->conditions ?? [];
        $paginate = request()->paginate ?? 10;
        $search = request()->search ?? null;
        $orderByCol = request()->orderByCol ?? 'id';
        $orderByAsc = request()->orderByAsc == 1 ? 'asc' : 'desc';
        $status = request()->status ?? 1;

        $query = $model::query()
            ->where('status', $status)
            ->select($fields);

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
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('title', 'like', '%' . $search . '%');
            });
        }

        $data = $query
            ->orderBy($orderByCol, $orderByAsc)
            ->paginate($paginate)
            ->onEachSide(0)
            ->appends(request()->all());

        return $data;
    }
}