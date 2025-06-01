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
        $polygon = $this
            ->select(DB::raw('polygon.id, st_asgeojson(polygon.geom) as geom, st_area(polygon.geom, true) as luas_m2, st_area(polygon.geom, true)/1000000 as luas_km2, st_area(polygon.geom,true)/10000 as luas_hektar, polygon.name, polygon.description, polygon.created_at, polygon.updated_at, polygon.image, polygon.user_id, users.name as user_created'))
            ->leftJoin('users', 'polygon.user_id', '=', 'users.id')
            ->get();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($polygon as $p) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom),
                'properties' => [
                    'id' =>$p->id,
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

            array_push($geojson['features'], $feature);
        }
        return $geojson;
    }

    public function geojson_polygons($id)
{
    $polygon = $this
        ->select(DB::raw('id, st_asgeojson(geom) as geom, st_area(geom, true) as luas_m2, st_area(geom, true)/1000000 as luas_km2, st_area(geom,true)/10000 as luas_hektar, name, description, created_at, updated_at, image'))
        ->where('id', $id)
        ->get();

    $geojson = [
        'type' => 'FeatureCollection',
        'features' => [],
    ];

    foreach ($polygon as $p) {
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

        array_push($geojson['features'], $feature);
    }

    return $geojson;
}

    }

