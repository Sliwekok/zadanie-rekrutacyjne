<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // table
    protected $table = "post";

    // required fields
    protected $guarded = ["title", "content", "author"];

}
