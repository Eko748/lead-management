<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\LeadService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LeadController extends Controller
{
    use ApiResponse;

    protected LeadService $service;
    private string $title = 'Lead';
    private string $titles = 'Leads';

    public function __construct(LeadService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        try {
            $limit = (int) $request->get('limit', 10);

            if ($limit <= 0) {
                return $this->error(422, 'Limit must be a positive number');
            }

            $data = $this->service->list($limit);

            return $this->success(
                $data->items(),
                200,
                "{$this->titles} retrieved successfully",
                [
                    'total' => $data->total(),
                    'limit' => $data->perPage(),
                    'current_page' => $data->currentPage(),
                    'total_pages' => $data->lastPage(),
                ]
            );
        } catch (\Throwable) {
            return $this->error(500, "Failed to retrieve {$this->titles} data");
        }
    }

    public function show(string $publicId)
    {
        $data = $this->service->get($publicId);
        return $data
            ? $this->success($data)
            : $this->error(404, "{$this->title} not found");
    }

    public function store(Request $request)
    {
        try {
            $data = $this->service->create($request->all());
            return $this->success($data, 201, "{$this->title} created");
        } catch (ValidationException $e) {
            return $this->error(
                422,
                $e->validator->errors()->first(),
                $e->errors()
            );
        } catch (\Throwable) {
            return $this->error(422, "Failed to create {$this->title}");
        }
    }

    public function update(Request $request, string $publicId)
    {
        try {
            $data = $this->service->update($publicId, $request->all());
            return $data
                ? $this->success($data, 200, "{$this->title} updated")
                : $this->error(404, "{$this->title} not found");
        } catch (ValidationException $e) {
            return $this->error(
                422,
                $e->validator->errors()->first(),
                $e->errors()
            );
        } catch (\Throwable) {
            return $this->error(422, "Failed to update {$this->title}");
        }
    }

    public function destroy(string $publicId)
    {
        return $this->service->delete($publicId)
            ? $this->success(null, 200, "{$this->title} deleted")
            : $this->error(404, "{$this->title} not found");
    }
}
