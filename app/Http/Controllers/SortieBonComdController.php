<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\EntreBonComd;
use App\SortieBonComd;
use DB;
use Auth;


class SortieBonComdController extends Controller
{
    //

     public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

        
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  public function store(Request $request)
    {
    
        $validator = Validator::make($request->all(), [
            'debutSerie' => ['required', 'Integer'],
            'finSerie' => ['required', 'Integer'],
            'dateSortie' => ['required', 'date'],
            'centre'=> ['required', 'string', 'max:255'], 
            'prix'=> ['required', 'Integer'],
            'prixTotal' =>['required', 'Integer'],           
         ]);

            if ($validator->fails()) {

        Alert::toast('Erreur!  Veuillez verifier le champ de saisie prix total', 'error');
          return redirect()->route('sortieBonComdList');       


            }
              else{

          SortieBonComd::create($request->all());
        //s$this->guard()->login($user);
         Alert::success('Ajouter', 'Avec success');   
        return redirect()->route('sortieBonComdList');
    }
    
    }
       
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
      
      if(Auth::user()->paysAt == 'Internationnal')
        {
      $sortieBonComds = SortieBonComd::all(); 
     //$entreBord = Fournisseur::find(1)->fournisseur;
      $entreBon= EntreBonComd::all();  
      $som = DB::table('sortie_bon_comds')->get()->sum('prixTotal');
      return view('vueSortieBonComd' ,compact('sortieBonComds','entreBon','som'));
          }

    else{

          $sortieBonComds = SortieBonComd::all()->where('paysAt',Auth::user()->paysAt );                        
                             

            $som = DB::table('sortie_bon_comds')
                   ->where('paysAt',Auth::user()->paysAt )
                   ->get()->sum('prixTotal');

             $entreBon= DB::table('entre_bon_comds')
                         ->where('paysAt',Auth::user()->paysAt )
                         ->get();

          return view('vueSortieBonComd' ,compact('sortieBonComds','entreBon','som'));

        }

      
        
    }



    



     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
            $validator = Validator::make($request->all(), [
            'debutSerie' => ['required', 'Integer'],
            'finSerie' => ['required', 'Integer'],
            'dateSortie' => ['required', 'date'],
            'centre'=> ['required', 'string', 'max:255'], 
            'prix'=> ['required', 'Integer'],
            'prixTotal' =>['required', 'Integer'],           
         ]);


        if ($validator->fails()) {
            //return back()->withErrors($validator)->withInput();
             Alert::toast('Erreur!  Veuillez verifier le champ de saisie prix total', 'error');

             return redirect()->route('sortieBonComdList');
          
        }

         else{

              SortieBonComd::findOrfail($request->sortieBonComd_id)->update($request->all());
              Alert::success('Modifier', 'Avec success');     
              return redirect()->route('sortieBonComdList');

        }
  
      
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // $fournisseurs=DB::table('fournisseurs')->where('id',$request->fournisseurs_id)->delete();
       SortieBonComd::findOrfail($request->sortieBonComd_id)->delete();  
       Alert::success('Supprimer', 'Avec success');
        return redirect()->route('sortieBonComdList'); 

    }


}
 