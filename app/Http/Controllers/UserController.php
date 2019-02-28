<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Groups;
use App\Group_list;

class UserController extends Controller
{
    /**
     * Display all users.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_index()
    {
        $Users = User::all();

        return view('Users.user_index',compact ('Users'));
    }

    /**
     * Show user creation form.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_create()
    {
        return view('Users.user_create');
    }

    /**
     * Store user data in User table.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function user_store(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string'
        ]);

        $user = new User([
            'name' => trim($request->get('user_name'))

        ]);

        $user->save();

        return redirect('/User')->with('success','The User has been successfully created');

    }

    /**
     * Check for user groups and free groups, return group add view with some user information.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function add_to_group($id)
    {
        $enrolled_groups = Group_list::with(['user','group'])->where('user_id', $id)->get();

        $groupList = array();
        foreach($enrolled_groups as $en_group){
            array_push($groupList,$en_group->group->id);
        }

        $available_groups = Groups::whereNotIn('id',$groupList)->get();
        $user = User::where('id',$id)->first();

        return view('Users.group_list_show',compact ('available_groups','enrolled_groups','user'));
    }

    /**
     * Insert user to a new group.
     *
     * @param  int  $user_id, $group_id
     * @return \Illuminate\Http\Response
     */
    public function add_to_group_ins($user_id, $group_id)
    {
        $group_list = new Group_list([

            'group_id' => $group_id,
            'user_id'  => $user_id

        ]);

        $group_list->save();

        return redirect(route('User.add_to_group',['User' => $user_id]))->with('success','The User has been successfully added to the group');
    }

    /**
     * DELETE a user from the group
     *
     * @param  int  $user_id, $group_id
     * @return \Illuminate\Http\Response
     */
    public function destroy_group_entry($user_id, $group_id)
    {
        $userGroups = Group_list::where('user_id',$user_id)->where('group_id',$group_id);
        $userGroups->delete();

        return redirect(route('User.add_to_group',['User' => $user_id]))->with('success','The User has been successfully removed from the group');
    }

    /**
     * Remove the user from User and Group_list.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function user_destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        $userGroups = Group_list::where('user_id',$id);
        $userGroups->delete();

        return redirect('/User')->with('success','The user has been successfully deleted');
    }
}
