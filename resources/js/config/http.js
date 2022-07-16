import axios from 'axios'

const instance = axios.create({
  baseURL: BASE_URL,
  timeout: 30000,
  headers: {
    'Content-Type': 'application/json',
  },
});

// instance.interceptors.response.use(
//   res => {
//     return Promise.resolve(res.data);

//     // return res.data;
//   },
//   error => {
//     if (!error.response) {
//       return Promise.reject(error);
//     } else {
//       return Promise.reject(error.response);
//     }
//   },
// );

export const http = instance;
