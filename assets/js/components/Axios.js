import axios from 'axios';

const instance = axios.create({
    baseURL: 'https://new.marche.be/'
});

export default instance;
