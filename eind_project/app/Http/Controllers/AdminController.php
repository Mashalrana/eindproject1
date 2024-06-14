<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Schedule;
use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Admin registratie
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:accounts,account_username',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'required|string|max:255',
            'postcode' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
        ]);

        $user = new User();
        $user->account_username = $request->username;
        $user->account_password = Hash::make($request->password);
        $user->role = 'admin';
        $user->address = $request->address;
        $user->postcode = $request->postcode;
        $user->city = $request->city;
        $user->phone_number = $request->phone_number;
        $user->save();

        return response()->json(['message' => 'Admin account created successfully']);
    }

    // Inloggen
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['account_username' => $credentials['username'], 'password' => $credentials['password'], 'role' => 'admin'])) {
            $request->session()->regenerate();
            return response()->json(['message' => 'Logged in successfully']);
        }

        return response()->json(['message' => 'Login failed'], 401);
    }

    // Uitloggen
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json(['message' => 'Logged out successfully']);
    }

    // Dashboard
    public function dashboard()
    {
        return response()->json(['message' => 'Welcome to the admin dashboard']);
    }

    // Nieuwe docenten toevoegen
    public function addTeacher(Request $request)
    {
        $request->validate([
            'teacher_name' => 'required|string|max:255',
            'account_id' => 'required|exists:accounts,account_id',
        ]);

        $teacher = new Teacher();
        $teacher->teacher_name = $request->teacher_name;
        $teacher->account_id = $request->account_id;
        $teacher->save();

        return response()->json(['message' => 'Teacher added successfully']);
    }

    // Informatie over docenten editen
    public function editTeacher(Request $request, $id)
    {
        $request->validate([
            'teacher_name' => 'required|string|max:255',
            'account_id' => 'required|exists:accounts,account_id',
        ]);

        $teacher = Teacher::findOrFail($id);
        $teacher->teacher_name = $request->teacher_name;
        $teacher->account_id = $request->account_id;
        $teacher->save();

        return response()->json(['message' => 'Teacher updated successfully']);
    }

    // Docent uit het systeem verwijderen
    public function deleteTeacher($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return response()->json(['message' => 'Teacher deleted successfully']);
    }

    // Overzicht van alle docenten
    public function listTeachers()
    {
        $teachers = Teacher::all();
        return response()->json($teachers);
    }

    // Rooster toevoegen voor de eerstvolgende week
    public function addSchedule(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,class_id',
            'subject_id' => 'required|exists:subjects,subject_id',
            'teacher_id' => 'required|exists:teachers,teacher_id',
            'schedule_date' => 'required|date',
            'schedule_time' => 'required|date_format:H:i:s',
        ]);

        $schedule = new Schedule();
        $schedule->class_id = $request->class_id;
        $schedule->subject_id = $request->subject_id;
        $schedule->teacher_id = $request->teacher_id;
        $schedule->schedule_date = $request->schedule_date;
        $schedule->schedule_time = $request->schedule_time;
        $schedule->save();

        return response()->json(['message' => 'Schedule added successfully']);
    }
}
