<?php

namespace App\Http\Controllers;

use App\Models\AllSchedule;
use App\Models\Group;
use App\Models\GroupList;
use App\Models\User;
use Carbon\Carbon;

class ContentController extends Controller
{

    public function main($id)
    {
        //дата на сайті
        $currentDateTime = Carbon::now();
        $dateString = $currentDateTime->locale('uk')->isoFormat('dddd, D MMMM');


        $user = User::findOrFail($id); //отримання користувача за його ідентифікатором

        $courses = Group::join('groups_list', 'groups.id', '=', 'groups_list.group_id')
            ->where('groups_list.user_id', $id)
            ->select('groups.group_name', 'groups.id_type', 'groups.id')
            ->get(); //отримання списку курсів користувача

        $schedules = AllSchedule::join('groups', 'groups.id', '=', 'allschedules.group_id')
            ->join('groups_list', 'groups_list.group_id', '=', 'allschedules.group_id')
            ->where('groups_list.user_id', $id)
            ->select('allschedules.*', 'groups.group_name')
            ->get(); //індивідуальний розклад користувача

        return view('main', ['user' => $user,
            'courses' => $courses,
            'date' => $dateString,
            'schedules' => $schedules]);
    }


    public function content($id)
    {//інформація про курс

        $users = GroupList::join('users', 'users.id', '=', 'groups_list.user_id')
            ->where('group_id', $id)
            ->select('users.first_name', 'users.last_name')
            ->get();//учасники курсу

        $group_info = Group::join('teachers', 'teachers.id', '=', 'groups.teacher_id')
            ->join('lang_level', 'lang_level.id', '=', 'groups.level_id')
            ->join('group_type', 'group_type.id', '=', 'groups.id_type')
            ->where('groups.id', $id)
            ->select(
                'groups.group_name',
                'teachers.initials',
                'teachers.telegram',
                'teachers.phone',
                'lang_level.name')
            ->get();//інфо про курс

        $others = Group::where('id_type', function ($query) use ($id) {
            $query->select('id_type')->from('groups')->where('id', $id);
        })
            ->select('groups.group_name', 'groups.id')
            ->get();//пропозиція схожих курсів

        $schedules = AllSchedule::where('group_id', $id)
            ->get();//розклад занять курсів

        return view('content', ['users' => $users,
            'group_info' => $group_info,
            'others' => $others,
            'schedules' => $schedules]);

    }

    public function show_all_groups()
    {
        $GroupCount = 2; //1 і 2 типи - це парні та індвидуальні заняття.
        //Тому щоб сеператувати групові від індивідуальних, була введена ця змінна.

        $group_infos = Group::join('teachers', 'teachers.id', '=', 'groups.teacher_id')
            ->join('lang_level', 'lang_level.id', '=', 'groups.level_id')
            ->join('group_type', 'group_type.id', '=', 'groups.id_type')
            ->where('groups.id_type', '>', $GroupCount)
            ->select(
                'groups.group_name',
                'group_type.name AS type',
                'lang_level.name AS level',
                'teachers.initials',
                'groups.id'
            )
            ->get();//показуються усі курси, які доступні

        return view('groups', ['group_infos' => $group_infos]);
    }

}
