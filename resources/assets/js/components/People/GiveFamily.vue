<template>
    <modal :show.sync="show">
        <h3 slot="header">Give this guy a famity</h3>

        <div slot="body">
            <div class="form">
                <div class="form-group">
                    <label>Pick a family</label>
                    <select class="form-control" v-model="family_id">
                        <option v-for="family in families"
                                :value="family.id"
                        >
                            {{ family.family_name }}
                        </option>
                    </select>
                </div>

                <div class="form-group" v-show="potentialFathers.length">
                    <label>Pick a father</label>
                    <select class="form-control" v-model="newFamily.father_id">
                        <option v-for="person in potentialFathers"
                                :value="person.id"
                        >
                            {{ person.name }}
                        </option>
                    </select>
                </div>

                <div class="form-group" v-show="potentialMothers.length">
                    <label>Pick a mother</label>
                    <select class="form-control" v-model="newFamily.mother_id">
                        <option v-for="person in potentialMothers"
                                :value="person.id"
                        >
                            {{ person.name }}
                        </option>
                    </select>
                </div>

                <div class="form-group" v-show="potentialSpouses.length">
                    <label>Pick a spouse</label>
                    <select class="form-control" v-model="newFamily.spouse_id">
                        <option v-for="person in potentialSpouses"
                                :value="person.id"
                        >
                            {{ person.name }}
                        </option>
                    </select>
                </div>
            </div>
        </div>

        <div slot="footer">
            <button :disabled="! canSave" class="btn btn-default" @click="save">Save</button>
        </div>
    </modal>
</template>

<script>
    import Modal from '../global/Modal.vue'

    module.exports = {
        components: {
            Modal
        },

        props: ['show', 'personId'],

        data() {
            return {
                families: [],
                family_id: null,
                potentialFathers: [],
                potentialMothers: [],
                potentialSpouses: [],

                newFamily: {
                    father_id: null, mother_id: null, spouse_id: null,
                }
            }
        },

        computed: {
            canSave: function () {
                return this.family_id;
            }
        },

        methods: {
            potentialFamily (family_id) {
                this.$http.get('/families/available-positions', { family_id, personId: this.personId })
                    .then((response) => {
                        this.potentialFathers = response.data.fathers;
                        this.potentialMothers = response.data.mothers;
                        this.potentialSpouses = response.data.spouses;
                    });
            },

            save() {
                let data = this.newFamily;
                data.family_id = this.family_id;

                this.$http.post('/people/' + this.personId + '/attach-to-family', data)
                    .then((response) => {
                        this.$dispatch('person-got-a-family');
                        this.hide();
                    });
            },

            fetchFamilies() {
                this.$http.get('/families')
                    .then((response) => {
                        this.families = response.data;
                    });
            },

            potentialMothers(params) {
                this.$http.post('families/potential-mothers', params )
                    .then((response) => {

                    })
            },

            hide() {
                this.newFamily = {
                    father_id: '', mother_id: '', spouse_id: ''
                };
                this.show = false;
            }
        },

        watch: {
            family_id (family_id) {
                this.potentialFamily(family_id);
            },

            // 'newFamily.father_id': function (father_id) {
            //     this.potentialMothers({father_id});
            // }
        },

        ready() {
            this.fetchFamilies();
        }
    }
</script>