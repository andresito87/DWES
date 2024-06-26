import { createBrowserRouter } from 'react-router-dom';
import Login from './views/Login.jsx';
import Users from './views/Users.jsx';
import Signup from './views/Signup.jsx';
import NotFound from './views/NotFound.jsx';
import GuestLayout from './components/GuestLayout.jsx';
import DefaultLayout from './components/DefaultLayout.jsx';
import Dashboard from './views/Dashboard.jsx';
import { Navigate } from 'react-router-dom';
import UserForm from './views/UserForm.jsx';
import Ubications from './views/Ubications.jsx';
import UbicationForm from './views/UbicationForm.jsx';
import Workshops from './views/Workshops.jsx';
import WorkshopForm from './views/WorkshopForm.jsx';

const router = createBrowserRouter([
  {
    path: '/',
    element: <DefaultLayout />,
    children: [
      {
        path: '/',
        element: <Navigate to="/dashboard" />,
      },
      {
        path: '/users',
        element: <Users />,
      },
      {
        path: '/users/new',
        element: <UserForm key="userCreate" />,
      },
      {
        path: '/users/:id',
        element: <UserForm key="userUpdate" />,
      },
      {
        path: '/dashboard',
        element: <Dashboard />,
      },
      {
        path: '/ubications',
        element: <Ubications />,
      },
      {
        path: '/ubications/new',
        element: <UbicationForm key="ubicationCreate" />,
      },
      {
        path: '/ubications/:id',
        element: <UbicationForm key="ubicationUpdate" />,
      },
      {
        path: '/workshops',
        element: <Workshops />,
      },
      {
        path: '/workshops/new',
        element: <WorkshopForm key="workshopCreate" />,
      },
      {
        path: '/workshops/:id',
        element: <WorkshopForm key="workshopUpdate" />,
      },
    ],
  },
  {
    path: '/',
    element: <GuestLayout />,
    children: [
      {
        path: '/login',
        element: <Login />,
      },
      {
        path: '/signup',
        element: <Signup />,
      },
    ],
  },
  {
    path: '*',
    element: <NotFound />,
  },
]);

export default router;
