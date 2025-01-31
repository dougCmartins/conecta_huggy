<?php

namespace App\Http\Controllers;


use App\Repositories\Interfaces\TopicRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TopicController extends Controller
{
    public function __construct(protected TopicRepositoryInterface $repository)
    {
    }

    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('perPage', 10);

        $posts = $this->repository->getAll($page, $perPage);

        return response()->json($posts);
    }
}
