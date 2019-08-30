<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class EntreSecuripack extends Model
{
    //


     use Notifiable;
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'debutSerie','finSerie','dateEntre','prixUnitaire','prixTotal','reference','fournisseur_id','paysAt'
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

    

   
     public function sortieSecuripack()
    {
        return $this->hasMany('App\SortieSecuripack');
        
    }




       public function fournisseur()
    {
        return $this->belongsTo('App\Fournisseur');
    }

}
