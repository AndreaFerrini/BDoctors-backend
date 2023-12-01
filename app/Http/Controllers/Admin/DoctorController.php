<?php

namespace App\Http\Controllers\Admin;

use App\Models\Doctor;
use App\Models\Sponsor;
use App\Models\Typology;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    // Validazioni per validare i dati
    private $validations = [
        'name'              => 'required',
        'email'             => 'required',
        'address'           => 'required',
        'description'       => 'nullable',
        'photo'             => 'required|image|mimes:jpeg,png,jpg,gif|max:10800',
    ];

    //messaggio che ti esce nel momento in cui il campo non è stato commpilato
    private $validations_messages = [
        'required' => 'il campo :attribute è obbligatorio'
    ];




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::with('user')->where('user_id', Auth::id())->paginate(5);

        return view('admin.doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors = Doctor::all();
        $typologies = Typology::all();
        $sponsors = Sponsor::all();

        return view('admin.doctors.create', compact('doctors', 'typologies', 'sponsors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate($this->validations, $this->validations_messages);
        $data = $request->all();


        $newDoctor = new Doctor();

        $newDoctor->user_id = Auth::id();
        $newDoctor->name = $data['name'];
        $newDoctor->slug = Doctor::slugger($data['name']);
        $newDoctor->address = $data['address'];
        $newDoctor->description = $data['description'];
        $newDoctor->photo = $data['photo'];
        $newDoctor->visibility = $data['visibility'];

        if (isset($request->visibility)) {
            $data['visibility'] = true;
        } else {
            $data['visibility'] = false;
        };


        if (isset($data['photo'])) {
                $photoPath = Storage::put('img', $data['photo']);
                $newDoctor->photo = $photoPath;
            }

        $newDoctor->save();

        return view('admin.doctors.show', ['doctor' => $newDoctor]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $doctor = Doctor::where('slug', $slug)->firstOrFail();
        if (Auth::id() !== $doctor->user_id) abort(403);
        return view('admin.doctors.show', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        $doctors = Doctor::all();
        $typologies = Typology::all();
        $sponsors = Sponsor::all();
        
        if (Auth::id() !== $doctor->user_id) abort(403);
        return view('admin.doctors.create', compact('doctors', 'typologies', 'sponsors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        //
    }
}
