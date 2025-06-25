<?php
namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function index() {
        $workers = Worker::all();
        return view('workers.index', compact('workers'));
    }
    public function create() {
        return view('workers.create');
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'unit' => 'required',
            'price' => 'required|integer',
            'tkdn' => 'required|integer',
        ]);
        Worker::create($request->all());
        return redirect()->route('workers.index')->with('success', 'Worker created!');
    }
    public function edit(Worker $worker) {
        return view('workers.edit', compact('worker'));
    }
    public function update(Request $request, Worker $worker) {
        $request->validate([
            'name' => 'required',
            'unit' => 'required',
            'price' => 'required|integer',
            'tkdn' => 'required|integer',
        ]);
        $worker->update($request->all());
        return redirect()->route('workers.index')->with('success', 'Worker updated!');
    }
    public function destroy(Worker $worker) {
        $worker->delete();
        return redirect()->route('workers.index')->with('success', 'Worker deleted!');
    }
} 