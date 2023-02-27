<?php

namespace App\Traits;

use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponse
{
    private $meta = [];

    protected function appendResponseMeta($list = [])
    {
        $this->meta = array_merge($this->meta, $list);
    }

    protected function generatePaginationMeta(LengthAwarePaginator $paginator)
    {
        return [
            'current' => $paginator->currentPage(),
            'last_page' => $paginator->lastPage(),
            'per_page' => $paginator->perPage(),
            'total' => $paginator->total(),
        ];
    }

    protected function appendPaginationMeta(LengthAwarePaginator $result)
    {
        $this->appendResponseMeta(['pagination' => $this->generatePaginationMeta($result)]);
    }

    protected function successResponse($data, $message = null, $code = 200)
    {
        return response()->json([
            'status' => 'Success',
            'message' => $message,
            'data' => $data,
            'meta' => $this->meta,
        ], $code);
    }

    protected function errorResponse($message = null, $code = 400, $errors = null)
    {
        return response()->json([
            'status' => 'Error',
            'message' => $message,
            'errors' => $errors,
            'data' => null,
        ], $code);
    }

    protected function itemsPerPage()
    {
        return (int) request()->per_page ?? 10;
    }
}
