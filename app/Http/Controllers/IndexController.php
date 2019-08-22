<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Project::latest()->paginate(9);
        return view('index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Project $dashboard
     * @return Response
     */
    public function show(Project $dashboard)
    {
        return view('profile.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Project $dashboard
     * @return Response
     */
    public function edit(Project $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Project $dashboard
     * @return Response
     */
    public function update(Request $request, Project $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $dashboard
     * @return Response
     */
    public function destroy(Project $dashboard)
    {
        //
    }
}
