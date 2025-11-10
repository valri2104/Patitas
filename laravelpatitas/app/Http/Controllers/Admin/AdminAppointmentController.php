<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Models\Appointment;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminAppointmentController extends Controller
{

    public function index(): View
    {
        $viewData                 = [];
        $viewData['title']        = __('appointments.admin_appointments');
        $viewData['appointments'] = Appointment::with('user')
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->get();

        return view('admin.appointment.index')->with('viewData', $viewData);
    }

    public function show(int $id): View
    {
        $viewData    = [];
        $appointment = Appointment::with('user')->findOrFail($id);

        $viewData['title']       = __('appointments.appointment_details');
        $viewData['appointment'] = $appointment;

        return view('admin.appointment.show')->with('viewData', $viewData);
    }

    public function edit(int $id): View
    {
        $viewData    = [];
        $appointment = Appointment::findOrFail($id);

        $viewData['title']       = __('appointments.edit_appointment');
        $viewData['appointment'] = $appointment;

        return view('admin.appointment.edit')->with('viewData', $viewData);
    }

    public function update(AppointmentRequest $request, int $id): RedirectResponse
    {
        $appointment = Appointment::findOrFail($id);

        $appointment->setDate($request->input('date'));
        $appointment->setTime($request->input('time'));
        $appointment->setPetName($request->input('pet_name'));
        $appointment->setPetType($request->input('pet_type'));
        $appointment->setReason($request->input('reason'));

        if ($request->has('status')) {
            $appointment->setStatus($request->input('status'));
        }

        $appointment->save();

        return redirect()->route('admin.appointment.index')
            ->with('success', __('appointments.updated_success'));
    }

    public function destroy(int $id): RedirectResponse
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->route('admin.appointment.index')
            ->with('success', __('appointments.deleted_success'));
    }
}
