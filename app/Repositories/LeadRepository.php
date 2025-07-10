<?php

namespace App\Repositories;

use App\Models\Lead;

class LeadRepository
{
    protected $model;

    public function __construct(Lead $model)
    {
        $this->model = $model;
    }

    public function all(int $limit = 10)
    {
        return $this->model->with(['createdBy', 'updatedBy'])
            ->orderBy('id', 'desc')
            ->orderBy('id', 'desc')
            ->paginate($limit);
    }

    public function find($publicId)
    {
        return $this->model->where('public_id', $publicId)->firstOrFail();
    }

    public function create(array $data)
    {
        $lead = $this->model->create($data);
        return $this->transformResponse($lead);
    }

    public function update(Lead $data, array $input)
    {
        $data->update($input);
        return $this->transformResponse($data);
    }

    public function delete(Lead $data)
    {
        return $data->delete();
    }

    private function transformResponse(Lead $data)
    {
        return $data->makeHidden(['created_by', 'updated_by']);
    }
}
