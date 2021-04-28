<?php

    namespace Tests\Feature;

    use App\Actions\CEP\SearchCep;
    use Tests\TestCase;

    class CepTest extends TestCase
    {
        /** @test */
        public function valid_zip_code()
        {
            $zipcode = '76820050';
            $cep   = $this->dispatch(new SearchCep($zipcode));

            $this->assertEquals('RO', $cep->uf);
        }

        /** @test */
        public function invalid_zip_code()
        {
            $zipcode = '13116441';
            $cep   = $this->dispatch(new SearchCep($zipcode));

            $this->assertNull($cep, 'variable is null or not');
        }
    }
