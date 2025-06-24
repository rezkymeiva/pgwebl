<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class PolygonModel extends Model
{
    protected $table = 'polygon';

    protected $guarded = ['id'];

    public function geojson_polygon()
    {
        $polygons = $this
            ->select(DB::raw('
                polygon.id,
                ST_AsGeoJSON(polygon.geom) as geom,
                ST_Area(polygon.geom, true) as luas_m2,
                ST_Area(polygon.geom, true) / 1000000 as luas_km2,
                ST_Area(polygon.geom, true) / 10000 as luas_hektar,
                polygon.name,
                polygon.description,
                polygon.created_at,
                polygon.updated_at,
                polygon.image,
                polygon.user_id,
                users.name as user_created
            '))
            ->leftJoin('users', 'polygon.user_id', '=', 'users.id')
            ->get();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($polygons as $p) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom),
                'properties' => [
                    'id' => $p->id,
                    'name' => $p->name,
                    'description' => $p->description,
                    'luas_m2' => $p->luas_m2,
                    'luas_km2' => $p->luas_km2,
                    'luas_hektar' => $p->luas_hektar,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at,
                    'image' => $p->image,
                    'user_id' => $p->user_id,
                    'user_created' => $p->user_created,
                ],
            ];

            $geojson['features'][] = $feature;
        }

        return $geojson;
    }

    public function geojson_polygons($id)
    {
        $polygons = $this
            ->select(DB::raw('
                id,
                ST_AsGeoJSON(geom) as geom,
                ST_Area(geom, true) as luas_m2,
                ST_Area(geom, true) / 1000000 as luas_km2,
                ST_Area(geom, true) / 10000 as luas_hektar,
                name,
                description,
                created_at,
                updated_at,
                image
            '))
            ->where('id', $id)
            ->get();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($polygons as $p) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom),
                'properties' => [
                    'id' => $p->id,
                    'name' => $p->name,
                    'description' => $p->description,
                    'luas_m2' => $p->luas_m2,
                    'luas_km2' => $p->luas_km2,
                    'luas_hektar' => $p->luas_hektar,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at,
                    'image' => $p->image,
                ],
            ];

            $geojson['features'][] = $feature;
        }

        return $geojson;
    }
}
