import { useParams } from 'react-router-dom';
import { useEffect, useState } from 'react';
import axiosClient from '../axios-client';

const UserForm = () => {
  const { id } = useParams();
  const [loading, setLoading] = useState(false);
  const [errors, setErrors] = useState(null);
  const [user, setUser] = useState({
    id: null,
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
  });

  useEffect(() => {
    if (id) {
      setLoading(true);
      axiosClient
        .get(`/users/${id}`)
        .then(({ data }) => {
          setLoading(false);
          setUser(data);
        })
        .catch(() => {
          setLoading(false);
        });
    }
  }, [id]);

  const onSubmit = e => {
    e.preventDefault();
    const payload = {
      name: e.target.name.value,
      email: e.target.email.value,
      password: e.target.password.value,
      password_confirmation: e.target.password.value,
    };
    axiosClient
      .post(id ? `/users/${id}` : '/users', payload)
      .then(() => {
        window.location.href = '/users';
      })
      .catch(error => {
        const { response } = error;
        if (response && response.status === 422) {
          setErrors(response.data.errors);
        }
      });
  };
  return (
    <>
      {user.id && <h1>Editar Usuario: {user.username}</h1>}
      {!user.id && <h1>Creación Nuevo Usuario</h1>}
      <div className="card animated fadeInDown">
        {loading && <div className="text-center">Cargando...</div>}
        {errors && (
          <div className="alert">
            {Object.entries(errors).map(([key]) => (
              <p key={key}>{errors[key][0]}</p>
            ))}
          </div>
        )}
        {!loading && (
          <form onSubmit={onSubmit}>
            <div>
              <label htmlFor="name">Usuario</label>
              <input
                type="text"
                id="username"
                name="username"
                value={user.username}
                onChange={e => setUser({ ...user, username: e.target.value })}
              />
            </div>
            <div>
              <label htmlFor="email">Email</label>
              <input
                type="email"
                id="email"
                name="email"
                value={user.email}
                onChange={e => setUser({ ...user, email: e.target.value })}
              />
            </div>
            <div>
              <label htmlFor="password">Contraseña</label>
              <input
                type="password"
                id="password"
                name="password"
                value={user.password}
                onChange={e => setUser({ ...user, password: e.target.value })}
              />
            </div>
            <div>
              <label htmlFor="password_confirmation">Repite Contraseña</label>
              <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                value={user.password_confirmation}
                onChange={e =>
                  setUser({ ...user, password_confirmation: e.target.value })
                }
              />
            </div>
            <button className="btn" type="submit">
              Guardar
            </button>
          </form>
        )}
      </div>
    </>
  );
};

export default UserForm;
