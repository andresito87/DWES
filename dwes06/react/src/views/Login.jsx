import { Link } from 'react-router-dom';
import { useRef } from 'react';
import axiosClient from '../axios-client';
import { useStateContext } from '../../contexts/ContextProvider';
import { useState } from 'react';

const Login = () => {
  const usernameRef = useRef();
  const passwordRef = useRef();
  const rememberRef = useRef();
  const [errors, setErrors] = useState(null);
  const { setUser, setToken } = useStateContext();
  const handleInputChange = () => {
    setErrors(null);
  };
  const onSubmit = e => {
    e.preventDefault();
    const payload = {
      username: usernameRef.current.value,
      password: passwordRef.current.value,
      remember: rememberRef.current.checked,
    };
    setErrors(null);
    axiosClient
      .post('/login', payload)
      .then(({ data }) => {
        setUser(data.user);
        setToken(data.token);
      })
      .catch(error => {
        const { response } = error;
        if (response && (response.status === 401 || response.status === 422)) {
          if (response.data.errors) {
            setErrors(response.data.errors);
          } else {
            setErrors({ username: ['Usuario o contraseña incorrectos'] });
          }
        }
      });
  };

  return (
    <div className="login-signup-form animated fadeInDown">
      <h1>Bienvenid@ a la asociación Respira</h1>
      <div className="form">
        <form onSubmit={onSubmit}>
          <h1 className="title">Acceder a tu cuenta</h1>
          {errors && (
            <div className="alert">
              {Object.entries(errors).map(([key]) => (
                <p key={key}>{errors[key][0]}</p>
              ))}
            </div>
          )}
          <input
            ref={usernameRef}
            type="text"
            onChange={handleInputChange}
            placeholder="Usuario"
          />
          <input
            ref={passwordRef}
            type="password"
            onChange={handleInputChange}
            placeholder="Contraseña"
          />
          <label id="recordar">
            <input
              ref={rememberRef}
              type="checkbox"
              onChange={handleInputChange}
            />
            Recordar
          </label>
          <button className="btn btn-block" type="submit">
            Acceder
          </button>
          <p className="message">
            ¿Deseas registrarte?
            <br />
            <Link to="/signup">Crear una cuenta</Link>
          </p>
        </form>
      </div>
    </div>
  );
};

export default Login;
