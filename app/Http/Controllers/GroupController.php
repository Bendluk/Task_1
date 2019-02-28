<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Groups;
use App\Group_list;

class GroupController extends Controller
{
    public function group_index()
    {
        $Groups = Groups::all();

        return view('Groups.group_index',compact ('Groups'));
    }

    /**
     * Show all groups.
     *
     * @return \Illuminate\Http\Response
     */
    public function group_create()
    {
        return view('Groups.group_create');
    }

    /**
     * Create a new group
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function group_store(Request $request)
    {
        $request->validate([
            'group_name' => 'required|string'
        ]);

        $group = new Groups([

            'group_name' => trim($request->get('group_name'))

        ]);

        $group->save();

        return redirect('/Groups')->with('success','The group has been successfully created');

    }


    /**
     * Show all available people to add to group.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function add_to_group($id)
    {
        $enrolled_users = Group_list::with(['user','group'])->where('group_id', $id)->get();

        $userList = array();
        foreach($enrolled_users as $en_users){
            array_push($userList,$en_users->user->id);
        }
        $available_users  = User::whereNotIn('id',$userList)->get();

        $group = Groups::where('id',$id)->first();

        return view('Groups.user_list_show',compact ('available_users','enrolled_users','group'));
    }

    /**
     * Store data to Group_list
     *
     * @param  int  $group_id, $user_id
     * @return \Illuminate\Http\Response
     */
    public function add_to_group_ins($group_id,$user_id)
    {
        $group_list = new Group_list([

            'group_id' => $group_id,
            'user_id'  => $user_id

        ]);

        $group_list->save();

        return redirect(route('Groups.add_to_group',['Group' => $group_id]))->with('success', 'The User has been successfully added to the group');
    }

    /**
     * DELETE a user from the group
     *
     * @param  int  $user_id, $group_id
     * @return \Illuminate\Http\Response
     */
    public function destroy_user_entry($group_id,$user_id)
    {
        $userGroups = Group_list::where('user_id',$user_id)->where('group_id',$group_id);
        $userGroups->delete();

        return redirect(route('Groups.add_to_group',['Group' => $group_id]))->with('success','The User has been successfully removed from the group');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function group_destroy($id)
    {
        if(Group_list::where('group_id',$id)->doesntExist()) {

            $group = Groups::find($id);
            $group->delete();

            return redirect('/Groups')->with('success','The group has been successfully deleted');
        }else{

            $group = Groups::find($id);
            return redirect('/Groups')->with('error',$group->group_name.' has enrolled members, please see the list for more information');
        }
    }
}
