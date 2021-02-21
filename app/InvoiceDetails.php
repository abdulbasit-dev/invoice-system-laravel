<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
  protected $guarded = [];

  public function unitText()
  {
    if ($this->unit == 'piece') {
      $text = __("Frontend/frontend.piece");
    } elseif ($this->unit == 'g') {
      $text = __("Frontend/frontend.gram");
    } elseif ($this->unit == 'kg') {
      $text = __("Frontend/frontend.kilo_gram");
    }

    return $text;
  }
}
