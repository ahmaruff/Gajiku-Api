<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

// this JSON response following the JSend standard https://github.com/omniti-labs/jsend
// with additional http status code following https://api.stackexchange.com/docs/error-handling

class GolonganController extends Controller
{
    public function index()
    {
        try {
            $golongan = DB::table('golongan')->get();
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'data' => [
                    'golongan' => $golongan
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

    public function getGolonganById($id)
    {
        try {
            $golongan = DB::table('golongan')->where('id',$id)->first();
            if($golongan){
                return response()->json([
                    'status' => 'success',
                    'code' => 200,
                    'data' => [
                        'golongan' => $golongan
                    ]
                ],Response::HTTP_OK);
            }else {
                $errors = [
                    'id' => 'The requested resource was not found.'
                ];
                return $this->resourceNotFound($errors);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'code' => 400,
                'message' => $th->getMessage()
            ],Response::HTTP_BAD_REQUEST);
        }
    }

    public function storeGolongan(Request $request)
    {
        if($request->isMethod('post')){
            try {
                $request->merge([
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]);
                $isCreated = DB::table('golongan')->insert($request->all());
                if($isCreated){
                    return response([
                        'status' => 'success',
                        'code' => 201,
                        'data' => [
                            'golongan' => $request->all()
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

    public function updateGolonganById(Request $request, $id)
    {
        if($request->isMethod('put')){
            try {
                $isExist = DB::table('golongan')->where('id',$id)->exists();
                if($isExist){
                    $request->merge([
                        'updated_at' => \Carbon\Carbon::now()
                    ]);
                    $affectedRows = DB::table('golongan')->where('id',$id)->update($request->all());
                    if($affectedRows > 0){
                        return response()->json([
                            'status' => 'success',
                            'code' => 200,
                            'data' => [
                                'golongan' => $request->all()
                            ]
                        ],Response::HTTP_OK);
                    }
                }else {
                    $errors = [
                        'id' => 'The requested resource was not found.'
                    ];
                    return $this->resourceNotFound($errors);
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

    public function deleteGolonganById(Request $request, $id)
    {
        if($request->isMethod('delete')){
            try {
                $isExist = DB::table('golongan')->where('id',$id)->exists();
                if($isExist){
                    $affectedRows = DB::table('golongan')->delete($id);
                    if($affectedRows > 0){
                        return response()->json([
                            'status' => 'success',
                            'code' => 200,
                            'data' => null
                        ],Response::HTTP_OK);
                    }
                }else {
                    $errors = [
                        'id' => 'The requested resource was not found.'
                    ];
                    return $this->resourceNotFound($errors);
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