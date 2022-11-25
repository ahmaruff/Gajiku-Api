<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

// this JSON response following the JSend standard https://github.com/omniti-labs/jsend
// with additional http status code following https://api.stackexchange.com/docs/error-handling


class PegawaiController extends Controller
{
    public function index()
    {
        try {
            $pegawai = DB::table('pegawai')->get();
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'data' => [
                    'pegawai' => $pegawai
                ]
            ], Response::HTTP_OK);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'code' => 400,
                'message' => $th->getMessage()
            ],Response::HTTP_BAD_REQUEST);
        }
    }

    public function getPegawaiById($id)
    {
        try {
            $pegawai = DB::table('pegawai')->where('id',$id)->first();
            if($pegawai){
                return response()->json([
                    'status' => 'success',
                    'code' => 200,
                    'data' => [
                        'pegawai' => $pegawai
                    ]
                ],Response::HTTP_OK);
            }else {
                return response()->json([
                    'status' => 'fail',
                    'code' => 404,
                    'data' => [
                        'id' => 'data not found or record doesn\'t exist'
                    ]
                ],Response::HTTP_NOT_FOUND);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'code' => 400,
                'message' => $th->getMessage()
            ],Response::HTTP_BAD_REQUEST);
        }
    }

    public function storePegawai(Request $request)
    {
        if($request->isMethod('post')){
            try {
                $request->merge([
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]);
                $isCreated = DB::table('pegawai')->insert($request->all());
                if($isCreated){
                    return response([
                        'status' => 'success',
                        'code' => 201,
                        'data' => [
                            'pegawai' => $request->all()
                        ]
                    ],Response::HTTP_CREATED);
                }
                
            } catch (\Throwable $th) {    
                return response()->json([
                    'status' => 'error',
                    'code' => 400,
                    'message' => $th->getMessage()
                ],Response::HTTP_BAD_REQUEST);
            }
        }
    }

    public function updatePegawaiById(Request $request, $id)
    {
        if($request->isMethod('put')){
            try {
                $isExist = DB::table('pegawai')->where('id',$id)->exists();
                if($isExist){
                    $request->merge([
                        'updated_at' => \Carbon\Carbon::now()
                    ]);
                    $affectedRows = DB::table('pegawai')->where('id',$id)->update($request->all());
                    if($affectedRows > 0){
                        return response()->json([
                            'status' => 'success',
                            'code' => 200,
                            'data' => [
                                'pegawai' => $request->all()
                            ]
                        ],Response::HTTP_OK);
                    }
                }else {
                    return response()->json([
                        'status' => 'fail',
                        'code' => 404,
                        'data' => [
                            'id' => 'record doesn\'t exist' 
                        ]
                    ],Response::HTTP_NOT_FOUND);
                }
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => 'error',
                    'code' => 400,
                    'message' => $th->getMessage()
                ],Response::HTTP_BAD_REQUEST);
            }
        }   
    }

    public function deletePegawaiById(Request $request, $id)
    {
        if($request->isMethod('delete')){
            try {
                $isExist = DB::table('pegawai')->where('id',$id)->exists();
                if($isExist){
                    $affectedRows = DB::table('pegawai')->delete($id);
                    if($affectedRows > 0){
                        return response()->json([
                            'status' => 'success',
                            'code' => 200,
                            'data' => null
                        ],Response::HTTP_OK);
                    }
                }else {
                    return response()->json([
                        'status' => 'fail',
                        'code' => 404,
                        'data' => [
                            'id' => 'record doesn\'t exist' 
                        ]
                    ],Response::HTTP_NOT_FOUND);
                }
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => 'error',
                    'code' => 400,
                    'message' => $th->getMessage()
                ],Response::HTTP_BAD_REQUEST);
            }
        }
    }
}