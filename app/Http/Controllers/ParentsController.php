<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUpdateParentRequest;
use App\Models\Parents;
use App\Services\ChildrenService;
use App\Services\ParentService;
use Exception;

class ParentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $parents = ParentService::getParentsPaginate();
            $childrens = ChildrenService::getChildrens();

            return view('pages.parents.list')->with([
                'parents' => $parents,
                'childrens' => $childrens
            ]);
        }catch(Exception $e){
            return view('pages.parents.list')->with([
                'error' => 'Something went wrong.'
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{
            $childrens = ChildrenService::getChildrens();

            $data_view = view('pages.templates.parents.parent_add_update_form', compact('childrens'))->render();

            return response()->json([
                'message' => 'Parent details fetch successfully.',
                'data' => $data_view
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Something went wrong.'
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddUpdateParentRequest $request)
    {
        try{
            $addParent = ParentService::addParent($request->validated(), $request->file('residential_proofs'), $request->file('profile_image'));

            if(!$addParent){
                throw new Exception('Failed to add parent.');
            }

            $parents = ParentService::getParentsPaginate();
            $data_view = view('pages.templates.parents.listing', compact('parents'))->render();

            return response()->json([
                'message' => 'Parent added successfully.',
                'data' => $data_view
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Something went wrong.'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try{
            $parent = ParentService::getParent($id);
            $childrens = ChildrenService::getChildrens();

            if(!$parent){
                throw new Exception('Failed to fetch parent.');
            }

            $data_view = view('pages.templates.parents.parent_add_update_form', compact('parent', 'childrens'))->render();

            return response()->json([
                'message' => 'Parent details fetch successfully.',
                'data' => $data_view
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Something went wrong.'
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddUpdateParentRequest $request, Parents $parent)
    {
        try{
            $updateParent = ParentService::updateParent($request->validated(), $request->file('residential_proofs'), $request->file('profile_image'), $parent);

            if(!$updateParent){
                throw new Exception('Failed to update parent.');
            }

            $parents = ParentService::getParentsPaginate();
            $data_view = view('pages.templates.parents.listing', compact('parents'))->render();

            return response()->json([
                'message' => 'Parent updated successfully.',
                'data' => $data_view
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Something went wrong.'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parents $parent)
    {
        try{
            $deleteParent = ParentService::deleteParent($parent);

            if(!$deleteParent){
                throw new Exception('Failed to delete parent.');
            }

            $parents = ParentService::getParentsPaginate();
            $data_view = view('pages.templates.parents.listing', compact('parents'))->render();

            return response()->json([
                'message' => 'Parent deleted successfully.',
                'data' => $data_view
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Something went wrong.'
            ], 500);
        }
    }
}
