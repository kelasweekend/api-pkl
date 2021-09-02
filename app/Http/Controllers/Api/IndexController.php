<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\Announcements;
use App\Models\Api\Daily_reports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => 'Selamat datang di REST API'
        ], Response::HTTP_OK);

        // return response()->json([
        //     'success' => false,
        //     'message' => 'endpoint awal',
        // ], Response::HTTP_UNAUTHORIZED);
    }

    public function announcements($id)
    {
        $data = Announcements::where('study_program_id', $id)->get();
        if (empty($data)) {
            # jika data tidak ada maka
            return response()->json([
                'error' => true,
                'message' => 'Data Tidak tersedia',
            ], Response::HTTP_UNAUTHORIZED);
        } else {
            # jika data ada maka 
            return response()->json([
                'success' => true,
                'data' => $data
            ], Response::HTTP_OK);
        }
    }

    public function daily_reports($user_id)
    {
        $data = DB::table('daily_reports')->where('user_id', $user_id)->get();
        if (empty($data)) {
            # jika data tidak ada maka
            return response()->json([
                'error' => true,
                'message' => 'Data Tidak tersedia',
            ], Response::HTTP_UNAUTHORIZED);
        } else {
            # jika data ada maka 
            return response()->json([
                'success' => true,
                'data' => $data
            ], Response::HTTP_OK);
        }
    }

    public function daily_create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'date' => 'required',
            'description' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()], 200);
        }

        Daily_reports::insert([
            'user_id' => $request->user_id,
            // 'work_place_id' => $request->work_place_id,
            // 'value' => $request->value,
            // 'name' => $request->name,
            'date' => $request->date,
            'description' => $request->description,
            'is_active' => 1,
            'createdby' => $request->user_id,
            'created' => date('Y-m-d h:m:s'),
            // 'updatedby' => $request->updatedby,
            'updated' => date('Y-m-d h:m:s'),
            'is_approve' => 1,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil diupload'
        ], Response::HTTP_OK);
    }

    public function daily_update(Request $request, $id)
    {
        $data = Daily_reports::where('daily_report_id', $id)->first();
        if (empty($data)) {
            # jika data tidak ada maka
            return response()->json([
                'error' => true,
                'message' => 'Data Tidak tersedia',
            ], Response::HTTP_UNAUTHORIZED);
        } else {
            # jika data ada maka
            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
                'date' => 'required',
                'description' => 'required',
    
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->all()], 200);
            }
    
            DB::table('daily_reports')->where('daily_report_id', $id)->update([
                'user_id' => $request->user_id,
                // 'work_place_id' => $request->work_place_id,
                // 'value' => $request->value,
                // 'name' => $request->name,
                'date' => $request->date,
                'description' => $request->description,
                'is_active' => 1,
                'createdby' => $request->user_id,
                'created' => date('Y-m-d h:m:s'),
                // 'updatedby' => $request->updatedby,
                'updated' => date('Y-m-d h:m:s'),
                'is_approve' => 1,
            ]);
    
            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil update'
            ], Response::HTTP_OK);
        }
    }

    public function user($user_id)
    {
        $data = DB::table('users')->where('user_id', $user_id)->first();
        if (empty($data)) {
            # jika data tidak ada maka
            return response()->json([
                'error' => true,
                'message' => 'Data Tidak tersedia',
            ], Response::HTTP_UNAUTHORIZED);
        } else {
            # jika data ada maka 
            return response()->json([
                'success' => true,
                'data' => $data
            ], Response::HTTP_OK);
        }
    }

    public function user_update(Request $request, $user_id)
    {
        $data = DB::table('users')->where('user_id', $user_id)->first();
        if (empty($data)) {
            # jika data tidak ada maka
            return response()->json([
                'error' => true,
                'message' => 'Data Tidak tersedia',
            ], Response::HTTP_UNAUTHORIZED);
        } else {
            # jika data ada maka 
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'gender' => 'required',
                'email' => 'required',
                'telp' => 'required|min:10|numeric'
    
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->all()], 200);
            }

            DB::table('users')->where('user_id', $user_id)->update([
               'gender_id' => $request->gender_id,
               'name' => $request->name,
               'email' => $request->email,
               'telp' => $request->telp,
               
            ]);
            return response()->json([
                'success' => true,
                'data' => 'Data Berhasil di update'
            ], Response::HTTP_OK);
        }
    }
}
