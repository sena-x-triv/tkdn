<?php
namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $workers = Worker::paginate(10);
        return view('worker.index', compact('workers'));
    }

    public function create() {
        return view('worker.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'unit' => 'required',
            'price' => 'required|integer',
            'tkdn' => 'required|integer',
        ]);
        Worker::create($request->all());
        return redirect()->route('worker.index')->with('success', 'Worker created!');
    }

    public function edit(Worker $worker) {
        return view('worker.edit', compact('worker'));
    }

    public function update(Request $request, Worker $worker) {
        $request->validate([
            'name' => 'required',
            'unit' => 'required',
            'price' => 'required|integer',
            'tkdn' => 'required|integer',
        ]);
        $worker->update($request->all());
        return redirect()->route('worker.index')->with('success', 'Worker updated!');
    }

    public function destroy(Worker $worker) {
        $worker->delete();
        return redirect()->route('worker.index')->with('success', 'Worker deleted!');
    }
} 