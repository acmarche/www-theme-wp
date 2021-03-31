import axios from 'axios';

const instance = axios.create({
    baseURL: 'https://www.marche.be/'
});

export default instance;
