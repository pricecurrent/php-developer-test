<template>
    <modal :show.sync="show">
        <h3 slot="header">Add Family</h3>

        <div slot="body">
            <div class="form">
                <div class="form-group">
                    <label>Family name:</label>
                    <input type="text" v-model="newFamily.family_name" class="form-control">
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
                newFamily: {
                    family_name: ''
                }
            }
        },

        computed: {
            canSave: function () {
                return this.newFamily.family_name.length;
            }
        },

        methods: {
            save() {
                this.$http.post('/families', this.newFamily)
                    .then((response) => {
                        this.$dispatch('notify-new-family');
                        this.hide();
                    });
            },

            hide() {
                this.newFamily = {
                    family_name: '', age: ''
                };
                this.show = false;
            }
        }
    }
</script>