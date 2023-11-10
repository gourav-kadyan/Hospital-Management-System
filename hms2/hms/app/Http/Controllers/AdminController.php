<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Doctor;

use App\Models\Appointment;

class AdminController extends Controller
{
    public function addview(){
        return view('admin.add_doctor');
    }

    public function upload(Request $request){
        $doctor = new Doctor;
    

        if ($request->hasFile('file')) {
            $image = $request->file('file');
    

            $imageName = time() . '.' . $image->getClientOriginalExtension();
    

            $image->move('doctorimage', $imageName);
    
            $doctor->image = $imageName;
        }
    
        $doctor->name = $request->name;
        $doctor->phone = $request->number;
        $doctor->room = $request->room;
        $doctor->speciality = $request->speciality;
    
        $doctor->save();
    
        return redirect()->back()->with('message', 'Added Successfully');
    }
    

    public function showappointment(){

        $data=appointment::all();

        return view('admin.showappointment', compact('data'));
    }


    public function approved($id){

        $data=appointment::find($id);

        $data->status='approved';

        $data->save();

        return redirect()->back();

    }


    public function rejected($id){

        $data=appointment::find($id);

        $data->status='rejected';

        $data->save();

        return redirect()->back();

    }

}
