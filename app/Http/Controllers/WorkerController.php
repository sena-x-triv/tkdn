<?php
namespace App\Http\Controllers;

use App\Models\Worker;
use App\Models\Category;
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
        $categories = Category::orderBy('name')->get();
        return view('worker.create', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate([
            'code' => 'required|unique:workers,code',
            'name' => 'required',
            'unit' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'required|integer',
            'tkdn' => 'required|integer',
            'location' => 'nullable|string'
        ]);
        Worker::create($request->all());
        return redirect()->route('master.worker.index')->with('success', 'Worker created!');
    }

    public function show(Worker $worker) {
        return view('worker.show', compact('worker'));
    }

    public function edit(Worker $worker) {
        $categories = Category::orderBy('name')->get();
        return view('worker.edit', compact('worker', 'categories'));
    }

    public function update(Request $request, Worker $worker) {
        $request->validate([
            'code' => 'required|unique:workers,code,' . $worker->id . ',id',
            'name' => 'required',
            'unit' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'required|integer',
            'tkdn' => 'required|integer',
            'location' => 'nullable|string'
        ]);
        $worker->update($request->all());
        return redirect()->route('master.worker.index')->with('success', 'Worker updated!');
    }

    public function destroy(Worker $worker) {
        $worker->delete();
        return redirect()->route('master.worker.index')->with('success', 'Worker deleted!');
    }
} 