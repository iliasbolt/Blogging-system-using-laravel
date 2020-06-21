<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Post extends Model
{
    //niiiiice Lmodel li creeina fih t9riban kolxi so hado ila bghity tdirom wa sf
    //wa table name par default kayji howa ism dia model 


		//-- hna ila bghtty tmodifier xi champs f database
    //modifier ismo
    protected $table ='posts';
    //primary key
    public $primaryKey='id';

    public $timestamps = true;

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    public function comments(){
        return $this->hasMany('App\Comment');
    }
    
}
