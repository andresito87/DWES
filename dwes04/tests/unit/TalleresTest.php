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
            ->willReturn($this->stmt);
        $this->stmt->expects($this->once())
            ->method('execute')
            ->willReturn(true);
        $this->stmt->expects($this->once())
            ->method('fetchAll')
            ->willReturn(['taller1', 'taller2']);
        $this->assertEquals(['taller1', 'taller2'], Talleres::listar($this->con));
    }

    #[Test]
    #[TestDox('Comprobar que se devuelve false si no se pudo ejecutar la consulta.')]
    public function listarTalleresError(): void
    {
        $this->con->expects($this->once())
            ->method('prepare')
            ->willReturn($this->stmt);
        $this->stmt->expects($this->once())
            ->method('execute')
            ->willReturn(false);
        $this->assertEquals(false, Talleres::listar($this->con));
    }

    #[Test]
    #[TestDox('Comprobar que se devuelve false si se produce una excepción en la operación.')]
    public function listarTalleresExcepcion(): void
    {
        $this->con->expects($this->once())
            ->method('prepare')
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
            ->willReturn($this->stmt);
        $this->stmt->expects($this->once())
            ->method('bindParam')
            ->with(':dia', 'lunes');
        $this->stmt->expects($this->once())
            ->method('execute')
            ->willReturn(true);
        $this->stmt->expects($this->once())
            ->method('fetchAll')
            ->willReturn(['taller1', 'taller2']);
        $this->assertEquals(['taller1', 'taller2'], Talleres::filtrarPorDia($this->con, 'lunes'));
    }

    #[Test]
    #[TestDox('Comprobar que se devuelve false si no se pudo ejecutar la consulta al filtrar por día de la semana incorrecto.')]
    public function filtrarTalleresPorDiaError(): void
    {
        $this->con->expects($this->once())
            ->method('prepare')
            ->willReturn($this->stmt);
        $this->stmt->expects($this->once())
            ->method('bindParam')
            ->with(':dia', 'error');
        $this->assertEquals(false, Talleres::filtrarPorDia($this->con, 'error'));
    }

    #[Test]
    #[TestDox('Comprobar que se devuelve false si se produce una excepción en la operación al filtrar por día de la semana.')]
    public function filtrarTalleresPorDiaExcepcion(): void
    {
        $this->con->expects($this->once())
            ->method('prepare')
            ->willReturn($this->stmt);
        $this->stmt->expects($this->once())
            ->method('execute')
            ->will($this->throwException(new PDOException()));
        $this->assertEquals(false, Talleres::filtrarPorDia($this->con, 'Saltará excepción'));
    }

    #[Test]
    #[TestDox('Comprobar que se filtran correctamente los talleres por un día de la semana que no tiene registros en la BD y devuelve un array vacío.')]
    public function filtrarTalleresPorDiaNoExistente(): void
    {
        $this->con->expects($this->once())
            ->method('prepare')
            ->willReturn($this->stmt);
        $this->stmt->expects($this->once())
            ->method('bindParam')
            ->with(':dia', 'domingo');
        $this->stmt->expects($this->once())
            ->method('execute')
            ->willReturn(true);
        $this->assertEquals([], Talleres::filtrarPorDia($this->con, 'domingo'));
    }

}