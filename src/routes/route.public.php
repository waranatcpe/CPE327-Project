<?php
/* public route */
Route::get('/portfolio/{filename}', function($path){
    $fileName = storage_path()."/app/uploads/portfolio/$path";
    if (File::exists($fileName)){
        return Response::file($fileName);
    }
    return abort(404);
});

Route::get('/transcript/{filename}', function($path){
    $fileName = storage_path()."/app/uploads/transcript/$path";
    if (File::exists($fileName)){
        return Response::file($fileName);
    }
    return abort(404);
});

Route::get('/sop/{filename}', function($path){
    $fileName = storage_path()."/app/uploads/sop/$path";
    if (File::exists($fileName)){
        return Response::file($fileName);
    }
    return abort(404);
});

Route::get('/alumni/{filename}', function($path){
    $fileName = storage_path()."/app/uploads/alumni_doc/$path";
    if (File::exists($fileName)){
        return Response::file($fileName);
    }
    return abort(404);
});

?>