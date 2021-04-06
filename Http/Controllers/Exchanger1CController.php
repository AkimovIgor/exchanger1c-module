<?php

namespace Modules\Exchanger1C\Http\Controllers;

use Bigperson\Exchange1C\Exceptions\Exchange1CException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use Modules\Exchanger1C\Services\CatalogService;

class Exchanger1CController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
//        $image = config('exchange1c.import_dir') . DIRECTORY_SEPARATOR . 'import_files/de/dee6e1d055bc11d9848a00112f43529a_470c76f995f611eb8b0700d861dc7c33.jpg';
//        $file = File::name($image);
//
//        dd($file);

        $path = scandir(config('exchange1c.import_dir'));
        $filesAndCatalogs = array_diff($path, ['.', '..']);
        $files = [];
        foreach ($filesAndCatalogs as $file) {
            if (Str::contains($file, '.'))
                $files[] = $file;
        }

        return view('exchanger1c::index', compact('files'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveConfig(Request $request)
    {
        $data = $request->all();
        foreach ($data as $key => $value) {
            try{
                if ($key == '_token') continue;
                DotenvEditor::setKey('EXCHANGER1C_' . Str::upper($key), $value);
                DotenvEditor::save();
            } catch (\Exception $e){
                return redirect()->back()->withErrors([
                    'message' => 'Failed'
                ]);
            }
        }

        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('exchanger1c::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('exchanger1c::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('exchanger1c::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param Request        $request
     * @param CatalogService $service
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function request(Request $request, CatalogService $service)
    {
        $mode = $request->get('mode');
        $type = $request->get('type');

        try {
            if ($type == 'catalog' || $type == 'file') {
                if (!method_exists($service, $mode)) {
                    throw new Exchange1CException('not correct request, class ExchangeCML not found');
                }

                $response = $service->$mode();
                \Log::debug('exchange_1c: $response='."\n".$response);

                return response($response, 200, ['Content-Type', 'text/plain']);
            } else {
                throw new \LogicException(sprintf('Logic for method %s not released', $type));
            }
        } catch (Exchange1CException $e) {
            \Log::error("exchange_1c: failure \n".$e->getMessage()."\n".$e->getFile()."\n".$e->getLine()."\n");

            $response = "failure\n";
            $response .= $e->getMessage()."\n";
            $response .= $e->getFile()."\n";
            $response .= $e->getLine()."\n";

            return response($response, 500, ['Content-Type', 'text/plain']);
        }
    }
}
