import { Link, Navigate, Outlet } from 'react-router-dom';
import { useStateContext } from '../../contexts/ContextProvider';
import { useEffect } from 'react';
import axiosClient from '../axios-client';

const DefaultLayout = () => {
  const { user, token, notification, setUser, setToken } = useStateContext();

  useEffect(() => {
    axiosClient
      .get('/user')
      .then(({ data }) => {
        setUser(data);
      })
      .catch(() => {
        localStorage.removeItem('ACCESS_TOKEN');
      });
  }, [setUser]);

  // Redirect to login if there is no token, unauthorized access
  if (!token) {
    return <Navigate to="/login" />;
  }

  const onLogout = e => {
    e.preventDefault();

    axiosClient
      .post('/logout')
      .then(() => {
        setUser({});
        setToken(null);
        localStorage.removeItem('ACCESS_TOKEN');
      })
      .catch(() => {
        localStorage.removeItem('ACCESS_TOKEN');
      });
  };

  return (
    <div id="defaultLayout">
      <aside>
        <Link to="/dashboard">Página Principal</Link>
        <Link to="/users">Usuarios</Link>
        <Link to="/ubications">Ubicaciones</Link>
        <Link to="/workshops">Talleres</Link>
      </aside>
      <div className="content">
        <header>
          <div>Asociación Respira: Panel de administración</div>
          <div>
            <div className="username">{user.username}</div>
            <a href="#" onClick={onLogout} className="btn-logout">
              Salir
            </a>
          </div>
        </header>
        <main>
          <Outlet />
        </main>
      </div>
      {notification && <div className="notification">{notification}</div>}
    </div>
  );
};

export default DefaultLayout;
