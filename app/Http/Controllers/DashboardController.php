<?php

namespace App\Http\Controllers;

use App\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Dashboard::latest()->paginate(5);
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
            'ProjectImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $image = $request->file('ProjectImage');

        $newName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/project_images'), $newName);
        $formData = array(
            'ProjectName' => $request->ProjectName,
            'ProjectDescription' => $request->ProjectDescription,
            'ProjectAuthor' => $request->ProjectAuthor,
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
    public function show($id)
    {
        //
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
     * @param  Dashboard $dashboard
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $image_name = $request->hidden_image;
        $image = $request->file('ProjectImage');
        if($image != '')
        {
            $request->validate([
                'ProjectName' => 'required',
                'ProjectDescription' => 'required',
                'ProjectAuthor' => 'required',
                'ProjectImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/project_images/'), $image_name);
        } else if($request->get('ProjectName') == $request->get('ProjectName')
            && $request->get('ProjectDescription') == $request->get('ProjectDescription')
            && $request->get('ProjectAuthor') == $request->get('ProjectAuthor')
            && $request->get('ProjectImage') == $request->get('ProjectImage')) {
            return redirect()->back()->with('success', 'No changes were Made!');
        } else {
            $ProjectImage = Dashboard::table('dashboards')->select('ProjectImage')->where('id', $id);
            $request->validate([
                'ProjectName' => 'required',
                'ProjectDescription' => 'required',
                'ProjectAuthor' => 'required',
            ]);
            $image_name = $ProjectImage;
        }

        $form_data = array(
            'ProjectName'  =>   $request->ProjectName,
            'ProjectDescription'  =>   $request->ProjectDescription,
            'ProjectAuthor'  =>   $request->ProjectAuthor,
            'ProjectImage'  =>   $image_name
        );

        Dashboard::whereId($id)->update($form_data);

        return redirect()
            ->back()
            ->with('success','Project updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Dashboard  $dashboard
     * @return Response
     */
    public function destroy(Dashboard $dashboard)
    {
        $dashboard->delete();

        return redirect()->route('cms.index')
            ->with('success','Project has been Deleted');
    }
}
