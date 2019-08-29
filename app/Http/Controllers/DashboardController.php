<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = auth()->user();
        $dashboard = Project::latest()->paginate(8);

        $data = array('user' => $user, 'dashboard' => $dashboard);

        return view('cms.index', compact('data'))
            ->with('i', (request()->input('page',1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('cms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required',
            'project_description' => 'required',
            'project_author' => 'required',
            'project_link' => 'required',
            'project_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $image = $request->file('project_image');

        $newName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/project_images'), $newName);
        $formData = array(
            'project_name' => $request['project_name'],
            'project_description' => $request['project_description'],
            'project_author' => $request['project_author'],
            'project_link' => $request['project_link'],
            'project_image' => $newName
        );

        Project::create($formData);

        return redirect()->route('dashboard.index')
            ->with('success','Project Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  Project $dashboard
     * @return Response
     */
    public function show(Project $dashboard)
    {
        return view('cms.show', compact('dashboard'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Project $dashboard
     * @return Response
     */
    public function edit(Project $dashboard)
    {
        return view('cms.edit', compact('dashboard'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $image_name = $request->hidden_image;
        $image = $request->file('project_image');
        if($image != '') {
            $request->validate([
                'project_name' => 'required',
                'project_description' => 'required',
                'project_author' => 'required',
                'project_link' => 'required',
                'project_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/project_images/'), $image_name);
        } elseif($request->get('project_name') === $request['project_name'] &&
            $request->get('project_description') === $request['project_description'] &&
            $request->get('project_author') === $request['project_author'] &&
            $request->get('project_link') === $request['project_link'] &&
            $request->get('project_image') === $request['project_image']) {
            return redirect()->back()->with('warning', 'No changes has been detected!');
        } else {
            $ExistingProjectImage = $request->get('existingProjectImage');
            $request->validate([
                'project_name' => 'required',
                'project_description' => 'required',
                'project_author' => 'required',
                'project_link' => 'required'
            ]);
            $image_name = $ExistingProjectImage;
        }

        $form_data = array(
            'project_name'  =>   $request['project_name'],
            'project_description'  =>   $request['project_description'],
            'project_author'  =>   $request['project_author'],
            'project_link' => $request['project_link'],
            'project_image'  =>   $image_name
        );

        Project::whereId($id)->update($form_data);

        return redirect()
            ->back()
            ->with('success','Project updated Successfully');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('dashboard.index')
            ->with('success','Project has been Deleted');
    }

    public function showUsers()
    {
        $userData = User::orderBy('id')->get();
        return view('cms.users', compact('userData'));
    }
}
