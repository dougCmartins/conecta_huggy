<?php

namespace App\Http\Controllers;


use App\Repositories\Interfaces\SegmentRepositoryInterface;
use Illuminate\Routing\Controller;

class SegmentController extends Controller
{
    public function __construct(protected SegmentRepositoryInterface $repository)
    {

    }
    public function index()
    {
        $segments = $this->repository->getAll();
        return response()->json($segments);
    }
}
