import { Link } from 'react-router-dom';

const Login = () => {
  const onSubmit = e => {
    e.preventDefault();
  };

  return (
    <div className="login-signup-form animated fadeInDown">
      <div className="form">
        <form onSubmit={onSubmit}>
          <h1 className="title">Acceder a tu cuenta</h1>
          <input type="text" placeholder="Usuario" />
          <input type="password" placeholder="Contraseña" />
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
