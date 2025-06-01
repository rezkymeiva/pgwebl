<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PointsModel;
use App\Models\PolygonModel;
use App\Models\PolylinesModel;

class TableController extends Controller
{
    public function __construct()
    {
        $this->points = new PointsModel();
        $this->plylines = new PolylinesModel();
        $this->polygon = new PolygonModel();

    }
    public function index()
    {
        $data = [
            'title' => 'Table',
            'points' => $this->points->all(),
        ];
        return view('table', $data);
    }
}
