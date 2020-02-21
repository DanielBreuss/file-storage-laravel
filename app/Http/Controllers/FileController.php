<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::orderBy('created_at', 'DESC')->paginate(30);
        return view('file.index', ['files' => $files]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('file.upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $files = $request->file('file');
        foreach ($files as $file) {
            File::create([
                'title' => $file->getClientOriginalName(),
                'path' => $file->store('public/storage'),
                'user_id' => Auth::id()
            ]);
        }

        return redirect('/file')->with('success', 'File has been stored');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $dl = File::find($id);
        if ($dl->user_id == Auth::id()) {
            return Storage::download($dl->path, $dl->title);
        } else {
            echo "Its not your file!";
/*            $error = "Its not your file!";
            return view('file.index', ['error' => $error]);*/
        }
    }

    /**
     * Show the form for editing the specified resource.
     *error
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = File::find($id);

        if ($del->user_id == Auth::id()) {
            Storage::delete($del->path);
            $del->delete();
            return redirect('/file');
        } else {
            echo "Its not your file!";
        }
    }
}
