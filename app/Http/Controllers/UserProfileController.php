<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Project;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($id)
    {
        $userid = User::findOrFail($id);

        return view('profile.create', compact('userid'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request, $id)
    {
        User::findOrFail($id);

        $userid = Auth::user()->id;

        $request->validate([
           'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'contact_number' => 'required',
            'birth_date' => 'required',
            'profile_picture' => 'required'
        ]);

        $request['user_id'] = $userid;
        Profile::create($request->all());

        return redirect()
            ->route('dashboard.index')
            ->with('success', 'You have successfully created your Profile!');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function show(User $user)
    {
        $dashboard = Project::latest()->get();
        return view('profile.show', compact('user', 'dashboard'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        /*$image = $request->file('profile_img');
        if($image != null) {
            $request->validate([
               'first_name' => 'required', 'middle_name' => 'required',
                'last_name' => 'required', 'address' => 'required', 'email' => 'email | required',
                'description' => 'required', 'contact' => 'required',
                'profile_img' => 'required | image | max:2048 | mimes: jpg,jpeg,png'
            ]);
            $imageName = time() . "." .$image->getClientOriginalExtension();
            $image->move(public_path('images/profile_images'), $imageName);*/
        $croppedImage = $request->get('image_name');
        if($croppedImage !== null){
            $request->validate([
                'first_name' => 'required', 'middle_name' => 'required',
                'last_name' => 'required', 'address' => 'required', 'email' => 'email | required',
                'profile_picture' => 'required | image | max:2048 | mimes: jpg,jpeg,png', 'birth_date' => 'required',
            ]);

            $formData = array(
                'first_name' => $request['first_name'],
                'middle_name' => $request['middle_name'],
                'last_name' => $request['last_name'],
                'address' => $request['address'],
                'email' => $request['email'],
                'contact_number' => $request['contact_number'],
                'birth_Date' => $request['birth_Date'],
                'profile_picture' => $croppedImage
            );

        } else if($request->get('first_name') === $request['first_name'] &&
            $request->get('middle_name') === $request['middle_name'] &&
            $request->get('last_name') === $request['last_name'] &&
            $request->get('email') === $request['email'] &&
            $request->get('address') === $request['address'] &&
            $request->get('birth_date') === $request['birth_date'] &&
            $request->get('contact_number') === $request['contact_number'] &&
            $request->get('profile_picture') === $request['profile_picture']){
            return redirect()->back()->with('warning', 'No changes were made!');
        } else {
            $profile_img = Users::table('users')->select('profile_picture')->where('id', $id);
            $request->validate([
                'first_name' => 'required', 'last_name' => 'required',
                'address' => 'required', 'email' => 'email | required',
                'contact_number' => 'required', 'birth_date' => 'required',
            ]);
            $imageName = $profile_img;

            $formData = array(
                'first_name' => $request['first_name'],
                'middle_name' => $request['middle_name'],
                'last_name' => $request['last_name'],
                'address' => $request['address'],
                'email' => $request['email'],
                'birth_date' => $request['birth_date'],
                'contact_number' => $request['contact_number'],
                'profile_picture' => $imageName
            );
        }

        User::whereId($id)->update($formData);

        return redirect()
            ->back()
            ->with('success','Profile updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->back()->with('success','User Profile has been Deleted!');
    }
}
