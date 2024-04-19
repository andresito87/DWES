import { Link } from 'react-router-dom';
import { useRef } from 'react';
import axiosClient from '../axios-client';
import { useStateContext } from '../../contexts/ContextProvider';
import { useState } from 'react';

const Signup = () => {
  const usernameRef = useRef();
  const emailRef = useRef();
  const passwordRef = useRef();
  const passwordConfirmationRef = useRef();
  const [errors, setErrors] = useState(null);
  const { setUser, setToken } = useStateContext();

  const onSubmit = e => {
    e.preventDefault();
    const payload = {
      username: usernameRef.current.value,
      email: emailRef.current.value,
      password: passwordRef.current.value,
      password_confirmation: passwordConfirmationRef.current.value,
    };
    axiosClient
      .post('/signup', payload)
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
            console.log(response.data);
            setErrors(response.data.message);
          }
        }
      });
  };

  return (
    <div className="login-signup-form animated fadeInDown">
      <div className="form">
        <form onSubmit={onSubmit}>
          <h1 className="title">Regístrate Gratis</h1>
          {errors && (
            <div className="alert">
              {Array.isArray(errors) ? (
                errors.map((error, index) => <p key={index}>{error}</p>)
              ) : (
                <p>{errors}</p>
              )}
            </div>
          )}
          <input ref={usernameRef} type="text" placeholder="Usuario" />
          <input ref={emailRef} type="email" placeholder="Email" />
          <input ref={passwordRef} type="password" placeholder="Contraseña" />
          <input
            ref={passwordConfirmationRef}
            type="password"
            placeholder="Repite Contraseña"
          />
          <button className="btn btn-block" type="submit">
            Crear cuenta
          </button>
          <p className="message">
            ¿Tienes una cuenta?
            <br />
            <Link to="/login">Accede a tu cuenta</Link>
          </p>
        </form>
      </div>
    </div>
  );
};

export default Signup;
