import { Link, Navigate, Outlet } from 'react-router-dom';
import { useStateContext } from '../../contexts/ContextProvider';
import { useEffect } from 'react';
import axiosClient from '../axios-client';

const DefaultLayout = () => {
  const { user, token, setUser, setToken } = useStateContext();

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
        <Link to="/dashboard">Dashboard</Link>
        <Link to="/users">Users</Link>
      </aside>
      <div className="content">
        <header>
          <div>Header</div>
          <div>
            {user.username}
            <a href="#" onClick={onLogout} className="btn-logout">
              Logout
            </a>
          </div>
        </header>
        <main>
          <Outlet />
        </main>
      </div>
    </div>
  );
};

export default DefaultLayout;