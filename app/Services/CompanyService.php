<?php

namespace App\Services;

use App\Services\Traits\ConsumeExternalService;
use Illuminate\Support\Facades\Http;

class CompanyService
{
  use ConsumeExternalService;

  protected $token;
  protected $url;

  public function __construct()
  {
    $this->token = config('services.micro_01.token');
    $this->url = config('services.micro_01.url');
  }

  public function getCompany(string $company)
  {
    return $this->request('get', "/companies/{$company}");
  }
}