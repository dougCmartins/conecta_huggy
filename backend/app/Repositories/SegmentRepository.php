<?php

namespace App\Repositories;

use App\Models\Segment;
use App\Repositories\Interfaces\SegmentRepositoryInterface;

class SegmentRepository implements SegmentRepositoryInterface
{
    public function getAll()
    {
        return Segment::all();
    }
}
