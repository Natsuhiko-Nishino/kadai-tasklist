<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

use App\User;

use App\Controllers;

class tasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'tasks' => $tasks,
            ];
            $data += $this->counts($user);
        return view('tasks.index', $data);
        }else {
            return view('welcome');
    }}
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $tasks = new Task;
       if(\Auth::check()){
         $data = [
             'tasks' => $tasks,
                ];
        return view('tasks.create', $data);
        }else{
            return redirect('/');
            }}  
       
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|max:10',   ]);
            
         $tasks = new Task;
        $tasks->content = $request->content;
         $tasks->status = $request->status;
         $tasks->user_id = \Auth::id();
        $tasks->save();

        return redirect('/');
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tasks = \App\Task::find($id);
       if($tasks == null){
           return redirect('/');
       }
       else{
            if(\Auth::check()){
       
                if (\Auth::user()->id === $tasks->user_id) {
                    $user = \Auth::user();
                    
                    $data = [
                        'tasks' => $tasks,
                        ];
                        
                    return view('tasks.show', $data);
                }
                else{
                    return redirect('/');
                }
                
            }
            else{
                return redirect('/');
            }
           }
        
    }
    
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tasks = \App\Task::find($id);

        if (\Auth::user()->id === $tasks->user_id) {
            return view('tasks.edit',[
                'tasks' => $tasks,
                ]);
        }else{
            return redirect('/');
    }}
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $this->validate($request, [
            'status' => 'required|max:10',
             ]);
        
         $tasks = Task::find($id);
        $tasks->content = $request->content;
        $tasks->status = $request->status;
        $tasks->save();
        

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $tasks = \App\Task::find($id);

        if (\Auth::user()->id === $tasks->user_id) {
            $tasks->delete();
        

        return redirect('/');
    }}
}