<?php
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegistroTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
    }

    public function testStore()
    {
        // Arreglo con los datos de prueba
        $data = [
            'nombre' => 'Juan',
            'apellidos' => 'Pérez',
            'email' => 'juan.perez@iahorro.com',
            'telefono' => '123456789',
            'ingresos_netos' => 1000,
            'cantidad_solicitada' => 500,
            'fecha_registro' => '2023-05-03',
            'franja_comunicacion' => 1,
        ];

        // Realiza una solicitud POST a la ruta de agregar registros
        $response = $this->post('/api/agregar-registro', $data);

        // Verifica la respuesta
        $response->assertStatus(200);

        // Verifica que el mensaje de la respuesta es correcto
        $response->assertJson([
            'message' => 'Registro creado correctamente'
        ]);
    }


}
