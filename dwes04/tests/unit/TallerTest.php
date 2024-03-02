<?php declare(strict_types=1);
namespace DWES04\models;

use \PHPUnit\Framework\TestCase;
use DateTime;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\Test;
use PDO;
use PDOStatement;

final class TallerTest extends TestCase
{
    #[Test]
    #[TestDox('Comprobar que el id es nulo al crear un nuevo taller que no ha sido guardado en la base de datos')]
    public function getIdTallerNoGuardado(): void
    {
        $taller = new Taller();
        $this->assertNull($taller->getId());
    }

    #[Test]
    #[TestDox('Comprobar que el id se establece correctamente cuando el taller ha sido guardado en la base de datos')]
    public function getIdTallerGuardado(): void
    {
        // Creamos el mock de la conexión a la base de datos
        $conexionMock = $this->createMock(PDO::class);

        // Simulamos la preparación y ejecución de una consulta que inserta un taller en la base de datos
        $statementMock = $this->createMock(PDOStatement::class);
        $conexionMock->method('prepare')->willReturn($statementMock);
        $statementMock->method('execute')->willReturn(true);

        // Configuramos el mock para que lastInsertId() devuelva un string simulado de ID
        $conexionMock->method('lastInsertId')->willReturn('1'); // Simulamos que se insertó el ID 1

        // Creamos una instancia de Taller, pasando el mock como conexión a la base de datos
        $taller = new Taller();

        // Insertamos un taller en la base de datos
        $taller->setNombre('Taller de prueba');
        $taller->setDescripcion('Descripción de prueba');
        $taller->setUbicacion('Ubicación de prueba');
        $taller->setDiaSemana('Lunes');
        $taller->setHoraInicio(new DateTime('10:00'));
        $taller->setHoraFin(new DateTime('12:00'));
        $taller->setCupoMaximo(10);
        $taller->guardar($conexionMock);

        // Recuperamos el ID del objeto Taller
        $idObjeto = $taller->getId();

        // Verificamos que el ID del objeto Taller sea igual al ID recuperado de la base de datos
        $this->assertEquals(1, $idObjeto);
    }

    #[Test]
    #[TestDox('Comprobar que el nombre se obtiene correctamente')]
    public function getNombre(): void
    {
        $taller = new Taller();
        $taller->setNombre('Taller de prueba');
        $this->assertEquals('Taller de prueba', $taller->getNombre());
    }

    #[Test]
    #[TestDox('Comprobar que el nombre se establece correctamente')]
    public function setNombre(): void
    {
        $taller = new Taller();
        $this->assertTrue($taller->setNombre('Taller de prueba'));
    }

    #[Test]
    #[TestDox('Comprobar que el nombre no se establece cuando es una cadena vacía')]
    public function setNombre_cadenaVacia(): void
    {
        $taller = new Taller();
        $this->assertFalse($taller->setNombre(''));
    }

    #[Test]
    #[TestDox('Comprobar que la descripción se obtiene correctamente')]
    public function getDescripcion(): void
    {
        $taller = new Taller();
        $taller->setDescripcion('Descripción de prueba');
        $this->assertEquals('Descripción de prueba', $taller->getDescripcion());
    }

    #[Test]
    #[TestDox('Comprobar que la descripción se establece correctamente')]
    public function setDescripcion(): void
    {
        $taller = new Taller();
        $this->assertTrue($taller->setDescripcion('Descripción de prueba'));
    }

    #[Test]
    #[TestDox('Comprobar que la descripción no se establece cuando es una cadena vacía')]
    public function setDescripcion_cadenaVacia(): void
    {
        $taller = new Taller();
        $this->assertFalse($taller->setDescripcion(''));
    }

    #[Test]
    #[TestDox('Comprobar que la ubicación se obtiene correctamente')]
    public function getUbicacion(): void
    {
        $taller = new Taller();
        $taller->setUbicacion('Ubicación de prueba');
        $this->assertEquals('Ubicación de prueba', $taller->getUbicacion());
    }

    #[Test]
    #[TestDox('Comprobar que la ubicación se establece correctamente')]
    public function setUbicacion(): void
    {
        $taller = new Taller();
        $this->assertTrue($taller->setUbicacion('Ubicación de prueba'));
    }

    #[Test]
    #[TestDox('Comprobar que la ubicación no se establece cuando es una cadena vacía')]
    public function setUbicacion_cadenaVacia(): void
    {
        $taller = new Taller();
        $this->assertFalse($taller->setUbicacion(''));
    }

    #[Test]
    #[TestDox('Comprobar que el día de la semana se obtiene correctamente')]
    public function getDiaSemana(): void
    {
        $taller = new Taller();
        $taller->setDiaSemana('Lunes');
        $this->assertEquals('Lunes', $taller->getDiaSemana());
    }

    #[Test]
    #[TestDox('Comprobar que el día de la semana se establece correctamente cuando es un día válido')]
    public function setDiaSemana_valido(): void
    {
        $taller = new Taller();
        $this->assertTrue($taller->setDiaSemana('Lunes'));
    }

    #[Test]
    #[TestDox('Comprobar que el día de la semana no se establece cuando es un día no válido (Domingo)')]
    public function setDiaSemana_invalido(): void
    {
        $taller = new Taller();
        $this->assertFalse($taller->setDiaSemana('Domingo'));
    }

    #[Test]
    #[TestDox('Comprobar que la hora de inicio se obtiene correctamente')]
    public function getHoraInicio(): void
    {
        $taller = new Taller();
        $taller->setHoraInicio(new DateTime('10:00'));
        $this->assertEquals(new DateTime('10:00'), $taller->getHoraInicio());
    }

    #[Test]
    #[TestDox('Comprobar que la hora de inicio se establece correctamente')]
    public function setHoraInicio(): void
    {
        $taller = new Taller();
        $this->assertTrue($taller->setHoraInicio(new DateTime('10:00')));
    }

    #[Test]
    #[TestDox('Comprobar que la hora de inicio no se establece cuando es mayor que la hora de fin')]
    public function setHoraInicio_mayorQueHoraFin(): void
    {
        $taller = new Taller();
        $taller->setHoraFin(new DateTime('12:00'));
        $this->assertFalse($taller->setHoraInicio(new DateTime('13:00')));
    }

    #[Test]
    #[TestDox('Comprobar que la hora de fin se obtiene correctamente')]
    public function getHoraFin(): void
    {
        $taller = new Taller();
        $taller->setHoraFin(new DateTime('12:00'));
        $this->assertEquals(new DateTime('12:00'), $taller->getHoraFin());
    }

    #[Test]
    #[TestDox('Comprobar que la hora de fin se establece correctamente')]
    public function setHoraFin(): void
    {
        $taller = new Taller();
        $this->assertTrue($taller->setHoraFin(new DateTime('12:00')));
    }

    #[Test]
    #[TestDox('Comprobar que la hora de fin no se establece cuando es menor que la hora de inicio')]
    public function setHoraFin_menorQueHoraInicio(): void
    {
        $taller = new Taller();
        $taller->setHoraInicio(new DateTime('10:00'));
        $this->assertFalse($taller->setHoraFin(new DateTime('09:00')));
    }

    #[Test]
    #[TestDox('Comprobar que el cupo máximo se obtiene correctamente')]
    public function getCupoMaximo(): void
    {
        $taller = new Taller();
        $taller->setCupoMaximo(10);
        $this->assertEquals(10, $taller->getCupoMaximo());
    }

    #[Test]
    #[TestDox('Comprobar que el cupo máximo se establece correctamente')]
    public function setCupoMaximo(): void
    {
        $taller = new Taller();
        $this->assertTrue($taller->setCupoMaximo(10));
    }

    #[Test]
    #[TestDox('Comprobar que el cupo máximo no se establece cuando es menor que 5')]
    public function setCupoMaximo_menorQue5(): void
    {
        $taller = new Taller();
        $this->assertFalse($taller->setCupoMaximo(4));
    }

    #[Test]
    #[TestDox('Comprobar que el cupo máximo no se establece cuando es mayor que 30')]
    public function setCupoMaximo_mayorQue30(): void
    {
        $taller = new Taller();
        $this->assertFalse($taller->setCupoMaximo(31));
    }

    #[Test]
    #[TestDox('Comprobar que cuando se guarda un taller en la base de datos se recibe la cantidad de registros afectados')]
    public function guardar(): void
    {
        // Creamos el mock de la conexión a la base de datos
        $conexionMock = $this->createMock(PDO::class);

        // Simulamos la preparación y ejecución de una consulta que inserta un taller en la base de datos
        $statementMock = $this->createMock(PDOStatement::class);
        $conexionMock->method('prepare')->willReturn($statementMock);
        $statementMock->method('execute')->willReturn(true);
        $statementMock->method('rowCount')->willReturn(1); // Simulamos que se afectó 1 registro

        // Creamos una instancia de Taller, pasando el mock como conexión a la base de datos
        $taller = new Taller();

        // Insertamos un taller en la base de datos
        $taller->setNombre('Taller de prueba');
        $taller->setDescripcion('Descripción de prueba');
        $taller->setUbicacion('Ubicación de prueba');
        $taller->setDiaSemana('Lunes');
        $taller->setHoraInicio(new DateTime('10:00'));
        $taller->setHoraFin(new DateTime('12:00'));
        $taller->setCupoMaximo(10);
        $registrosAfectados = $taller->guardar($conexionMock);

        // Verificamos que la cantidad de registros afectados sea 1
        $this->assertEquals(1, $registrosAfectados);
    }

    #[Test]
    #[TestDox('Comprobar que el método rescatar() devuelve un objeto Taller con los datos de un registro de la base de datos')]
    public function rescatar(): void
    {
        // Creamos el mock de la conexión a la base de datos
        $conexionMock = $this->createMock(PDO::class);

        // Simulamos la preparación y ejecución de una consulta que recupera un taller de la base de datos
        $statementMock = $this->createMock(PDOStatement::class);
        $conexionMock->method('prepare')->willReturn($statementMock);
        $statementMock->method('execute')->willReturn(true);
        $statementMock->method('fetch')->willReturn((array) [
            'id' => 1,
            'nombre' => 'Taller',
            'descripcion' => 'Descripción',
            'ubicacion' => 'Ubicación',
            'dia_semana' => 'Lunes',
            'hora_inicio' => '10:00',
            'hora_fin' => '12:00',
            'cupo_maximo' => 10
        ]);

        // Rescatamos un taller de la base de datos
        $taller = Taller::rescatar($conexionMock, 1);

        // Verificamos que el objeto Taller devuelto tenga los datos esperados
        $this->assertEquals(1, $taller->getId());
        $this->assertEquals('Taller', $taller->getNombre());
        $this->assertEquals('Descripción', $taller->getDescripcion());
        $this->assertEquals('Ubicación', $taller->getUbicacion());
        $this->assertEquals('Lunes', $taller->getDiaSemana());
        $this->assertEquals(new DateTime('10:00'), $taller->getHoraInicio());
        $this->assertEquals(new DateTime('12:00'), $taller->getHoraFin());
        $this->assertEquals(10, $taller->getCupoMaximo());
    }

    #[Test]
    #[TestDox('Comprobar que el método borrar() devuelve la cantidad de registros afectados al eliminar un taller de la base de datos')]
    public function borrar(): void
    {
        // Creamos el mock de la conexión a la base de datos
        $conexionMock = $this->createMock(PDO::class);

        // Simulamos la preparación y ejecución de una consulta que elimina un taller de la base de datos
        $statementMock = $this->createMock(PDOStatement::class);
        $conexionMock->method('prepare')->willReturn($statementMock);
        $statementMock->method('execute')->willReturn(true);
        $statementMock->method('rowCount')->willReturn(1); // Simulamos que se afectó 1 registro

        // Borramos un taller de la base de datos
        $registrosAfectados = Taller::borrar($conexionMock, 1);

        // Verificamos que la cantidad de registros afectados sea 1
        $this->assertEquals(1, $registrosAfectados);
    }

    #[Test]
    #[TestDox('Comprobar que el método actualizar() devuelve la cantidad de registros afectados al modificar un taller en la base de datos')]
    public function actualizar(): void
    {
        // Creamos el mock de la conexión a la base de datos
        $conexionMock = $this->createMock(PDO::class);

        // Simulamos la preparación y ejecución de una consulta que modifica un taller en la base de datos
        $statementMock = $this->createMock(PDOStatement::class);
        $conexionMock->method('prepare')->willReturn($statementMock);
        $statementMock->method('execute')->willReturn(true);
        $statementMock->method('rowCount')->willReturn(1); // Simulamos que se afectó 1 registro

        // Creamos una instancia de Taller
        $taller = new Taller();

        // Le asignamos valor a sus propiedades
        $taller->setNombre('Taller de prueba');
        $taller->setDescripcion('Descripción de prueba');
        $taller->setUbicacion('Ubicación de prueba');
        $taller->setDiaSemana('Lunes');
        $taller->setHoraInicio(new DateTime('10:00'));
        $taller->setHoraFin(new DateTime('12:00'));
        $taller->setCupoMaximo(10);

        // Modificamos un taller en la base de datos
        $registrosAfectados = Taller::actualizar($conexionMock, 1, $taller);

        // Verificamos que la cantidad de registros afectados sea 1
        $this->assertEquals(1, $registrosAfectados);
    }
}