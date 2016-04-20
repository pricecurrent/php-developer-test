import Vue from 'vue';
Vue.use(require('vue-resource'));

Vue.http.headers.common['X-CSRF-TOKEN'] = document.getElementsByName("csrf-token")[0].getAttribute('content');

import PeopleView from './components/views/People';
import PersonView from './components/views/Person';

var vue = new Vue({
    el: '#app',

    components: {
        PeopleView, PersonView
    }
});

export default vue;
