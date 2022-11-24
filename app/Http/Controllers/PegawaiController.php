<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai  = DB::table('pegawai')->get();

        return response()->json($pegawai,Response::HTTP_OK);
    }

    public function getPegawaiById($id)
    {
        $pegawai = DB::table('pegawai')->where('id',$id)->first();
        return response()->json($pegawai,Response::HTTP_OK);
    }

    public function storePegawai(Request $request)
    {
        if($request->isMethod('post')){
            try {
                $request->merge([
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]);
                // $golongan = $request->all();
                $isCreated = DB::table('pegawai')->insert($request->all());
                return response([
                    'status' => $isCreated,
                    'message' => 'success',
                    'data' => $request->all()
                ],Response::HTTP_CREATED);
                
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }

    public function updatePegawaiById(Request $request, $id)
    {
        if($request->isMethod('put')){
            $request->merge([
                'updated_at' => \Carbon\Carbon::now()
            ]);
            $isUpdated = DB::table('pegawai')->where('id',$id)->update($request->all());
            return response([
                'status' => $isUpdated,
                'message' => 'success',
                'id' => $id,
                'data' => $request->all()
            ],Response::HTTP_OK);
        }
    }

    public function deletePegawaiById(Request $request, $id)
    {
        if($request->isMethod('delete')){
            $isDeleted = DB::table('pegawai')->delete($id);
            return response()->json([
                'status' => $isDeleted,
                'message' => 'success',
                'id' => $id
            ],Response::HTTP_OK);
        }
    }
}