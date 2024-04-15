import React, { useEffect, useState } from 'react';
import axiosClient from '../axios-client';
import { Link } from 'react-router-dom';
import { useStateContext } from '../../contexts/ContextProvider';

const Users = () => {
  const [users, setUsers] = useState([]);
  const [loading, setLoading] = useState(false);
  const { setNotification } = useStateContext();
  const [linkNext, setLinkNext] = useState(null);
  const [linkPrev, setLinkPrev] = useState(null);

  useEffect(() => {
    getUsers();
  }, []);

  const onDelete = user => {
    if (window.confirm('¿Estás seguro  que desea eliminar este usuario?')) {
      setLoading(true);
      axiosClient
        .delete(`/users/${user.id}`)
        .then(() => {
          setNotification('Usuario eliminado correctamente');
          getUsers();
        })
        .catch(() => {
          setLoading(false);
        });
    }
  };

  const getUsers = link => {
    setLoading(true);
    if (link) {
      axiosClient
        .get(link)
        .then(({ data }) => {
          setLoading(false);
          setUsers(data.data);
          setLinkNext(data.links.next);
          setLinkPrev(data.links.prev);
        })
        .catch(() => {
          setLoading(false);
        });
      return;
    }
    axiosClient
      .get('/users')
      .then(({ data }) => {
        setLoading(false);
        setUsers(data.data);
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
        <h1>Users</h1>
        <Link to={'/users/new'} className="btn-add">
          Crear nuevo usuario
        </Link>
      </div>
      <div className="card animated fadeInDown">
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Usuario</th>
              <th>Email</th>
              <th>Fecha de creación</th>
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
          {!loading && users.length === 0 && (
            <tbody>
              <tr>
                <td colSpan="5" className="text-center">
                  No hay usuarios
                </td>
              </tr>
            </tbody>
          )}
          {!loading && (
            <tbody>
              {users.map(user => (
                <tr key={user.id}>
                  <td>{user.id}</td>
                  <td>{user.username}</td>
                  <td>{user.email}</td>
                  <td>{user.created_at}</td>
                  <td>
                    <Link className="btn-edit" to={`/users/${user.id}`}>
                      Editar
                    </Link>
                    &nbsp;
                    <button
                      onClick={e => onDelete(user)}
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
          <button onClick={() => getUsers(linkPrev)} className="btn">
            Anterior
          </button>
        )}
        &nbsp;
        {linkNext && (
          <button onClick={() => getUsers(linkNext)} className="btn">
            Siguiente
          </button>
        )}
      </div>
    </div>
  );
};

export default Users;
