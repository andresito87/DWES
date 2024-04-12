import axios from 'axios';

const axiosClient = axios.create({
  baseURL: `${import.meta.env.VITE_API_BASE_URL}/api`,
});

// Interceptors: Especials functions that run before or after a request is made
axiosClient.interceptors.request.use(config => {
  const token = localStorage.getItem('ACCESS_TOKEN');
  config.headers['Authorization'] = `Bearer ${token}`;
  return config;
});

axiosClient.interceptors.response.use(
  // onFulfilled
  response => {
    return response;
  },
  // onRejected
  error => {
    const { response } = error;
    if (response.status === 401) {
      localStorage.removeItem('ACCESS_TOKEN');
    }

    throw error;
  }
);

export default axiosClient;
