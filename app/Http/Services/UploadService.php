<?php

namespace App\Http\Services;


class UploadService
{
    public function store($request)
    {

        if (!empty($request->file('file'))) {
            try {


                $file = $request->file('file');
                $name = $file->getClientOriginalName();
                //dd($name);
                $pathFull = 'uploads/' . date("y/M/d");

                $request->file('file')->storeAs(
                    'public/' . $pathFull, $name
                );
                return '/storage/' . $pathFull . '/' . $name;
            } catch (\Exception $error) {
                return false;
            }

        }

    }
}
