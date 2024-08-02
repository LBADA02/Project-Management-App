<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResources;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $query = Project::query();
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
        $projects = $query->orderBy($sortField,$sortDirection)->paginate(10);
        
        return inertia("project/index",[
            "projects"=> ProjectResources::collection($projects),
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
    public function store(StoreProjectRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //dd( new ProjectResources($project));
        return inertia('project/show',[
            'project'=> new ProjectResources($project)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
