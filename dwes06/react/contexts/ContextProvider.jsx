import { createContext } from 'react';
import { useState } from 'react';
import { useContext } from 'react';

const StateContext = createContext({
  user: null,
  token: null,
  notification: null,
  setUser: () => {},
  setUbication: () => {},
  setWorkshop: () => {},
  setToken: () => {},
  setNotification: () => {},
});

export const ContextProvider = ({ children }) => {
  const [user, setUser] = useState({});
  const [ubication, setUbication] = useState({});
  const [workshop, setWorkshop] = useState({});
  const [notification, _setNotification] = useState('');
  const [token, _setToken] = useState(localStorage.getItem('ACCESS_TOKEN'));

  const setNotification = message => {
    _setNotification(message);
    setTimeout(() => {
      _setNotification('');
    }, 5000);
  };

  const setToken = token => {
    _setToken(token);
    if (token) {
      localStorage.setItem('ACCESS_TOKEN', token);
    } else {
      localStorage.removeItem('ACCESS_TOKEN');
    }
  };

  return (
    <StateContext.Provider
      value={{
        user,
        token,
        setUser,
        setToken,
        notification,
        setNotification,
        ubication,
        setUbication,
        workshop,
        setWorkshop,
      }}
    >
      {children}
    </StateContext.Provider>
  );
};

export const useStateContext = () => {
  return useContext(StateContext);
};
