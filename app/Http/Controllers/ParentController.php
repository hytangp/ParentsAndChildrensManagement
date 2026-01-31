<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParentsDestroyRequest;
use App\Services\ParentService;
use Exception;

class ParentController extends Controller
{
    public function destroyMultiple(ParentsDestroyRequest $request){
        try{
            $deleteParent = ParentService::deleteParents($request->validated());

            if(!$deleteParent){
                throw new Exception('Failed to delete parents.');
            }

            $parents = ParentService::getParentsPaginate();
            $data_view = view('pages.templates.parents.listing', compact('parents'))->render();

            return response()->json([
                'message' => 'Parents deleted successfully.',
                'data' => $data_view
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Something went wrong.'
            ], 500);
        }
    }
}