<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentRequest;
use App\Mail\AppointmentConfirmation;
use App\Models\Appointment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class AppointmentController extends Controller
{
    /**
     * Display a listing of user's appointments.
     */
    public function index(): View
    {
        $viewData                 = [];
        $viewData['title']        = __('appointments.my_appointments');
        $viewData['appointments'] = Auth::user()->appointments()->orderBy('date', 'desc')->orderBy('time', 'desc')->get();

        return view('appointment.index')->with('viewData', $viewData);
    }

    /**
     * Show the form for creating a new appointment.
     */
    public function create(): View
    {
        $viewData          = [];
        $viewData['title'] = __('appointments.create_appointment');

        return view('appointment.create')->with('viewData', $viewData);
    }

    /**
     * Store a newly created appointment in storage.
     */
    public function store(AppointmentRequest $request): RedirectResponse
    {
        $appointment = new Appointment;
        $appointment->setUserId(Auth::id());
        $appointment->setDate($request->input('date'));
        $appointment->setTime($request->input('time'));
        $appointment->setPetName($request->input('pet_name'));
        $appointment->setPetType($request->input('pet_type'));
        $appointment->setReason($request->input('reason'));
        $appointment->setStatus('pending');
        $appointment->save();

        // Send confirmation email
        Mail::to(Auth::user()->getEmail())->send(new AppointmentConfirmation($appointment));

        return redirect()->route('appointment.index')
            ->with('success', __('appointments.created_success'));
    }

    /**
     * Display the specified appointment.
     */
    public function show(int $id): View
    {
        $viewData    = [];
        $appointment = Appointment::findOrFail($id);

        // Check if user owns this appointment
        if ($appointment->getUserId() !== Auth::id()) {
            abort(403);
        }

        $viewData['title']       = __('appointments.appointment_details');
        $viewData['appointment'] = $appointment;

        return view('appointment.show')->with('viewData', $viewData);
    }

    /**
     * Remove the specified appointment from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        $appointment = Appointment::findOrFail($id);

        // Check if user owns this appointment
        if ($appointment->getUserId() !== Auth::id()) {
            abort(403);
        }

        $appointment->delete();

        return redirect()->route('appointment.index')
            ->with('success', __('appointments.deleted_success'));
    }
}
