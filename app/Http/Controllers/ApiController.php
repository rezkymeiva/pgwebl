<?php

namespace App\Http\Controllers;

use App\Models\PointsModel;
use App\Models\PolygonModel;
use Illuminate\Http\Request;
use App\Models\PolylinesModel;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->points = new PointsModel();
        $this->polylines = new PolylinesModel();
        $this->polygon = new PolygonModel();
    }

    public function points()
    {
        $points = $this->points->geojson_points();

        return response()->json($points);
    }

    public function point($id)
    {
        $points = $this->points->geojson_point($id);

        return response()->json($points);
    }

    public function polylines()
    {
        $polylines = $this->polylines->geojson_polylines();

        return response()->json($polylines, 200, [], JSON_NUMERIC_CHECK);
    }

    public function polyline($id)
    {
        $polylines = $this->polylines->geojson_polyline($id);

        return response()->json($polylines, 200, [], JSON_NUMERIC_CHECK);
    }

    public function polygon()
    {
        $polygon = $this->polygon->geojson_polygon();

        return response()->json($polygon, 200, [], JSON_NUMERIC_CHECK);
    }

    public function polygons($id)
    {
        $polygon = $this->polygon->geojson_polygons($id);

        return response()->json($polygon, 200, [], JSON_NUMERIC_CHECK);
    }
}
