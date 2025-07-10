<?php

namespace App\Services;

use App\Enums\LeadStatus;
use App\Repositories\LeadRepository;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class LeadService
{
    protected $repository;

    public function __construct(LeadRepository $repository)
    {
        $this->repository = $repository;
    }

    public function list(int $limit = 10)
    {
        return $this->repository->all($limit);
    }

    public function create(array $input)
    {
        $this->validate($input);
        return $this->repository->create($input);
    }

    public function get(string $publicId)
    {
        return $this->repository->find($publicId);
    }

    public function update(string $publicId, array $input)
    {
        $data = $this->repository->find($publicId);
        if (!$data) return null;

        $this->validate(array_merge(request()->query(), $input), $data->id);
        return $this->repository->update($data, $input);
    }

    public function delete(string $publicId)
    {
        $data = $this->repository->find($publicId);
        return $data ? $this->repository->delete($data) : false;
    }

    protected function validate(array $data, $id = null)
    {
        $isPatch = request()->isMethod('patch');

        Validator::make($data, [
            'name' => ($isPatch ? 'sometimes|required' : 'required') . '|string|max:255',
            'email' => [
                $isPatch ? 'sometimes|required' : 'required',
                'email',
                'max:255',
                Rule::unique('lead', 'email')->ignore($id)
            ],
            'phone' => ($isPatch ? 'sometimes|nullable' : 'nullable') . '|string|max:20',
            'status' => [$isPatch ? 'sometimes|nullable' : 'nullable', Rule::in(LeadStatus::values())],
        ])->validate();
    }
}
