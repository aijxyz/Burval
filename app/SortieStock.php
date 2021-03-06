<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SortieStock extends Model
{
    //
     //
     use Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'id','dateSortie','dateSaisie','QSortant','observ','centre','motif','produit_id','paysAt'
               
    ];


   


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ 
         'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     * 
     * @var array
     */
    protected $casts = [
        'name_at' => 'datetime',
    ];

    

 
       public function produit()
    {

        return $this->belongsTo('App\Produit');
    }
  
}
 