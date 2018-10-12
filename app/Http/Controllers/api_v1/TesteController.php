<?php

namespace App\Http\Controllers\Api_v1;

use App\Core\ControllerAbstract;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Adapters\EmailAdapter;

class TesteController extends ControllerAbstract
{
    //GET
    public function index()
    {

        $emailAdapter = new EmailAdapter();
        $emailAdapter->setEmailSubject('EMAIL DE TESTE');
        $emailAdapter->setEmailContent(['text' => 'aqui é um email de teste']);
        $emailAdapter->addEmailReceiver('rafaelmori123@gmail.com', 'Rafael');
        vaR_dump($emailAdapter->send());

    }

    //GET/id
    public function show($id)
    {
        return response()->json("Not Implemented");
    }

    //POST
    public function store(Request $request)
    {
        return response()->json("Not Implemented");
    }

    //PUT
    public function update(Request $request, $id)
    {
        return response()->json("Not Implemented");
    }


}
