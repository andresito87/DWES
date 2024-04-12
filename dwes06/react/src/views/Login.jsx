import { Link } from 'react-router-dom';
import { useRef } from 'react';
import axiosClient from '../axios-client';
import { useStateContext } from '../../contexts/ContextProvider';
import { useState } from 'react';

const Login = () => {
  const usernameRef = useRef();
  const passwordRef = useRef();
  const [errors, setErrors] = useState(null);
  const { setUser, setToken } = useStateContext();
  const onSubmit = e => {
    e.preventDefault();
    const payload = {
      username: usernameRef.current.value,
      password: passwordRef.current.value,
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
        if (response && response.status === 422) {
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
          <input ref={usernameRef} type="text" placeholder="Usuario" />
          <input ref={passwordRef} type="password" placeholder="Contraseña" />
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
