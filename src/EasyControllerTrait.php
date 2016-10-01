<?php

namespace MaddyAlj\EasyController;

use Illuminate\Http\Request;

trait EasyControllerTrait
{
    protected $model = '\App\\';
    protected $perPage = 15;

    public function all()
    {
        return $this->model::all();
    }

    public function paginate()
    {
        return $this->model::paginate($this->perPage);
    }

    public function find($id)
    {
        return $this->model::find($id);
    }

    public function create(Request $request)
    {
        return $this->model::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $object = $this->model::find($id);
        if ($object->update($request->all()) === true) {
            return $object->fresh();
        }
        return $object;
    }

    public function delete($id)
    {
        $object = $this->model::find($id);
        if ($object->delete() === true) {
            return $object->withTrashed()->find($id);
        }
        return $object;
    }

    public function relationAll($id, $relation)
    {
        return $this->model::find($id)->$relation;
    }

    public function relationPaginate($id, $relation)
    {
        return $this->model::find($id)->$relation()->paginate($this->perPage);
    }

    public function relationFind($id, $relation, $relationId)
    {
        return $this->model::find($id)->$relation()->find($relationId);
    }

    public function relationCreate(Request $request, $id, $relation)
    {
        return $this->model::find($id)->$relation()->create($request->all());
    }

    public function relationUpdate(Request $request, $id, $relation, $relationId)
    {
        $object = $this->model::find($id)->$relation()->find($relationId);
        if ($object->update($request->all()) === true) {
            return $object->fresh();
        }
        return $object;
    }

    public function relationDelete($id, $relation, $relationId)
    {
        $object = $this->model::find($id)->$relation()->find($relationId);
        if ($object->delete() === true) {
            return $object->withTrashed()->find($id);
        }
        return $object;
    }
}
