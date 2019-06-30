<?php

namespace App\Http\Controllers;

use App\CMS;
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
        $data = Dashboard::all();
        return view('cms.index', compact('data'));
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
            'projectName' => 'required',
            'projectDescription' => 'required',
            'projectAuthor' => 'required',
            'projectImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $image = $request->file('image');

        $newName = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('img'), $newName);
        $formData = array(
            'projectName' => $request->ProjectName,
            'projectDescription' => $request->ProjectDescription,
            'projectAuthor' => $request->ProjectAuthor,
            'projectImage' => $newName
        );

        CMS::create($formData);

        return redirect()->route('cms.index')
            ->with('success','Project Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  CMS  $cMS
     * @return Response
     */
    public function show(Data $data)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  CMS  $cMS
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
     * @param  CMS  $cMS
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $imageName =$request->hiddenImage;
        $image = $request->file('image');
        if($image != ''){
            $request->validate([
               'projectName' => 'required',
                'projectDescription' => 'required',
                'projectAuthor' => 'required',
                'projectImage' => 'required|image|mimes:jpeg,jpg,png|max:2048'
            ]);

            $imageName = rand() . "." . $image->getClientOriginalExtension();
            $image->move(public_path('img'),$imageName);
        } else {
            $request->validate([
               'projectName' => 'required',
               'projectDescription' => 'required'
            ]);
        }

        $formData = array(
            'projectName' => $request->ProjectName,
            'projectDesciption' => $request->ProjectDescription,
            'projectAuthor' => $request->ProjectAuthor,
            'projectImage' => $imageName
        );

        CMS::whereId($id)->update($formData);

        return redirect()->route('cms.index')
            ->with('success','Project updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  CMS  $cMS
     * @return Response
     */
    public function destroy(Dashboard $dashboard)
    {
        $dashboard->delete();

        return redirect()->route('cms.index')
            ->with('success','Project has been Deleted');
    }
}
