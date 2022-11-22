<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class GolonganController extends Controller
{
    public function index()
    {
        $golongan = DB::table('golongan')->get();

        if(count($golongan) != 0){
           return response()->json($golongan,Response::HTTP_OK);
        }
        else{
            return response()->json([],Response::HTTP_NO_CONTENT);
        }
    }

    public function getGolonganById($id)
    {
        $gol = DB::table('golongan')->where('id',$id)->first();
        if($gol){
            return response()->json($gol);
        }else {
            return response()->json([],Response::HTTP_NOT_FOUND);
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
                // $golongan = $request->all();
                $isCreated = DB::table('golongan')->insert($request->all());
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

    public function updateGolonganById(Request $request, $id)
    {
        if($request->isMethod('put')){
            $request->merge([
                'updated_at' => \Carbon\Carbon::now()
            ]);
            $isUpdated = DB::table('golongan')->where('id',$id)->update($request->all());
            return response([
                'status' => $isUpdated,
                'message' => 'success',
                'id' => $id,
                'data' => $request->all()
            ],Response::HTTP_OK);
            
        }
    }

    public function deleteGolonganById(Request $request, $id)
    {
        if($request->isMethod('delete')){
            $isDeleted = DB::table('golongan')->delete($id);
            return response()->json([
                'status' => $isDeleted,
                'message' => 'success',
                'id' => $id
            ],Response::HTTP_OK);
        }
    }
}