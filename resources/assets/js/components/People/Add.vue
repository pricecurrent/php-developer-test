<template>
    <modal :show.sync="show">
        <h3 slot="header">Add person</h3>

        <div slot="body">
            <div class="form">
                <div class="form-group">
                    <label>Name:</label>
                    <input type="text" v-model="newPerson.name" class="form-control">
                </div>

                <div class="form-group">
                    <label>Age</label>
                    <input type="text" v-model="newPerson.age" class="form-control">
                </div>

                <div class="form-group">
                    <label>Gender</label>
                    <select v-model="newPerson.gender" class="form-control">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
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

        props: ['show'],

        data() {
            return {
                newPerson: {
                    name: '', age: '', gender: ''
                }
            }
        },

        computed: {
            canSave: function () {
                return this.newPerson.name.length && this.newPerson.gender.length;
            }
        },

        methods: {
            save() {
                this.$http.post('/people', this.newPerson)
                    .then((response) => {
                        this.$dispatch('notify-new-person');
                        this.hide();
                    });
            },

            hide() {
                this.newPerson = {
                    name: '', age: '', gender: '',
                };
                this.show = false;
            }
        }
    }
</script>