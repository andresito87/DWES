<?php
namespace DWES04\models;

use \PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\Test;
use PDO;
use PDOStatement;
use PDOException;

final class TalleresTest extends TestCase
{
    // Guarda la conexión a la base de datos.
    private $con;

    // Guarda la sentencia preparada.
    private $stmt;

    // Se ejecuta antes de cada test.
    protected function setUp(): void
    {
        $this->con = $this->createMock(PDO::class);
        $this->stmt = $this->createMock(PDOStatement::class);
    }

    // Se ejecuta después de cada test.
    protected function tearDown(): void
    {
        $this->con = null;
        $this->stmt = null;
    }

    #[Test]
    #[TestDox('Comprobar que se listan correctamente los talleres almacenados en la base de datos.')]
    public function listarTalleres(): void
    {
        $this->con->expects($this->once())
            ->method('prepare')
            ->with('SELECT id, nombre, descripcion, ubicacion, dia_semana, hora_inicio, hora_fin, cupo_maximo FROM talleres')
            ->willReturn($this->stmt);
        $this->stmt->expects($this->once())
            ->method('execute')
            ->willReturn(true);
        $this->stmt->expects($this->once())
            ->method('fetchAll')
            ->with(PDO::FETCH_CLASS, Taller::class)
            ->willReturn(['taller1', 'taller2']);
        $this->assertEquals(['taller1', 'taller2'], Talleres::listar($this->con));
    }

    #[Test]
    #[TestDox('Comprobar que se devuelve -1 si no se pudo ejecutar la consulta.')]
    public function listarTalleresError(): void
    {
        $this->con->expects($this->once())
            ->method('prepare')
            ->with('SELECT id, nombre, descripcion, ubicacion, dia_semana, hora_inicio, hora_fin, cupo_maximo FROM talleres')
            ->willReturn($this->stmt);
        $this->stmt->expects($this->once())
            ->method('execute')
            ->willReturn(false);
        $this->assertEquals(-1, Talleres::listar($this->con));
    }

    #[Test]
    #[TestDox('Comprobar que se devuelve false si se produce una excepción en la operación.')]
    public function listarTalleresExcepcion(): void
    {
        $this->con->expects($this->once())
            ->method('prepare')
            ->with('SELECT id, nombre, descripcion, ubicacion, dia_semana, hora_inicio, hora_fin, cupo_maximo FROM talleres')
            ->willReturn($this->stmt);
        $this->stmt->expects($this->once())
            ->method('execute')
            ->will($this->throwException(new PDOException()));
        $this->assertEquals(false, Talleres::listar($this->con));
    }

    #[Test]
    #[TestDox('Comprobar que se filtran correctamente los talleres almacenados en la base de datos por día de la semana(lunes).')]
    public function filtrarTalleresPorDia(): void
    {
        $this->con->expects($this->once())
            ->method('prepare')
            ->with('SELECT * FROM talleres WHERE dia_semana=:dia')
            ->willReturn($this->stmt);
        $this->stmt->expects($this->once())
            ->method('bindParam')
            ->with(':dia', 'lunes');
        $this->stmt->expects($this->once())
            ->method('execute')
            ->willReturn(true);
        $this->stmt->expects($this->once())
            ->method('fetchAll')
            ->with(PDO::FETCH_CLASS, Taller::class)
            ->willReturn(['taller1', 'taller2']);
        $this->assertEquals(['taller1', 'taller2'], Talleres::filtrarPorDia($this->con, 'lunes'));
    }

    #[Test]
    #[TestDox('Comprobar que se devuelve -1 si no se pudo ejecutar la consulta al filtrar por día de la semana.')]
    public function filtrarTalleresPorDiaError(): void
    {
        $this->con->expects($this->once())
            ->method('prepare')
            ->with('SELECT * FROM talleres WHERE dia_semana=:dia')
            ->willReturn($this->stmt);
        $this->stmt->expects($this->once())
            ->method('bindParam')
            ->with(':dia', 'lunes');
        $this->stmt->expects($this->once())
            ->method('execute')
            ->willReturn(false);
        $this->assertEquals(-1, Talleres::filtrarPorDia($this->con, 'lunes'));
    }

    #[Test]
    #[TestDox('Comprobar que se devuelve false si se produce una excepción en la operación al filtrar por día de la semana.')]
    public function filtrarTalleresPorDiaExcepcion(): void
    {
        $this->con->expects($this->once())
            ->method('prepare')
            ->with('SELECT * FROM talleres WHERE dia_semana=:dia')
            ->willReturn($this->stmt);
        $this->stmt->expects($this->once())
            ->method('bindParam')
            ->with(':dia', 'lunes');
        $this->stmt->expects($this->once())
            ->method('execute')
            ->will($this->throwException(new PDOException()));
        $this->assertEquals(false, Talleres::filtrarPorDia($this->con, 'lunes'));
    }

    #[Test]
    #[TestDox('Comprobar que se filtran correctamente los talleres por un día de la semana que no existe y devuelve un array vacío.')]
    public function filtrarTalleresPorDiaNoExistente(): void
    {
        $this->con->expects($this->once())
            ->method('prepare')
            ->with('SELECT * FROM talleres WHERE dia_semana=:dia')
            ->willReturn($this->stmt);
        $this->stmt->expects($this->once())
            ->method('bindParam')
            ->with(':dia', 'domingo');
        $this->stmt->expects($this->once())
            ->method('execute')
            ->willReturn(true);
        $this->stmt->expects($this->once())
            ->method('fetchAll')
            ->with(PDO::FETCH_CLASS, Taller::class)
            ->willReturn([]);
        $this->assertEquals([], Talleres::filtrarPorDia($this->con, 'domingo'));
    }

}