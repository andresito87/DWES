import React, { useEffect, useState } from 'react';
import axiosClient from '../axios-client';
import { Link } from 'react-router-dom';
import { useStateContext } from '../../contexts/ContextProvider';

const Ubications = () => {
  const [ubications, setUbications] = useState([]);
  const [loading, setLoading] = useState(false);
  const { setNotification } = useStateContext();
  const [linkNext, setLinkNext] = useState(null);
  const [linkPrev, setLinkPrev] = useState(null);

  useEffect(() => {
    getUbications();
  }, []);
  const onDelete = ubication => {
    if (window.confirm('¿Estás seguro  que desea eliminar esta ubicación?')) {
      setLoading(true);
      axiosClient
        .delete(`/ubications/${ubication.id}`)
        .then(() => {
          setNotification('Ubicación eliminada correctamente');
          getUbications();
        })
        .catch(() => {
          setLoading(false);
        });
    }
  };

  const getUbications = link => {
    setLoading(true);
    if (link) {
      axiosClient
        .get(link)
        .then(({ data }) => {
          setLoading(false);
          setUbications(data.data);
          console.log(data.data);
          setLinkNext(data.links.next);
          setLinkPrev(data.links.prev);
        })
        .catch(() => {
          setLoading(false);
        });
      return;
    }
    axiosClient
      .get('/ubications')
      .then(({ data }) => {
        setLoading(false);
        setUbications(data.data);
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
        <h1>Ubicaciones</h1>
        <Link to={'/ubications/new'} className="btn-add">
          Crear nueva ubicación
        </Link>
      </div>
      <div className="card animated fadeInDown">
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Descripción</th>
              <th>Días</th>
              <th>Talleres</th>
              <th>Acciones</th>
            </tr>
          </thead>
          {loading && (
            <tbody>
              <tr>
                <td colSpan="5" className="text-center">
                  Cargando...
                </td>
              </tr>
            </tbody>
          )}
          {!loading && ubications.length === 0 && (
            <tbody>
              <tr>
                <td colSpan="5" className="text-center">
                  No hay ubicaciones
                </td>
              </tr>
            </tbody>
          )}
          {!loading && (
            <tbody>
              {ubications.map(ubication => (
                <tr key={ubication.id}>
                  <td>{ubication.id}</td>
                  <td>{ubication.nombre}</td>
                  <td>{ubication.descripcion}</td>
                  <td>{ubication.dias}</td>
                  <td>
                    {Array.isArray(ubication.talleres)
                      ? ubication.talleres.map((taller, index) => (
                          <span
                            style={{ color: 'blue', fontWeight: 'bold' }}
                            key={index}
                          >
                            {taller.nombre}
                            {index < ubication.talleres.length - 1 && <br />}
                          </span>
                        ))
                      : ubication.talleres}
                  </td>
                  <td>
                    <Link
                      className="btn-edit"
                      to={`/ubications/${ubication.id}`}
                    >
                      Editar
                    </Link>
                    &nbsp;
                    <button
                      onClick={e => onDelete(ubication)}
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
          <button onClick={() => getUbications(linkPrev)} className="btn">
            Anterior
          </button>
        )}
        &nbsp;
        {linkNext && (
          <button onClick={() => getUbications(linkNext)} className="btn">
            Siguiente
          </button>
        )}
      </div>
    </div>
  );
};

export default Ubications;
