import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Importazione Bootstrap con Popper
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;