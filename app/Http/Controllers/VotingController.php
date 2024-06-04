<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use Illuminate\Support\Facades\DB;

class VotingController extends Controller
{
    
    // GET: mostrar todos los candidatos
    public function showVotes() {
        $candidatos = Candidate::all();
        return response()->json($candidatos);
    }

    // POST: incrementar los votos de un candidato
    public function vote(Request $request) {
        // Determinar ID
        $id = $request->json()->get('candidate_id');

        // Verificar si ID existe
        $verificar = Candidate::where('id', $id)->first();
        if(!$verificar) {
            return response()->json(['message'=>'No existe ningun candidato con ese ID'], 404);
        }

        // Transacción
        DB::beginTransaction();
        try {
            // Determinar el candidato con ese id e incrementar 1 voto
            $candidate = Candidate::findOrFail($id);
            $candidate->increment('votes', 1);
            
            DB::commit();

            // Mostrar json de resultado
            $votos = Candidate::query()->where('id','=',$id)->first()->votes;
            return response()->json(['success'=>'true', 'votes'=>$votos]);
        } catch (\Exception $e) {
            rollback();
            return response()->json(['success'=>'false', 'error'=>$e->getMessage()], 500);
        }
    }

}
