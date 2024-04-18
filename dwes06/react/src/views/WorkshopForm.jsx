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
  const [workshop, setWorkshop] = useState({
    id: null,
    ubicacion_id: null,
    nombre: '',
    descripcion: '',
    dia_semana: '',
    hora_inicio: '',
    hora_fin: '',
    cupo_maximo: '',
  });

  useEffect(() => {
    if (id) {
      setLoading(true);
      axiosClient
        .get(`/workshops/${id}`)
        .then(({ data }) => {
          setLoading(false);
          setWorkshop(data);
        })
        .catch(() => {
          setLoading(false);
        });
    }
  }, [id]);

  const onSubmit = e => {
    e.preventDefault();
    if (workshop.id) {
      axiosClient
        .put(`/workshops/${id}`, workshop)
        .then(() => {
          setNotification('Taller actualizado correctamente');
          navigate('/workshops');
        })
        .catch(error => {
          const { response } = error;
          if (response && response.status === 422) {
            if (response.data.errors) {
              setErrors(response.data.errors);
            } else {
              setErrors(response.data.message);
            }
          }
        });
    } else {
      axiosClient
        .post(`/workshops`, workshop)
        .then(() => {
          setNotification('Taller creado correctamente');
          navigate('/workshops');
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
      {workshop.id && <h1>Editar Taller: {workshop.nombre}</h1>}
      {!workshop.id && <h1>Creación Nuevo Taller:</h1>}
      <div className="card animated fadeInDown">
        {loading && <div className="text-center">Cargando...</div>}
        {errors && (
          <div className="alert">
            {typeof errors === 'string' ? <p>{errors}</p> : ''}
            {typeof errors === 'object'
              ? Object.entries(errors).map(([key]) => (
                  <p key={key}>{errors[key][0]}</p>
                ))
              : ''}
          </div>
        )}
        {!loading && (
          <form onSubmit={onSubmit}>
            <div>
              <label htmlFor="ubicacion_id">Ubicación ID</label>
              <input
                type="number"
                id="ubicacion_id"
                name="ubicacion_id"
                value={workshop.ubicacion_id}
                onChange={e =>
                  setWorkshop({ ...workshop, ubicacion_id: e.target.value })
                }
              />
              <label htmlFor="nombre">Nombre</label>
              <input
                type="text"
                id="nombre"
                name="nombre"
                value={workshop.nombre}
                onChange={e =>
                  setWorkshop({ ...workshop, nombre: e.target.value })
                }
              />
            </div>
            <div>
              <label htmlFor="descripcion">Descripcion</label>
              <input
                type="text"
                id="descripcion"
                name="descripcion"
                value={workshop.descripcion}
                onChange={e =>
                  setWorkshop({ ...workshop, descripcion: e.target.value })
                }
              />
            </div>
            <div>
              <label htmlFor="dia_semana">Día de la semana</label>
              <input
                type="text"
                id="dia_semana"
                name="dia_semana"
                value={workshop.dia_semana}
                onChange={e =>
                  setWorkshop({ ...workshop, dia_semana: e.target.value })
                }
              />
            </div>
            <div>
              <label htmlFor="hora_inicio">Hora de inicio</label>
              <input
                type="text"
                id="hora_inicio"
                name="hora_inicio"
                value={workshop.hora_inicio.split(':').slice(0, 2).join(':')}
                onChange={e =>
                  setWorkshop({ ...workshop, hora_inicio: e.target.value })
                }
              />
            </div>
            <div>
              <label htmlFor="hora_fin">Hora de fin</label>
              <input
                type="text"
                id="hora_fin"
                name="hora_fin"
                value={workshop.hora_fin.split(':').slice(0, 2).join(':')}
                onChange={e =>
                  setWorkshop({ ...workshop, hora_fin: e.target.value })
                }
              />
            </div>
            <div>
              <label htmlFor="cupo_maximo">Cupo máximo</label>
              <input
                type="number"
                id="cupo_maximo"
                name="cupo_maximo"
                value={workshop.cupo_maximo}
                onChange={e =>
                  setWorkshop({ ...workshop, cupo_maximo: e.target.value })
                }
              />
            </div>
            <button className="btn" type="submit">
              Guardar
            </button>
            &nbsp;
            <button className="btn" onClick={() => navigate('/workshops')}>
              Cancelar
            </button>
          </form>
        )}
      </div>
    </>
  );
};

export default UbicationForm;
