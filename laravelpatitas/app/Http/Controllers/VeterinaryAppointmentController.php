<?php

namespace App\Http\Controllers;

use App\Models\VeterinaryAppointment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VeterinaryAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $viewData                 = [];
        $viewData['title']        = __('messages.veterinary_appointments');
        $viewData['appointments'] = VeterinaryAppointment::with('user')->get();

        return view('veterinary-appointment.index')->with('viewData', $viewData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $viewData          = [];
        $viewData['title'] = 'Solicitar nueva cita veterinaria';
        $user = auth()->user();
        if ($user && $user->isAdmin()) {
            $viewData['users'] = \App\Models\User::all();
        } else {
            $viewData['users'] = null;
        }
        return view('veterinary-appointment.create')->with('viewData', $viewData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $user = auth()->user();
        $rules = [
            'date_time'    => 'required|date|after:now',
            'service_type' => 'required|string|max:255',
            'status'       => 'required|in:programada,confirmada,completada,cancelada',
            'notes'        => 'nullable|string',
        ];
        if ($user && $user->isAdmin()) {
            $rules['user_id'] = 'required|exists:users,id';
        }
        $request->validate($rules);

        $appointment = new VeterinaryAppointment;
        $appointment->setDateTime($request->input('date_time'));
        $appointment->setServiceType($request->input('service_type'));
        $appointment->setStatus($request->input('status'));
        $appointment->setNotes($request->input('notes'));
        if ($user && $user->isAdmin()) {
            $appointment->setUserId($request->input('user_id'));
        } else {
            $appointment->setUserId($user ? $user->getId() : null);
        }

        // Check for time conflicts
        if (VeterinaryAppointment::hasTimeConflict($request->input('date_time'))) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['date_time' => __('messages.appointment_time_conflict')]);
        }

        $appointment = new VeterinaryAppointment;
        $appointment->setDateTime($request->input('date_time'));
        $appointment->setServiceType($request->input('service_type'));
        $appointment->setStatus($request->input('status'));
        $appointment->setNotes($request->input('notes'));
        $appointment->setUserId($request->input('user_id'));
        $appointment->save();

        return redirect()->route('veterinary-appointment.index')
            ->with('success', __('messages.appointment_created_successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): View
    {
        $viewData                = [];
        $appointment             = VeterinaryAppointment::with('user')->findOrFail($id);
        $viewData['title']       = __('messages.veterinary_appointment_details');
        $viewData['appointment'] = $appointment;

        return view('veterinary-appointment.show')->with('viewData', $viewData);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): View
    {
        $viewData                = [];
        $appointment             = VeterinaryAppointment::findOrFail($id);
        $viewData['title']       = __('messages.edit_veterinary_appointment');
        $viewData['appointment'] = $appointment;

        return view('veterinary-appointment.edit')->with('viewData', $viewData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'date_time'    => 'required|date|after:now',
            'service_type' => 'required|string|max:255',
            'status'       => 'required|in:programada,confirmada,completada,cancelada',
            'notes'        => 'nullable|string',
        ]);

        // Check for time conflicts (exclude current appointment)
        if (VeterinaryAppointment::hasTimeConflict($request->input('date_time'), $id)) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['date_time' => __('messages.appointment_time_conflict')]);
        }

        $appointment = VeterinaryAppointment::findOrFail($id);
        $appointment->setDateTime($request->input('date_time'));
        $appointment->setServiceType($request->input('service_type'));
        $appointment->setStatus($request->input('status'));
        $appointment->setNotes($request->input('notes'));
        $appointment->save();

        return redirect()->route('veterinary-appointment.show', $id)
            ->with('success', __('messages.appointment_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        $appointment = VeterinaryAppointment::findOrFail($id);
        $appointment->delete();

        return redirect()->route('veterinary-appointment.index')
            ->with('success', __('messages.appointment_deleted_successfully'));
    }
}
