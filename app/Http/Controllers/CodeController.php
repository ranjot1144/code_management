<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CodeController;
use App\Models\Code;

class CodeController extends Controller
{
  public function generateUniqueCode()
  {
      $randomCode = Code::generateUniqueCode();

        $allocatedCode = new Code();
        $allocatedCode->code = $randomCode;
        $allocatedCode->allocated = false;
        $allocatedCode->save();

      return response()->json(['Unique Code Generated successfully' => $randomCode]);
  }
  public function allocateCode()
  {
      $unallocatedCodes = Code::where('allocated', false)->get();
      if ($unallocatedCodes->isEmpty()) {
          return response()->json(['message' => 'No unallocated codes available'], 404);
      }
      $randomCode = $unallocatedCodes->random();
      $randomCode->allocated = true;
      $randomCode->save();

      return response()->json(['message' => 'Code allocated successfully', 'code' => $randomCode->code]);
  }
}
