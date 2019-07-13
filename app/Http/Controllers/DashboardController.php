<?php

namespace App\Http\Controllers;

use App\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

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
        $dashboard = Dashboard::latest()->paginate(8);

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
            'ProjectName' => 'required',
            'ProjectDescription' => 'required',
            'ProjectAuthor' => 'required',
            'ProjectLink' => 'required',
            'ProjectImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $image = $request->file('ProjectImage');

        $newName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/project_images'), $newName);
        $formData = array(
            'ProjectName' => $request->ProjectName,
            'ProjectDescription' => $request->ProjectDescription,
            'ProjectAuthor' => $request->ProjectAuthor,
            'ProjectLink' => $request->ProjectLink,
            'ProjectImage' => $newName
        );

        Dashboard::create($formData);

        return redirect()->route('dashboard.index')
            ->with('success','Project Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  Dashboard $dashboard
     * @return Response
     */
    public function show(Dashboard $dashboard)
    {
        return view('cms.show', compact('dashboard'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Dashboard $dashboard
     * @return Response
     */
    public function edit(Dashboard $dashboard)
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
        $image = $request->file('ProjectImage');
        if($image != '') {
            $request->validate([
                'ProjectName' => 'required',
                'ProjectDescription' => 'required',
                'ProjectAuthor' => 'required',
                'ProjectLink' => 'required',
                'ProjectImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/project_images/'), $image_name);
        } elseif($request->get('ProjectName') == $request->get('existingProjectName') &&
            $request->get('ProjectDescription') == $request->get('existingProjectDescription') &&
            $request->get('ProjectAuthor') == $request->get('existingProjectAuthor') &&
            $request->get('ProjectImage') == $request->get('existingProjectImage') &&
            $request->get('ProjectLink') == $request->get('existingProjectLink')) {
            return redirect()->back()->with('warning', 'No changes has been detected!');
        } else {
            $ExistingProjectImage = $request->get('existingProjectImage');
            $request->validate([
                'ProjectName' => 'required',
                'ProjectDescription' => 'required',
                'ProjectAuthor' => 'required',
                'ProjectLink' => 'required'
            ]);
            $image_name = $ExistingProjectImage;
        }

        $form_data = array(
            'ProjectName'  =>   $request->ProjectName,
            'ProjectDescription'  =>   $request->ProjectDescription,
            'ProjectAuthor'  =>   $request->ProjectAuthor,
            'ProjectLink' => $request->ProjectLink,
            'ProjectImage'  =>   $image_name
        );

        Dashboard::whereId($id)->update($form_data);

        return redirect()
            ->back()
            ->with('success','Project updated Successfully');
    }

    public function destroy($id)
    {
        $project = Dashboard::findOrFail($id);
        $project->delete();

        return redirect()->route('dashboard.index')
            ->with('success','Project has been Deleted');
    }

    public function showUsers()
    {
        $userData = DB::table('users')->orderBy('id', 'asc')->get();
        return view('cms.users', compact('userData'));
    }
}
