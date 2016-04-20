import addPerson from '../People/Add.vue';
import addFamily from '../Family/Add.vue';

module.exports = {

    components: {
        addPerson, addFamily
    },

    data() {
        return {
            orphans:[],
            families: [],
            showNewPersonModal: false,
            showNewFamilyModal: false
        }
    },

    methods: {
        fetchPeople() {
            this.$http.get('/people/orphans')
                .then((response) => {
                    this.orphans = response.data;
                });
        },

        fetchFamilies() {
            this.$http.get('/families')
                .then((response) => {
                    this.families = response.data;
                });
        },

        addPerson() {
            this.showNewPersonModal = true;
        },

        addFamily() {
            this.showNewFamilyModal = true;
        }
    },

    events: {
        'notify-new-person': function() {
            this.fetchPeople();
        },

        'notify-new-family': function() {
            this.fetchFamilies();
        }
    },

    ready() {
        this.fetchPeople();
        this.fetchFamilies();
    }
}
