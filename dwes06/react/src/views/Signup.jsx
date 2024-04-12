import { Link } from 'react-router-dom';
import { useRef } from 'react';
import axiosClient from '../axios-client';
import { useStateContext } from '../../contexts/ContextProvider';

const Signup = () => {
  const usernameRef = useRef();
  const emailRef = useRef();
  const passwordRef = useRef();
  const passwordConfirmationRef = useRef();

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
          response.data.errors.forEach(error => {
            console.error(error);
          });
        }
      });
  };

  return (
    <div className="login-signup-form animated fadeInDown">
      <div className="form">
        <form onSubmit={onSubmit}>
          <h1 className="title">Regístrate Gratis</h1>
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
