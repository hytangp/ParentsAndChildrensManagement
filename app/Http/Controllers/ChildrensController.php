<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUpdateChildrenRequest;
use App\Models\Childrens;
use App\Services\ChildrenService;
use App\Services\ParentService;
use Exception;

class ChildrensController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $childrens = ChildrenService::getChildrens();
            $parents = ParentService::getParents();

            return view('pages.childrens.list')->with([
                'parents' => $parents,
                'childrens' => $childrens
            ]);
        }catch(Exception $e){
            return view('pages.childrens.list')->with([
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
            $parents = ParentService::getParents();

            $data_view = view('pages.templates.childrens.children_add_update_form', compact('parents'))->render();

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
    public function store(AddUpdateChildrenRequest $request)
    {
        try{
            $addChildren = ChildrenService::addChildren($request->validated(), $request->file('birth_certificate'));

            if(!$addChildren){
                throw new Exception('Failed to add children.');
            }

            $childrens = ChildrenService::getChildrens();
            $data_view = view('pages.templates.childrens.listing', compact('childrens'))->render();

            return response()->json([
                'message' => 'Children added successfully.',
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
            $children = ChildrenService::getChildren($id);
            $parents = ParentService::getParents();

            if(!$children){
                throw new Exception('Failed to fetch children.');
            }

            $data_view = view('pages.templates.childrens.children_add_update_form', compact('children', 'parents'))->render();

            return response()->json([
                'message' => 'Children details fetch successfully.',
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
    public function update(AddUpdateChildrenRequest $request, Childrens $children)
    {
        try{
            $updateChildren = ChildrenService::updateChildren($request->validated(), $request->file('birth_certificate'), $children);

            if(!$updateChildren){
                throw new Exception('Failed to update children.');
            }

            $childrens = ChildrenService::getChildrens();
            $data_view = view('pages.templates.childrens.listing', compact('childrens'))->render();

            return response()->json([
                'message' => 'Children updated successfully.',
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
    public function destroy(Childrens $children)
    {
        try{
            $deleteChildren = ChildrenService::deleteChildren($children);

            if(!$deleteChildren){
                throw new Exception('Failed to delete children.');
            }

            $childrens = ChildrenService::getChildrens();
            $data_view = view('pages.templates.childrens.listing', compact('childrens'))->render();

            return response()->json([
                'message' => 'Children deleted successfully.',
                'data' => $data_view
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Something went wrong.'
            ], 500);
        }
    }
}