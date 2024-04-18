import React, { useEffect, useState } from 'react';
import axiosClient from '../axios-client';
import { Link } from 'react-router-dom';
import { useStateContext } from '../../contexts/ContextProvider';

const Workshops = () => {
  const [workshops, setWorkshops] = useState([]);
  const [loading, setLoading] = useState(false);
  const { setNotification } = useStateContext();
  const [linkNext, setLinkNext] = useState(null);
  const [linkPrev, setLinkPrev] = useState(null);

  useEffect(() => {
    getWorkshops();
  }, []);
  const onDelete = workshop => {
    if (window.confirm('¿Estás seguro  que desea eliminar este taller?')) {
      setLoading(true);
      axiosClient
        .delete(`/workshops/${workshop.id}`)
        .then(() => {
          setNotification('Taller eliminado correctamente');
          getWorkshops();
        })
        .catch(() => {
          setLoading(false);
        });
    }
  };

  const getWorkshops = link => {
    setLoading(true);
    if (link) {
      axiosClient
        .get(link)
        .then(({ data }) => {
          setLoading(false);
          setWorkshops(data.data);
          setLinkNext(data.links.next);
          setLinkPrev(data.links.prev);
        })
        .catch(() => {
          setLoading(false);
        });
      return;
    }
    axiosClient
      .get('/workshops')
      .then(({ data }) => {
        setLoading(false);
        setWorkshops(data.data);
        setLinkNext(data.links.next);
        setLinkPrev(data.links.prev);
      })
      .catch(() => {
        setLoading(false);
      });
  };
  return (
    <div>
      <div
        style={{
          display: 'flex',
          justifyContent: 'space-between',
          alignItems: 'center',
        }}
      >
        <h1>Talleres</h1>
        <Link to={'/workshops/new'} className="btn-add">
          Crear nuevo taller
        </Link>
      </div>
      <div className="card animated fadeInDown">
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Ubicación ID</th>
              <th>Nombre</th>
              <th>Descripción</th>
              <th>Día de Semana</th>
              <th>Hora de Inicio</th>
              <th>Hora de Fin</th>
              <th>Cupo máximo</th>
              <th>Acciones</th>
            </tr>
          </thead>
          {loading && (
            <tbody>
              <tr>
                <td colSpan="9" className="text-center">
                  Cargando...
                </td>
              </tr>
            </tbody>
          )}
          {!loading && workshops.length === 0 && (
            <tbody>
              <tr>
                <td colSpan="5" className="text-center">
                  No hay talleres
                </td>
              </tr>
            </tbody>
          )}
          {!loading && (
            <tbody>
              {workshops.map(workshop => (
                <tr key={workshop.id}>
                  <td>{workshop.id}</td>
                  <td>{workshop.ubicacion_id}</td>
                  <td>{workshop.nombre}</td>
                  <td>{workshop.descripcion}</td>
                  <td>{workshop.dia_semana}</td>
                  <td>{workshop.hora_inicio}</td>
                  <td>{workshop.hora_fin}</td>
                  <td>{workshop.cupo_maximo}</td>
                  <td>
                    <Link className="btn-edit" to={`/workshops/${workshop.id}`}>
                      Editar
                    </Link>
                    &nbsp;
                    <button
                      onClick={e => onDelete(workshop)}
                      className="btn-delete"
                    >
                      Eliminar
                    </button>
                  </td>
                </tr>
              ))}
            </tbody>
          )}
        </table>
      </div>
      <div>
        {linkPrev && (
          <button onClick={() => getWorkshops(linkPrev)} className="btn">
            Anterior
          </button>
        )}
        &nbsp;
        {linkNext && (
          <button onClick={() => getWorkshops(linkNext)} className="btn">
            Siguiente
          </button>
        )}
      </div>
    </div>
  );
};

export default Workshops;
