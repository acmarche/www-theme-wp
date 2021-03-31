import axios from 'axios';

const instance = axios.create({
    baseURL: 'https://www22.marche.be/'
});

export default instance;
