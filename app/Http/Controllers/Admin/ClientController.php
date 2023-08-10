<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ClientStatus;
use App\Http\Controllers\Controller;
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        return Client::query()
            ->when(request('status'), function ($query) {
                return $query->where('status', ClientStatus::from(request('status')));
            })
            ->latest()
            ->paginate()
            ->through(fn ($client) => [
                'id' => $client->id,
                'first_name' => $client->first_name,
                'last_name' => $client->last_name,
                'email' => $client->email,
                'status' => [
                    'name' => $client->status->name,
                    'color' => $client->status->color(),
                ]
            ]);
    }
    
    public function store()
    {
        $validated = request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
        ]);

        Client::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'status' => ClientStatus::ACTIVE,
        ]);

        return response()->json(['message' => 'success']);
    }

    public function edit(Client $client)
    {
        return $client;
    }

    public function update(Client $client)
    {
        $validated = request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
        ]);

        $client->update($validated);

        return response()->json(['success' => true]);
    }
//
//   public function destroy(Appointment $appointment)
//   {
//       $appointment->delete();
//
//       return response()->json(['success' => true], 200);
//   }
}
