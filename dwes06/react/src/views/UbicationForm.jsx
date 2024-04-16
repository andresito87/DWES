import { useNavigate, useParams } from 'react-router-dom';
import { useEffect, useState } from 'react';
import axiosClient from '../axios-client';
import { useStateContext } from '../../contexts/ContextProvider';

const UbicationForm = () => {
  const { id } = useParams();
  const navigate = useNavigate();
  const [loading, setLoading] = useState(false);
  const [errors, setErrors] = useState(null);
  const { setNotification } = useStateContext();
  const [ubication, setUbication] = useState({
    id: null,
    nombre: '',
    descripcion: '',
    dias: '',
  });

  useEffect(() => {
    if (id) {
      setLoading(true);
      axiosClient
        .get(`/ubications/${id}`)
        .then(({ data }) => {
          setLoading(false);
          setUbication(data);
        })
        .catch(() => {
          setLoading(false);
        });
    }
  }, [id]);

  const onSubmit = e => {
    e.preventDefault();
    if (ubication.id) {
      axiosClient
        .put(`/ubications/${id}`, ubication)
        .then(() => {
          setNotification('Ubicación actualizada correctamente');
          navigate('/ubications');
        })
        .catch(error => {
          const { response } = error;
          if (response && response.status === 422) {
            setErrors(response.data.errors);
          }
        });
    } else {
      axiosClient
        .post(`/ubications`, ubication)
        .then(() => {
          setNotification('Ubicación creada correctamente');
          navigate('/ubications');
        })
        .catch(error => {
          const { response } = error;
          if (response && response.status === 422) {
            setErrors(response.data.errors);
          }
        });
    }
  };

  return (
    <>
      {ubication.id && <h1>Editar Ubicación: {ubication.nombre}</h1>}
      {!ubication.id && <h1>Creación Nueva Ubicación:</h1>}
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
              <label htmlFor="nombre">Nombre</label>
              <input
                type="text"
                id="nombre"
                name="nombre"
                value={ubication.nombre}
                onChange={e =>
                  setUbication({ ...ubication, nombre: e.target.value })
                }
              />
            </div>
            <div>
              <label htmlFor="descripcion">Descripcion</label>
              <input
                type="text"
                id="descripcion"
                name="descripcion"
                value={ubication.descripcion}
                onChange={e =>
                  setUbication({ ...ubication, descripcion: e.target.value })
                }
              />
            </div>
            <div>
              <label htmlFor="dias">Días</label>
              <input
                type="text"
                id="dias"
                name="dias"
                value={ubication.dias}
                onChange={e =>
                  setUbication({ ...ubication, dias: e.target.value })
                }
              />
            </div>
            <button className="btn" type="submit">
              Guardar
            </button>
            &nbsp;
            <button className="btn" onClick={() => navigate('/ubications')}>
              Cancelar
            </button>
          </form>
        )}
      </div>
    </>
  );
};

export default UbicationForm;
