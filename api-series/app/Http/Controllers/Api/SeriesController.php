<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesRequest;
use App\Http\Resources\Series\SeriesShowResource;
use App\Models\Series;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;

class SeriesController extends Controller{
    
    public function index(Request $request){

        $query = Series::query();
        if ($request->has('name')) {
            $query->where('name' , $request->nome);
        }

        $data = $query->paginate(5);

        return SeriesShowResource::collection($data);
    }

    public function store(SeriesRequest $request){
        
        $data  = $request->all();
        $serie = Series::create($data);
        
        return SeriesShowResource::make($serie);

    }

    public function show(int $series){

        $seriesModel = Series::find($series);
        if ($seriesModel === null) {
            return response()->json(['message' => 'Serie not found'], 404);
        }

        return SeriesShowResource::make($seriesModel);

    }

    public function update(Series $series, Request $request){

        $series->fill($request->all());
        $series->save();

        return $series;

    }
    
    public function destroy(int $series, Authenticatable $user){

        if(!$user->tokenCan('is_admin')){
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        
        Series::destroy($series);
        return response()->json(['Success' => 'Serie removed']);

    }
}
