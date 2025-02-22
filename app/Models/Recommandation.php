<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommandation extends Model
{
    use HasFactory;


    protected $fillable=[
         'title',
          'description',
          'content',
          'image_url',
          'variable_ass'];
}
