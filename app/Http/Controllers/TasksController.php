<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Http\Requests\StoreTasksRequest;
use App\Http\Requests\UpdateTasksRequest;
use App\Http\Resources\TaskResources;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    
        $query = Tasks::query();
        $sortField = request("sort_field","created_at");
        $sortDirection = request("sort_direction","desc");

        if(request("name"))
        {
            $query->where("name" ,"like","%".request("name")."%");
        }
        if(request("status"))
        {
            if(request("status") != "all")
            $query->where("status" ,"like","%".request("status")."%");
        }
        //$projects = $query->with('createdBy')->with('updatedBy')->paginate(10);
        $tasks = $query->orderBy($sortField,$sortDirection)->paginate(10);
        
        return inertia("Tasks/index",[
            "tasks"=> TaskResources::collection($tasks),
            "queryParams" =>request()->query()?:null
            //"projects"=> $projects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTasksRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Tasks $tasks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tasks $tasks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTasksRequest $request, Tasks $tasks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tasks $tasks)
    {
        //
    }
}
