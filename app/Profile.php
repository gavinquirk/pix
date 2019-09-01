<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
  protected $guarded = [];

  public function user() {
    return $this->belongsTo(User::class);
  }

  public function profileImage() {
    // $imagePath = ($this->image) ? $this->image : "profile/vPZXRpSXYyjnGJh0regnAwW6KGS9PVoNPvcqhhRd.png";

    $imagePath = ($this->image) ? $this->image : "profile/eCkItkASHarIbp83eotJzpGeiDszTtUkjHSBY3si.png";
    return '/storage/' . $imagePath;
  }
}
