<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * @param User $user
     * @return Response
     */
    public function show(User $user)
    {
        return view('profile.show', compact('user'));
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
     * @param User $user
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $imageName = $request->hidden_image;
        $image = $request->file('profile_img');
        if($image != null) {
            $request->validate([
               'first_name' => 'required', 'middle_name' => 'required',
                'last_name' => 'required', 'address' => 'required', 'email' => 'email | required',
                'description' => 'required', 'contact' => 'required',
                'profile_img' => 'required | image | max:2048 | mimes: jpg,jpeg,png'
            ]);
            $imageName = time() . "." .$image->getClientOriginalExtension();
            $image->move(public_path('images/profile_images'), $imageName);
        } else if($request->get('first_name') == $request->get('first_name') &&
            $request->get('middle_name') == $request->get('middle_name') &&
            $request->get('last_name') == $request->get('last_name') &&
            $request->get('email') == $request->get('email') &&
            $request->get('address') == $request->get('address') &&
            $request->get('contact') == $request->get('contact') &&
            $request->get('description') == $request->get('description') &&
            $request->get('profile_img') == $request->get('profile_img')){
            return redirect()->back()->with('warning', 'No changes were made!');
        } else {
            $profile_img = Users::table('users')->select('profile_img')->where('id', $id);
            $request->validate([
                'first_name' => 'required', 'last_name' => 'required',
                'address' => 'required', 'email' => 'email | required',
                'description' => 'required', 'contact' => 'required'
            ]);
            $imageName = $profile_img;
        }

        $formData = array(
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'email' => $request->email,
            'contact_number' => $request->contact,
            'description' => $request->description,
            'profile_img' => $imageName
        );

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
